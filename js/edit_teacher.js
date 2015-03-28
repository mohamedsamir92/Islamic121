function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}


$(document).ready(function() {
	
	
	$("form").submit(function(event) {
		if($("input:disabled").length == 14){
			noty({
				text : 'You must register working hours',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,
			});
			event.preventDefault();
			return;
		}
		if ($(".glyphicon-remove").length > 0) {
			noty({
				text : 'Some fields contain incorrect data, check your data again',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,
			});
		} else {
			noty({
				text : 'Waiting .. ',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,

			});
			return;
		}
		//alert($("input:disabled").length);
		event.preventDefault();
	});

	
	$("#username").change(function() {
		var uname = $("#username").val();
		$.ajax("index.php?r=DataModule/checkStudentUsername&uname=" + uname, {
			success : function(data) {
				$("#username-group #username-status").html();
				var obj = jQuery.parseJSON(data);
				if (obj.status == "ok") {
					$("#username-group #username-status").html('<span style="display: table-cell; vertical-align: middle;" class="glyphicon glyphicon-ok"></span>');
					$("#username").removeClass('error');
				} else {
					$("#username-group #username-status").html('<div style="display: table-cell; vertical-align: middle;"><span class="glyphicon glyphicon-remove"></span> This username has already been taken</div>');
					$("#username").addClass('error');
				}

			},
		});

	});

	$("#password,#confirmed-password").change(function() {

		var pass = $("#password").val();
		var confirmed_pass = $("#confirmed-password").val();
		$("#password-group #password-status").html();
		if (pass == confirmed_pass && pass.length > 1) {
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#password").removeClass('error');
			$("#confirmed-password").removeClass('error');
		} else {
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-remove"></span>');
			$("#password").addClass('error');
			$("#confirmed-password").addClass('error');
		}

	});

	$("#email").change(function() {

		if (!IsEmail($("#email").val())) {

			$("#email-group #email-status").html('<div style="display: table-cell; vertical-align: middle;"><span class="glyphicon glyphicon-remove"></span> Invalid email</div>');
			$("#email").addClass('error');

		} else {
			$("#email-group #email-status").html('<span style="display: table-cell; vertical-align: middle;" class="glyphicon glyphicon-ok"></span>');
			$("#email").removeClass('error');
		}

	});

	$("#country").change(function() {

		$.ajax("index.php?r=DataModule/getRegions&id=" + $("#country").val(), {
			success : function(data) {
				var obj = jQuery.parseJSON(data);
				$("#cities").html("");
				if (obj.length > 0) {

					$("#cities").append('<span class="input-group-addon"><span class="fa fa-flag-o"></span></span>');
					$("#cities").append('<select id = "cities-select" class="form-control select" data-live-search="true" name="Teacher[city]">');
					var id = $("#cities").attr("city-id");
					for(var i=0;i<obj.length;i++){
						if(id == obj[i].id)
							$("#cities-select").append('<option value = '+obj[i].id+' selected >' + obj[i].name + '</option>');
						else
							$("#cities-select").append('<option value = '+obj[i].id+'  >' + obj[i].name + '</option>');
					}
					$("#cities").append('</select>');
					$('#cities-select').selectpicker();

				}
			},
			error : function() {
				alert("ERROR");
			}
		});

	});

	$("#country").change();
	
	
	$(".day-check").on("ifChecked",function(event){
		var index = $(this).attr("number");
		$(".time-from").eq(index).prop("disabled",false);
		$(".time-to").eq(index).prop("disabled",false);
		handleChange(index,$(".time-from").eq(index).val(),$(".time-to").eq(index).val());
	});
	
	$(".day-check").on("ifUnchecked",function(event){
		var index = $(this).attr("number");
		//var index = $(this).attr("number");
		$(".time-from").eq(index).prop("disabled",true);
		$(".time-to").eq(index).prop("disabled",true);
		$(".slot-status").eq(index).html("");
		
	});
	
	
	$(".time-from,.time-to").change(function() {
	var index = $(this).attr("number");
	if($(".time-from").eq(index).attr("disabled"))
		return;
	handleChange(index,$(".time-from").eq(index).val(),$(".time-to").eq(index).val());
});
	
	

});

function handleChange(index,from, to) {
	$(".slot-status").eq(index).html("");
	$.ajax("index.php?r=DataModule/checkTeacherSlot&from="+from+"&to="+to, {
		success : function(data) {
			var obj = jQuery.parseJSON(data);
			if(obj.status == "OK"){
				$(".slot-status").eq(index).html('<span class="glyphicon glyphicon-ok"></span>');
			}
			else{
				//alert(index);
				$(".slot-status").eq(index).html('<span class="glyphicon glyphicon-remove"></span>');
			}
			
		async: false;
		}
	});
}
