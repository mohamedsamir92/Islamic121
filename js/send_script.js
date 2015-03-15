$(document).ready(function() {
	$("#sender-type").change(function(){
		
		var val = $("#sender-type").val();
		//alert(val);
		//alert($("#custom-sender").length);
		if(val == 0){
			$("#custom-sender").show();
		}
		else
			$("#custom-sender").hide();
		
	});
});