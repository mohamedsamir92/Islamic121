
<form role="form" id="edit-form<?php echo $j; ?>" class="form-horizontal" method = "post" action = "index.php?r=Requests/editRequest" >
	<div class="panel-body">
		<div class="form-group">
			<input type="hidden" class="form-control" name="LessonRequest[id]" value="<?php echo $request_id; ?>" />

			<input type="hidden" class="form-control" name="LessonRequest[student_id]" value="<?php echo $student_id; ?>" />

			<label class="col-md-3 control-label">First name:</label>
			<div class="col-md-9">

				<input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" disabled/>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Last name:</label>
			<div class="col-md-9">

				<input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" disabled/>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Skype id</label>
			<div class="col-md-9">

				<input type="text" class="form-control" name="skype_id" value="<?php echo $skype_id; ?>" disabled/>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Age:</label>
			<div class="col-md-9">

				<input type="text" class="form-control" name="age" value="<?php echo $age; ?>" disabled/>

			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-md-3 control-label">Gender:</label>
			<div class="col-md-9">
				<?php $genderType = ""; ?>
				<?php if($gender == 0)
						$genderType = "Male";
					  else
					  	$genderType = "Female"; ?>
				<input type="text" class="form-control" name="gender" value="<?php echo $genderType ?>" disabled/>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Currecy:</label>
			<div class="col-md-9">

				<select name="LessonRequest[currency]" class="form-control select">
					<?php foreach ($currencies as $currency) { ?>
					
					<?php 
					$selected = "";
					if($selected_currency == $currency->id )
						 $selected = "selected";
						 ?>
					<option value="<?php echo $currency->id ?>" <?php echo $selected; ?> ><?php echo $currency -> sign; ?></option>
					<?php } ?>
				</select>

			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Cost:</label>
			<div class="col-md-9">

				<input type="text" value="<?php echo $cost; ?>" class="form-control" name="LessonRequest[cost]" />

			</div>
		</div>
		
		
		
		<div class="form-group">
			<label class="col-md-3 control-label">Notes:</label>
			<div class="col-md-9">

				<textarea class="form-control" rows="3" name="LessonRequest[notes]" > <?php echo $notes; ?> </textarea>

			</div>
		</div>

		
		
		<div class="btn-group pull-right">
			
			
			<button class="btn btn-primary" type="submit">
				Submit
			</button>
		</div>
	</div>
	
	</form>
