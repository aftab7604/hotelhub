<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Chat Page</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                <li class="active">Chat Page</li>
            </ol>
        </div>
    </div>
    <div style="display:none;" id="loader_main" class="loader_main"> <div class="loader"></div></div>
    <div class="mob_chat_user_icon bg-title"><button type="button" onclick="show_mob_chatlist();"><i class="ti-menu"></i></button></div>
    <div class="chat-main-box" style="min-height:500px; overflow-y:visibleeeee">
        <div class="chat-left-aside">
            <div class="chat-left-inner">
                <div class="form-material searchbar">
                    <input class="form-control p-20" type="text" placeholder="Search Contact">
                </div>
                <ul class="chatonline style-none" id="ajax_sidebar">
                	<?php $hotel_id	= $this->session->userdata['logged_in']['firm_id'];
						if(is_array($left_sidebar)){foreach($left_sidebar as $sidebar_chat){
						if($sidebar_chat->type == 'private'){
							if($this->session->userdata['logged_in']['id'] == $sidebar_chat->recipient_id){$user_id = $sidebar_chat->sender_id;}else{$user_id = $sidebar_chat->recipient_id;}
							$user_info = admin_helper::get_user_name($user_id);
							if($user_info[0]->logo != ''){
								$user_logo	= base_url().'assets/images/user_profile_images/'.$user_info[0]->logo;
							}else{
								$user_logo	= base_url().DEFAULT_PROFILE_IMAGE;
							}
							$unseen_messages = admin_helper::get_count_unseen_messages('single', $hotel_id, $sidebar_chat->r_id, $user_id);
					?>
                    	<li id="user_<?php echo $sidebar_chat->r_id; ?>" onclick="get_messages('<?php echo $sidebar_chat->r_id; ?>', '<?php echo $user_info[0]->id; ?>', '<?php echo $user_info[0]->first_name; ?>', '0');"><a href="javascript:void(0)" class="chat-user"><img src="<?php echo $user_logo;?>" alt="user-img" class="img-circle">
                        	<span><?php echo $user_info[0]->first_name. ' ' .$user_info[0]->last_name; ?> 
							<?php if($user_info[0]->is_online == '1'){ ?>
                                <i class="fa fa-circle m-r-5 text-success" style="font-size:9px;"></i>
                            <?php }else{?>
                                <i class="fa fa-circle m-r-5 text-muted" style="font-size:9px;"></i>
                            <?php }?>
                            <?php if($unseen_messages[0]->unseen > 0){?>
                            	<span class="label label-rouded label-warning pull-right"><?php echo $unseen_messages[0]->unseen;?></span>
                            <?php }?>
                            <!--<span class="fa fa-circle text-warning m-r-10 pull-right"></span>-->
							<?php if($user_info[0]->is_online == '1'){ ?><small class="text-success">Online</small><?php }else{?><small class="text-danger">Offline</small><?php }?></span></a></li>
                    <?php }else{
							$group_info = admin_helper::group_info($sidebar_chat->group_id);
							if($group_info[0]->group_image != ''){
								$group_logo	= base_url().'assets/images/group_chat_images/'.$group_info[0]->group_image;
							}else{
								$group_logo	= base_url().DEFAULT_PROFILE_IMAGE;
							}
							$login_user_id		= $this->session->userdata['logged_in']['id'];
							$unseen_messages	= admin_helper::get_count_unseen_messages('group', $hotel_id, $sidebar_chat->r_id, $login_user_id);
					?>
                    	<li id="user_<?php echo $sidebar_chat->r_id; ?>" onclick="get_messages('<?php echo $sidebar_chat->r_id; ?>', '0', '<?php echo $group_info[0]->group_name; ?>', '<?php echo $sidebar_chat->group_id; ?>');"><a href="javascript:void(0)" class="chat-user"><img src="<?php echo $group_logo;?>" alt="user-img" class="img-circle" /><span><?php echo $group_info[0]->group_name; ?></span>
                        	<?php if($unseen_messages[0]->unseen > 0){?>
                            	<span><span class="label label-rouded label-warning pull-right"><?php echo $unseen_messages[0]->unseen;?></span></span>
                            <?php }?>
                        </a></li>
                    <?php }?>
                        <!--text-muted, text-danger, text-warning-->
                    <?php }}?>
                    <li class="p-20"></li><li class="p-20"></li><li class="p-20"></li>
                </ul>
            </div>
        </div>
        <div class="chat-right-aside">
            <div class="chat-main-header">
                <div class="b-b" style="padding:10px 10px 8px 10px;"><h3 class="box-title" style="line-height: 20px;"><span id="user_name">Message</span> <p title="Create Group" style="float:right; cursor:pointer;"><i class="fa fa-group" data-toggle="modal" data-target="#group_chat"></i></p><p title="Personal Message" style="float:right;margin-right: 15px; cursor:pointer;"><i class="fa fa-plus" data-toggle="modal" data-target="#personal_chat"></i></p></h3></div>
            </div>
            <div class="chat-box">
                <ul class="chat-list slimscroll p-t-30"></ul>
                <div class="row send-chat-box">
                    <div class="col-sm-12"><form enctype="multipart/form-data" id="sendmessage">
                    	<input type="hidden" id="r_id" value="">
                    	<input type="hidden" id="g_id" value="">
                    	<input type="hidden" id="res_id" value="">
                        <textarea class="form-control" id="text_message" placeholder="Type your message"></textarea>
                        <div class="custom-send" id="custom-send">
                        	<a href="javascript:;" onclick="showMessageEmojies();" class="cst-icon" data-toggle="tooltip" title="Insert Emojis" data-original-title="Insert Emojis"><i class="ti-face-smile"></i></a>
                            <div class="fileupload btn btn-info waves-effect waves-light"><span><i class="fa fa-paperclip"></i></span><input type="file" class="upload" id="file" name="file" value="" title="Upload File" /></form></div>
                        	<!--<a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="Insert Emojis"><i class="ti-face-smile"></i></a>
                        	<a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="File Attachment"><i class="fa fa-paperclip"></i></a>-->
                            <button class="btn btn-danger btn-rounded" type="button" onclick="post_message();">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="personal_chat" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Personal Message</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="" action="" method="post" enctype="multipart/form-data">
                        <div class="row m-b-10">
                            <div class="col-md-12">
                                <label>Select any contact:</label>
                                <select class="form-control select2" id="single_message" required>
									<option value="0">-Select any contact-</option>
									<?php if(is_array($hotel_users)){foreach($hotel_users as $users){?>
                                    <option value="<?php echo $users->id; ?>"><?php echo $users->first_name. ' ' .$users->last_name; ?></option>
                                    <?php }} ?>
                            	</select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="submit" class="btn btn-primary">Create Group</button>-->
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>                                               
            </div>
        </div>
    </div>
    <div id="group_chat" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Create a Group</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url();?>message/create_group_chat" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="group">
                        <div class="row m-b-10">
                            <div class="col-md-12">
                                <label>Group Name:</label>
                                <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" required="required">
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Assign Users:</label>
                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="group_users[]" data-placeholder="Choose" required>
									<?php if(is_array($hotel_users)){foreach($hotel_users as $users){?>
                                    <option value="<?php echo $users->id; ?>"><?php echo $users->first_name; ?></option>
                                    <?php }} ?>
                            	</select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create Group</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>                                               
            </div>
        </div>
    </div>
    
    <!-- Group Members Model -->
	<div id="group_members" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Group Members</h4>
                </div>
                <div class="modal-body">
					<div class="row m-b-10">
						<div class="col-md-12">
                            <label>Member Names:</label>
                        </div>
					</div>	                            
                </div>                                               
            </div>
        </div>
    </div>

