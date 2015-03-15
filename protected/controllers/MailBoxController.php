<?php

class MailBoxController extends Controller {

	public function actionMessage() {
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$message = Message::model() -> find("id = :id", array(":id" => $id));
			$messageReceiver = MessageUserBridge::model() -> find("message_id = :id", array(":id" => $id));
			if ($message -> sender_type == 0)
				$user = Student::model() -> find("id = :id", array(":id" => $message -> sender_id));
			if ($message -> sender_type == 1)
				$user = Teacher::model() -> find("id = :id", array(":id" => $message -> sender_id));
			if ($message -> sender_type == 2)
				$user = Admin::model() -> find("id = :id", array(":id" => $message -> sender_id));
			$messageReceiver -> seen = 1;
			$messageReceiver -> save();
			$this -> render("message", array("message" => $message, "sender" => $user));
		}

	}

	public function actionSent() {
		$type = 0;
		if (Yii::app() -> user -> type == "Student")
			$type = 0;
		else if (Yii::app() -> user -> type == "Teacher")
			$type = 1;
		else if (Yii::app() -> user -> type == "Admin")
			$type = 2;

		$messages = Message::model() -> findAll("sender_id = " . Yii::app() -> user -> id . " and sender_type = " . $type);
		$receivers = array();
		$i = 0;
		foreach ($messages as $msg) {
			$receiversInfo = MessageUserBridge::model() -> findAll("message_id = " . $msg -> id);
			$receivers[] = array();
			foreach ($receiversInfo as $receiver) {
				//$receivers[$i][] = $receiver->
				if(!isset($receiver -> user_type) || !isset($receiver -> user_id)  )
					$receivers[$i][] = "All";
				else if ($receiver -> user_type == 0) {
					$user = Student::model() -> find("id = " . $receiver -> user_id);
					$receivers[$i][] = $user -> first_name . " " . $user -> last_name;
					$i++;
				} else if ($receiver -> user_type == 1) {
					$user = Teacher::model() -> find("id = " . $receiver -> user_id);
					$receivers[$i][] = $user -> first_name . " " . $user -> last_name;
					$i++;
				} else if ($receiver -> user_type == 2) {
					$user = Admin::model() -> find("id = " . $receiver -> user_id);
					$receivers[$i][] = $user -> first_name . " " . $user -> last_name;
					$i++;
				}
			}
		}
		$this->render("sent",array("allMsgs"=>$messages,"receivers"=>$receivers));

	}

	public function actionInbox() {
		$type = 0;
		if (Yii::app() -> user -> type == "Student")
			$type = 0;
		else if (Yii::app() -> user -> type == "Teacher")
			$type = 1;
		else if (Yii::app() -> user -> type == "Admin")
			$type = 2;

		//$allMsgs = MessageUserBridge::model() -> findAll("user_type = :type and user_id = :id", array(":type" => $type  ,  ":id"=> Yii::app()->user->id));

		$criteria = new CDbCriteria( array('order' => 'date DESC'));
		$criteria -> compare('user_type', $type, false);
		$criteria -> compare('user_id', Yii::app() -> user -> id, false);
		$criteria -> compare('broadcast_type', 0, false);

		$criteria2 = new CDbCriteria;
		$criteria2 -> addSearchCondition("`message`.`broadcast_type`", $type + 1, false);
		$criteria2 -> addSearchCondition("`message`.`broadcast_type`", 5, false, "OR");

		$criteria -> mergeWith($criteria2, 'OR');

		//echo $criteria->getText().'<br/>';
		$allMsgs = MessageUserBridge::model() -> with("message") -> findAll($criteria);

		//var_dump($allMsgs[0]->message);
		$senders_names = array();
		$i = 0;
		foreach ($allMsgs as $msg) {
			$message = $msg -> message;
			if ($message -> sender_type == 0) {
				$sender = Student::model() -> find("id = " . $message -> sender_id);
				$senders_names[] = $sender -> first_name . " " . $sender -> last_name;
				$i++;
			} else if ($message -> sender_type == 1) {
				$sender = Teacher::model() -> find("id = " . $message -> sender_id);
				$senders_names[] = $sender -> first_name . " " . $sender -> last_name;
				$i++;
			} else if ($message -> sender_type == 2) {
				$sender = Admin::model() -> find("id = " . $message -> sender_id);
				$senders_names[] = $sender -> first_name . " " . $sender -> last_name;
				$i++;
			}

		}

		//$allMsgs = array();
		$this -> render("inbox", array("allMsgs" => $allMsgs, "senders" => $senders_names));
	}

	public function actionSend() {
		if ($_POST) {
			$message = "";
			$msg = new Message;
			$msg -> subject = $_POST['subject'];
			$msg -> content = $_POST['content'];
			$msg -> sender_id = Yii::app() -> user -> id;
			$date = new DateTime;
			$msg -> date = date('Y-m-d H:i:s');
			if (Yii::app() -> user -> type == "Student")
				$msg -> sender_type = 0;
			else if (Yii::app() -> user -> type == "Teacher")
				$msg -> sender_type = 1;
			else if (Yii::app() -> user -> type == "Admin")
				$msg -> sender_type = 2;

			if ($_POST['sender_type'] != 0) {
				$msg -> broadcast_type = $_POST['sender_type'];
				$msg -> save();
				$msg_bridge = new MessageUserBridge;
				$msg_bridge -> message_id = $msg -> id;
				$msg_bridge -> save();
			} else {
				$msg -> broadcast_type = 0;

				if ($msg -> save()) {
					echo $msg -> content;

					$receivers_array = explode(',', $_POST['receivers']);
					foreach ($receivers_array as $receiver) {
						$receiverUser = Users::model() -> find("username = :uname", array(":uname" => $receiver));
						if (count($receiverUser) > 0 && $receiverUser -> type == 0) {
							$user = Student::model() -> find("id = :id", array(":id" => $receiverUser -> profile_id));
							$msg_bridge = new MessageUserBridge;
							$msg_bridge -> message_id = $msg -> id;
							$msg_bridge -> user_id = $user -> id;
							$msg_bridge -> user_type = $receiverUser -> type;
							$msg_bridge -> save();
						} else if (count($receiverUser) > 0 && $receiverUser -> type == 1) {
							$user = Teacher::model() -> find("id = :id", array(":id" => $receiverUser -> profile_id));
							$msg_bridge = new MessageUserBridge;
							$msg_bridge -> message_id = $msg -> id;
							$msg_bridge -> user_id = $user -> id;
							$msg_bridge -> user_type = $receiverUser -> type;
							$msg_bridge -> save();
						}
						if (count($receiverUser) > 0 && $receiverUser -> type == 2) {
							$user = Admin::model() -> find("id = :id", array(":id" => $receiverUser -> profile_id));
							$msg_bridge = new MessageUserBridge;
							$msg_bridge -> message_id = $msg -> id;
							$msg_bridge -> user_id = $user -> id;
							$msg_bridge -> user_type = $receiverUser -> type;
							$msg_bridge -> save();
						}

					}
				} else {
					foreach ($msg->getErrors() as $key => $value) {
						foreach ($value as $error) {
							$message .= $error . " ";
						}
					}

				}
			}
			$this -> redirect("index.php?r=MailBox/inbox");

		} else
			$this -> render("send");

	}

}
