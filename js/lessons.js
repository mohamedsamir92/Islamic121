$("document").ready(function(){
	$("#from,#to").change(function(){
		var from = $("#from").val();
		var to = $("#to").val();
		$("#DataTables_Table_0 tbody").empty();
		$.ajax("index.php?r=lessons/getLessons&from="+from+"&to="+to,{
			success:function(data){
				var obj = jQuery.parseJSON(data);
				for(var i =0;i<obj.length;i++){
					var toAppend = '<tr role="row">';
					toAppend += '<td>'+obj[i][0]+'</td>';
					toAppend += '<td>'+obj[i][1]+'</td>';
					toAppend += '<td>'+obj[i][2]+'</td>';
					toAppend += '<td>'+obj[i][3]+'</td>';
					toAppend += '<td>'+obj[i][4]+'</td>';
					if(obj[i][5] == "Not Started")
						toAppend += '<td><span class="label label-default">'+obj[i][5]+'</span></td>';
					else if(obj[i][5] == "In Progress")
						toAppend += '<td><span class="label label-warning">'+obj[i][5]+'</span></td>';
					else
						toAppend += '<td><span class="label label-info">'+obj[i][5]+'</span></td>';
					toAppend += '<td>';
					toAppend += '<div  class="btn-group">';
					toAppend += '<a href="index.php?r=lessons/lessonState&id='+obj[i][6]+'" class="btn btn-default btn-condensed"> <i class="fa fa-eye"></i> </a>';
					toAppend += '<a href="#'+obj[i][6]+'" class="btn btn-default btn-condensed"> <i class="fa fa-pencil"></i> </a>';
					toAppend += '<a href="#'+obj[i][6]+'" class="btn btn-danger btn-condensed"> <i class="fa fa-times"></i> </a>';
					toAppend += '</div>';
					toAppend += '</td>';
					toAppend += '</tr>';
					
					$("#DataTables_Table_0 tbody").append(toAppend);
					
				}
				
			},
			async : false
		});
		/*$("#DataTables_Table_0").dataTable().fnDestroy();
		$('#DataTables_Table_0').dataTable({
			"ajax" : "index.php?r=lessons/getLessons&from="+from+"&to="+to,
			"fnInitComplete":function(){
				$('#DataTables_Table_0 tbody tr').each(function(i, obj) {
		    		//test
		    		alert($( this ).find('td').eq(0).val);
				});
			}
			
		});
		
		*/
	});
});
