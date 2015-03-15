<!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-file-text"></span> Message</h2>
                        </div>                                                                                
                        
                        <div class="pull-right">
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>                        
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <img src="<?php echo  Yii::app()->request->baseUrl . '/images/' . $sender->image ?>" class="panel-title-image" alt="<?php echo $sender->first_name; ?>" />
                                    <h3 class="panel-title"><?php echo $sender->first_name . " " . $sender->last_name; ?></h3>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-default"><span class="fa fa-trash-o"></span></button>                                    
                                </div>
                            </div>
                            <div class="panel-body">
                                <h3><?php echo $message->subject;  ?> <small class="pull-right text-muted"><span class="fa fa-clock-o"></span> <?php echo $message->date;  ?></small></h3>
                                <?php echo $message->content ?>      
                           
                           <?php
                           $subject = $message->subject;
                           $pos = strpos($message->subject, "Re:");
						   if($pos === false)
						      $subject = "Re: ".$subject;
						   ?>
                           <form action="index.php?r=MailBox/send" method="post">
                           <input type="hidden" name="subject" value="<?php echo $subject ?>" />
                           <input type="hidden" name="receivers" value="<?php echo $sender->username; ?>" />
                           <input type="hidden" name="sender_type" value="0" />
                           
                                <div class="form-group push-up-20">
                                    <label>Quick Reply</label>
                                    <textarea name="content" class="form-control summernote_lite" rows="3" placeholder="Click to get editor"></textarea>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-success pull-right"><span class="fa fa-mail-reply"></span> Post Reply</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->