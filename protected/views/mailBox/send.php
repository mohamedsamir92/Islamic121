

<div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">
                        <div class="page-title">                    
                            <h2><span class="fa fa-pencil"></span> Compose</h2>
                        </div>
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame">
                    	
                        <div class="block">
                        <form action="index.php?r=MailBox/send" method="post" role="form" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-danger"><span class="fa fa-envelope"></span> Send Message</button>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">To:</label>
                                <div class="col-md-11">                                        
                                    <select name="sender_type" id="sender-type" class="form-control select">
                                        <option value="0">Custom</option>
                                        <option value="1">All Students</option>
                                        <option value="2">All Teachers</option>
                                        <option value="4">All Supervisors</option>
                                        <option value="3">All Admins</option>
                                        <option value="5">All Users</option>
                                                                                
                                    </select>
                                </div>
                            </div>                       
                            <div id="custom-sender" class="form-group">
                                <label class="col-md-1 control-label"></label>
                                <div class="col-md-11">                                        
                                    <input name="receivers" type="text" class="tagsinput" data-placeholder="add username"/>                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">Subject:</label>
                                <div class="col-md-11">                                        
                                    <input name="subject" type="text" class="form-control"/>                                
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">                            
                                    <textarea name="content" class="summernote_email">
                                    </textarea>                            
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-danger"><span class="fa fa-envelope"></span> Send Message</button>
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->                
                
                
                <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>       
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <!-- END THIS PAGE PLUGINS-->        
<script>
        $(function() {
   
            var data_1 = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];
    
            $("#quick-search").autocomplete({
                source: data_1,
                open: function(event, ui) {
                    
                    var autocomplete = $(".ui-autocomplete:visible");
                    var oldTop = autocomplete.offset().top;
                    var newTop = oldTop - $("#quick-search").height() + 25;
                    autocomplete.css("top", newTop);
                    
                }
            });
            
        });            
        </script>
        <script type="text/javascript" src="js/send_script.js"></script>


