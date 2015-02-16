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
            defaultView: 'agendaDay',
            droppable: false,
            eventLimit: true, // allow "more" link when too many events
            <?php if(isset($lessons)): ?>
            events: [
            <?php foreach ($lessons as $lesson): ?>
                {
                    title: 'Quran Session',
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
			<button class="btn btn-default content-frame-left-toggle">
				<span class="fa fa-bars"></span>
			</button>
		</div>
	</div>
	<!-- END CONTENT FRAME TOP -->

	<!-- START CONTENT FRAME LEFT -->
	<div class="content-frame-left">
		<h4>New Lessons</h4>
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" id="new-event-text" placeholder="Event text..."/>
				<div class="input-group-btn">
					<button class="btn btn-primary" id="new-event">
						Add
					</button>
				</div>
			</div>
		</div>

		<h4>Pending Lessons</h4>
		<div class="list-group border-bottom" id="external-events">
			<a class="list-group-item external-event">Lesson 1</a>
			<a class="list-group-item external-event">Lesson 2</a>
			<a class="list-group-item external-event">Lesson 3</a>
			<a class="list-group-item external-event">Lesson 4</a>
			<a class="list-group-item external-event">Lesson 5</a>
			<a class="list-group-item external-event">Lesson 6</a>
		</div>

		<div class="push-up-10">
			<label class="check">
				<input type="checkbox" class="icheckbox" id="drop-remove"/>
				Remove after drop </label>
		</div>
	</div>
	<!-- END CONTENT FRAME LEFT -->

	<!-- START CONTENT FRAME BODY -->
	<div class="content-frame-body padding-bottom-0">

		<div class="row">
			<div class="col-md-12">
				<div id="alert_holder"></div>
				<div class="calendar">
					<div id="calendar"></div>
				</div>
			</div>
		</div>

	</div>
	<!-- END CONTENT FRAME BODY -->

</div>
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
