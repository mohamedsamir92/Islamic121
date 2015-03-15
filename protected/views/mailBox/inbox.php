<!-- START CONTENT FRAME -->
                
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-inbox"></span> Inbox <small></small></h2>
                        </div>
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <button class="btn btn-default"><span class="fa fa-mail-reply"></span></button>
                                    <button class="btn btn-default"><span class="fa fa-mail-reply-all"></span></button>
                                </div>

                                <button class="btn btn-default"><span class="fa fa-trash-o"></span></button>

                            </div>
                            <div class="panel-body mail">
                            	<?php 
                            	$i=0;
                            	foreach ($allMsgs as $message): ?>
                            	<div class="mail-item <?php if($message->seen == 0):  ?> mail-unread <?php endif; ?>">
                                    <div class="mail-checkbox">
                                        <span class="fa fa-envelope"></span>
                                    </div>
                                    <div class="mail-user"><?php echo $senders[$i] ?></div>                                    
                                    <a href="index.php?r=MailBox/message&id=<?php echo $message->message["id"];  ?>" class="mail-text"><?php echo $message->message["subject"] ?></a>                                    
                                    <div class="mail-date"><?php echo $message->message["date"] ?></div>
                                </div>
                                <?php $i++; ?>
                            	<?php endforeach; ?>
                                
                            </div>
                            <div class="panel-footer">                                
                                <div class="btn-group">
                                    <button class="btn btn-default"><span class="fa fa-mail-reply"></span></button>
                                    <button class="btn btn-default"><span class="fa fa-mail-reply-all"></span></button>
                                </div>

                                <button class="btn btn-default"><span class="fa fa-trash-o"></span></button>                                    
                                
                                <ul class="pagination pagination-sm pull-right">
                                    <li class="disabled"><a href="#">«</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>                                    
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>                            
                        </div>
                        
                    </div>
                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->
                
                <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>     
        
                