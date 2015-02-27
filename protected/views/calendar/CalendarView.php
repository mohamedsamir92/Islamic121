            
<script>

    $(document).ready(function() {
        
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
			defaultDate: '<?php if(count($lessons)>0){ 
            					echo $lessons[0]->expected_start_time; 
            				}
else echo "2015-02-16 18:08:00";
            ?>',
            defaultView: 'month',
            droppable: false,
            eventLimit: true, // allow "more" link when too many events
            <?php if(isset($lessons)): ?>
            events: [
            <?php foreach ($lessons as $lesson): ?>
                <?php if(Yii::app()->user->type == "Student")
                	$info = "Teacher: " . $lesson -> teacher -> first_name . " " . $lesson -> teacher -> last_name;
				else if(Yii::app()->user->type == "Teacher")
					$info = "Student: " . $lesson -> student -> first_name . " " . $lesson -> student -> last_name;
				else
					$info = "Teacher: " . $lesson -> teacher -> first_name . " " . $lesson -> teacher -> last_name;
				$tok = strtok($lesson->expected_end_time, " ");
				$tok = strtok(" ");
				$tok = date("g:i a", strtotime($tok));
				$tok = substr($tok, 0 , strlen($tok)-1);
				
				?>
                {
                    title: ' - <?php echo $tok ?> Quran \n <?php echo $info; ?> <?php if(Yii::app()->user->type == "Admin"): ?> \n <?php echo "Student: " . $lesson -> student -> first_name . " " . $lesson -> student -> last_name; endif; ?>',
                    start: '<?php echo $lesson->expected_start_time ?>',
                    end: '<?php echo $lesson->expected_end_time ?>'
                    
                },
                <?php endforeach; ?>
                
            ]
            <?php endif; ?>
        });
        
    });

</script>

<div class="page-content-wrap">



                </div>
                <!-- END PAGE CONTENT WRAPPER -->
                <!-- START CONTENT FRAME -->
                <div class="content-frame">
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">
                        <div class="page-title">
                            <h2><span class="fa fa-calendar"></span> Calendar</h2>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>
                    </div>
                    <!-- END CONTENT FRAME TOP -->

                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body-left padding-bottom-0">

                        <div class="row"> <br> </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_holder"></div>
                                <div class="calendar">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row"> <br> </div>

                    </div>
                    <!-- END CONTENT FRAME BODY -->

                </div>
                <!-- END CONTENT FRAME -->
                <!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END THIS PAGE PLUGINS-->