</div>
<style>
	.selected_chat{
		background-color:#e1e8ed;
	}
	.chat-list .chat-image img{
		width:50px;
		height:50px;
	}
	.chatonline img{
		width:40px;
		height:40px;
	}
	.chat-text {
		text-align: left !important;
	}
	.mob_chat_user_icon{
		display:none;
	}
	.emojiPicker{
		top:450px !important;
	}
	.text-warning {
		color: #fb4 !important;
	}
	@media(max-width:767px){
		.mob_chat_user_icon{
			display:block;
		}
	}
</style>

<script>
	function filePreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#custom-send + img').remove();
				$('#custom-send').after('<img src="'+e.target.result+'" width="200" height="100"/>');
			};
			reader.readAsDataURL(input.files[0]);
		}
		//$('#uploadForm + embed').remove();
		//$('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
	}
	function showMessageEmojies(){
		$('#text_message').emojiPicker({width:'300px', height: '200px', button: false});
		$('#text_message').emojiPicker('toggle');
	}
	
	$('.searchbar > input').on('keyup', function() {
		var rex = new RegExp($(this).val(), 'i');
		$('.chat-user').hide();
		$('.chat-user').filter(function() {
			return rex.test($(this).text());
		}).show();
	});
	/*$(function () {
		$('#text_message').emoji({
			place: 'after', //after //before
			button: '&#x1F642;',
			fontSize: '20px', 
			emojis: ['&#x1F642;', '&#x1F641;', '&#x1f600;', '&#x1f601;', '&#x1f602;', '&#x1f603;', '&#x1f604;', '&#x1f605;', '&#x1f606;', '&#x1f607;', '&#x1f608;', '&#x1f609;', '&#x1f60a;', '&#x1f60b;', '&#x1f60c;', '&#x1f60d;', '&#x1f60e;', '&#x1f60f;', '&#x1f610;', '&#x1f611;', '&#x1f612;', '&#x1f613;', '&#x1f614;', '&#x1f615;', '&#x1f616;', '&#x1f617;', '&#x1f618;', '&#x1f619;', '&#x1f61a;', '&#x1f61b;', '&#x1f61c;', '&#x1f61d;', '&#x1f61e;', '&#x1f61f;', '&#x1f620;', '&#x1f621;', '&#x1f622;', '&#x1f623;', '&#x1f624;', '&#x1f625;', '&#x1f626;', '&#x1f627;', '&#x1f628;', '&#x1f629;', '&#x1f62a;', '&#x1f62b;', '&#x1f62c;', '&#x1f62d;', '&#x1f62e;', '&#x1f62f;', '&#x1f630;', '&#x1f631;', '&#x1f632;', '&#x1f633;', '&#x1f634;', '&#x1f635;', '&#x1f636;', '&#x1f637;', '&#x1f638;', '&#x1f639;', '&#x1f63a;', '&#x1f63b;', '&#x1f63c;', '&#x1f63d;', '&#x1f63e;', '&#x1f63f;', '&#x1f640;', '&#x1f643;', '&#x1f4a9;', '&#x1f644;', '&#x2620;', '&#x1F44C;','&#x1F44D;', '&#x1F44E;', '&#x1F648;', '&#x1F649;', '&#x1F64A;'],
			listCSS: {
			  position: 'absoluteee', 
			  border: '1px solid gray', 
			  //background-color: '#000', 
			  display: 'none',
			},
			rowSize: 15,
		});
	});*/
