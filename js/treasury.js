$(document).ready(function() {

	$("#from,#to,#currency").change(function() {
		$("#report-table").dataTable().fnDestroy();
		var from = $("#from").val();
		var to = $("#to").val();
		var currency = $("#currency").val();
		//alert("index.php?r=Treasury/getTransactions&from="+from+"&to="+to+"&currency="+currency);
		$('#report-table').dataTable({
			"ajax" : "index.php?r=Treasury/getTransactions&from="+from+"&to="+to+"&currency="+currency
		});

	});
	$("form").submit(function(event) {
		var uname = $("#user-name-search").val();
		var val = $("#user-type").val();
		var currency = $("#currency").val();
		var currency_check = 1;
		if (val == 0) {
			$.ajax("index.php?r=DataModule/CheckCurrency&uname=" + uname + "&currency_id=" + currency, {
				success : function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.status == "failed") {
						currency_check = 0;
					}
				},
				async : false
			});
		}
		if(val == 1 && $(".glyphicon-remove").length > 0){
			noty({
				text : 'Waiting .. ',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,

			});
			return;

		}
		else if ($(".glyphicon-remove").length > 0 || (val == 0 && uname.length < 1)) {

			noty({
				text : 'Some fields are empty or contain incorrect data, check your data again',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,
			});

		} else if (currency_check == 0) {
			noty({
				text : 'Incorrect currency',
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
		event.preventDefault();
	});

	$("#user-type").change(function() {

		var val = $("#user-type").val();
		//alert(val);
		//alert($("#custom-sender").length);
		if (val == 0) {
			$("#user-name").show();
		} else
			$("#user-name").hide();

	});

	$("#user-name-search").change(function() {
		var uname = $("#user-name-search").val();
		$.ajax("index.php?r=DataModule/checkStudentUsernameExistence&uname=" + uname, {
			success : function(data) {
				$("#user-name #user-name-status").html();
				var obj = jQuery.parseJSON(data);
				if (obj.status == "ok") {
					$("#user-name #user-name-status").html('<span class="glyphicon glyphicon-ok"></span>');
					$("#user-name-search").removeClass('error');
				} else {

					$("#user-name #user-name-status").html('<span class="glyphicon glyphicon-remove"></span>');
					$("#user-name-search").addClass('error');
				}

			},
		});

	});
});