$(document).ready(function () {
	$("#file").change(function () {
		filePreview(this);
	});
	$('.image-popup-no-margins').magnificPopup({type: 'image'});
	/*Create Personal Chat*/
	$('#single_message').change(function(e){
		var user_id		= $(this).val();
		var data_string	= "recipient_id="+user_id+"&type=private";
		$.ajax({
			url:"<?php echo site_url("message/create_private_chat") ?>",
			method: "POST",
			data: data_string,
			success:function(data){
				load_sidebar();
				get_messages(data, user_id, 'New Chat', 0);
				$('#personal_chat').modal('hide');
			}
		});
	});	
	
	/*Empty Message input and hide box*/
	$('.chat-list').html('');
	$('.send-chat-box').hide();
	
	/*Left Sidebar chat list panel*/
	$('.chat-list').slimScroll({
		height: '100%',
		position: 'right',
		size: "7px",
		color: '#dcdcdc',
		start: 'bottom',
	});
	
	//Load New Messages every 3 seconds
	setInterval(function(){
		var r_id	= $('#r_id').val();
		if(r_id != '' && $('.chat-main-box').is(':visible')){
			var data_string = "r_id="+r_id;
			$.ajax({
				url:"<?php echo site_url("message/load_chat") ?>",
				method: "POST",
				data: data_string,
				success:function(data){
					$('.chat-list').html(data);
					$('.send-chat-box').show();
					
					$('.chat-list').slimScroll({ scrollTo: $('.chat-list')[0].scrollHeight });
				}
			});
		}
	}, 5000);
	setInterval(function(){
		var r_id	= $('#r_id').val();
		load_sidebar();
	}, 10000);
	
	//Press Enter Message will be sent.
	$('#text_message').keydown(function (e) {
		if (e.which == 13) {
			post_message();
		}
	});
	
	window.scrollTo(0,document.body.scrollHeight);
	
	//User is typing
	$("#text_message").keyup(function(){
		var r_id			= $('#r_id').val();
		var text_message	= $('#text_message').val();
		var message_length	= text_message.length;		
		
		if(message_length > 0){
			var typing = 1;
		}else{
			var typing = 0;
		}
		console.log('Typing ='+typing);
		var data_string = "r_id="+r_id+"&typing="+typing;
		$.ajax({
			url:"<?php echo site_url("message/user_typing") ?>",
			method: "POST",
			data: data_string,
			success:function(data){}
		});
	});
});

	$(function () {
		$(window).on("load", function () { // On load
			$('.chatonline').css({
				'height': (($(window).height()) - 240) + 'px'
			});
			//
			$('.chat-list').css({
				'height': (($(window).height()) - 400) + 'px'
			});
		});
		$(window).on("resize", function () { // On resize
			clearTimeout(this.resizeTimeout);
			this.resizeTimeout = setTimeout(function () {
				$('.chatonline').css('height', ($(window).height() - 240) + 'px');
				$('.chat-list').css('height', ($(window).height() - 400) + 'px');
			}, 200); // Debounce resize
		});
	});
	
	//Show Chat List on Mobile window.innerWidth;
	function show_mob_chatlist(){
		$('.chat-left-aside').css('left', '0px');
	}

	//Load First Time Messages
	function get_messages(r_id, res_id, user_name, g_id){
		$(".chatonline>li").removeClass("selected_chat");
		$('#user_'+r_id).addClass('selected_chat');
		
		if(window.innerWidth <= '767'){
			$('.chat-left-aside').css('left', '-250px');
		}
			
		$('#user_name').html(user_name);
		$('#r_id').val(r_id);
		$('#g_id').val(g_id);
		$('#res_id').val(res_id);
		
		$('.chat-list').html('');
		$('#text_message').val('');
		
		$('#loader_main').show();
		
		var data_string = "r_id="+r_id;
		$.ajax({
			url:"<?php echo site_url("message/load_chat") ?>",
			method: "POST",
			data: data_string,
			success:function(data){
				$('.chat-list').html(data);
				$('#loader_main').hide();
				$('.send-chat-box').show();
				
				var bottomCoord = $('.chat-list')[0].scrollHeight;
				$('.chat-list').slimScroll({scrollTo: bottomCoord});
			}
		});
	}

	//Send Message
	function post_message(){
		var r_id			= $('#r_id').val();
		var g_id			= $('#g_id').val();
		var res_id			= $('#res_id').val();
		var res_name		= $('#user_name').html();
		var text_message	= $('#text_message').val();
		
		var fd				= $('#sendmessage')[0];
		var form			= new FormData(fd);
		
		form.append('recipient_id', res_id);
		form.append('r_id', r_id);
		form.append('group_id', g_id);
		form.append('recipient_name', res_name);
		form.append('text_message', text_message);
		
		//var data_string = "recipient_id="+res_id+"&r_id="+r_id+"&group_id="+g_id+"&recipient_name="+res_name+"&text_message="+text_message;
		$.ajax({
			url:"<?php echo site_url("message/send_message") ?>",
			method: "POST",
			data: form,
			contentType: false,
			cache: false,
			processData:false,
			success:function(data){
				load_sidebar();
				$('#text_message').val('');
				$('#file').val('');
				$('#custom-send + img').remove();
				
				$.ajax({
					url:"<?php echo site_url("message/load_chat") ?>",
					method: "POST",
					data: data_string,
					success:function(data){
						//$('#loader_main').hide();
						$('.chat-list').html(data);
						var bottomCoord = $('.chat-list')[0].scrollHeight;
						$('.chat-list').slimScroll({scrollTo: bottomCoord});
					}
				});
			}
		});
	}
	
	//Load Sidebar On New Message
	function load_sidebar(){
		$.ajax({
			url:"<?php echo site_url("message/load_left_sidebar") ?>",
			method: "GET",
			success:function(data){
                if ($('#ajax_sidebar').html() !== data) { // Only update if content has changed
                    $('#ajax_sidebar').html(data);
                }				$('.chatonline').slimScroll();
			}
		});
	}
	
	//get gorup members names
	$("#user_name").click(function () {
        let g_id = $("#g_id").val();

		if(g_id !== '0') {
			$.ajax({
				url:"<?php echo site_url("message/get_group_members") ?>",
				method: "POST",
				data: { g_id: g_id }, // Send as an object
            	dataType: "json", // Ensure JSON response
				success:function(data){
					// Clear previous content
					$("#group_members .modal-body").html('<label>Member Names:</label><ul id="member_list"></ul>');

					// Populate modal with members
					if (Array.isArray(data) && data.length > 0) {
						data.forEach(member => {
							$("#member_list").append("<li>" + member + "</li>");
						});
					} else {
						$("#member_list").append("<li>No members found.</li>");
					}

					// Show the modal
					$("#group_members").modal("show");
				},
				error: function (xhr, status, error) {
                	console.error("AJAX Error:", status, error);
            	}
			});
		}		
	});
</script>