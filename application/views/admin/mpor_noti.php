<script>
$(document).ready(function(){
	$.toast().reset('all');
	<?php if(is_array($user_notification)){foreach($user_notification as $notify){
	if($notify->notify_tone==1){?>
		playSound('bing');
	<?php }?>

    if (!window.activeToasts) {
        window.activeToasts = {};
    }

    // If this notification is already displayed, do not show it again
    if (!window.activeToasts[<?php echo $notify->n_id; ?>]) {
        let newToast = $.toast({
            heading: '<?php echo $notify->txt_hdn; ?>',
            text: '<?php echo $notify->txt_bdy; ?>',
            position: 'top-right',
            loaderBg: '#000000',
            icon: '<?php echo $notify->txt_type; ?>',
            showHideTransition: 'fade',
            hideAfter: false,
            stack: 60,
            <?php if($notify->notify_tone==1){ ?>
                beforeShow: function(){
                    var data_string = "n_id="+<?php echo $notify->n_id; ?>+"&notify_tone=0&method_type=notification_tone";
                    $.ajax({
                        url: "<?php echo site_url("mpor/update_notifications/") ?>",
                        type: "POST",
                        data: data_string,
                        success: function(data){}
                    });
                },
            <?php } ?>
            afterHidden: function(){
                var data_string = "n_id="+<?php echo $notify->n_id; ?>+"&status=seen&method_type=notification_seen";
                $.ajax({
                    url: "<?php echo site_url("mpor/update_notifications/") ?>",
                    type: "POST",
                    data: data_string,
                    success: function(data){}
                });
                // Remove from active toasts
                delete window.activeToasts[<?php echo $notify->n_id; ?>];
            }
        });

        window.activeToasts[<?php echo $notify->n_id; ?>] = newToast;
    }
<?php }}?>
<?php if(is_array($dept_notification)){foreach($dept_notification as $notify){
	if($notify->notify_tone==1){?>
		playSound('bing');
	<?php }?>
	$.toast({
            heading: '<?php echo $notify->txt_hdn;?>',
            text: '<?php echo $notify->txt_bdy;?>',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: '<?php echo $notify->txt_type;?>',
            showHideTransition: 'fade',
            hideAfter: false,
            stack: 60,
		<?php if($notify->notify_tone==1){?>
			beforeShow: function(){
				var data_string = "n_id="+<?php echo $notify->n_id;?>+"&notify_tone=0&method_type=notification_tone";
				$.ajax({
					url: "<?php echo site_url("mpor/update_notifications/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){}
				});
			},
		<?php }?>
        	afterHidden: function(){
				var data_string = "n_id="+<?php echo $notify->n_id;?>+"&status=seen&method_type=notification_seen";
				$.ajax({
					url: "<?php echo site_url("mpor/update_notifications/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){}
				});
			}
        });
<?php }}?>
<?php if(is_array($sys_lockdown)){foreach($sys_lockdown as $lockdown){?>
	$('.sidebar').css('zIndex', '0');
	$('.fix-header .navbar-static-top').css('zIndex', '9');
	playSound('bing');

	<?php if(isset($this->session->userdata['logged_in']['role']) && ($this->session->userdata['logged_in']['role'] == '8' ||  $this->session->userdata['logged_in']['role'] == '2')){?>
		swal({
			title: 'SYSTEM LOCKDOWN',
			type: "error",
			allowOutsideClick: false,
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Lift Lockdown",
			html: '<span>Lockdown Initiated by <?php $username = admin_helper::get_user_name($lockdown->user_id);echo ucfirst($username[0]->username);?>
			<br>Emergency:  <?php echo $lockdown->emergency_type;?>
			<br>Location:  <?php echo $lockdown->location;?>
			<br><?php echo htmlspecialchars_decode($lockdown->notes);?></span>'
		},	function(isConfirm){
				if(isConfirm){
					var data_string = "e_id=<?php echo $lockdown->e_id;?>&status=0&method_type=completed";
					$.ajax({
						url: "<?php echo site_url("emergency/update_emergency/")?>",
						type: "POST",
						data: data_string,
						success: function(data){location.reload();
						}
					});
				}
			}
		);
	<?php }else{?>
		swal({
			title: 'SYSTEM LOCKDOWN',
			type: "error",
			allowOutsideClick: false,
			showCancelButton: false,
			showConfirmButton: false,
			html: '<span>Lockdown Initiated by <?php $username = admin_helper::get_user_name($lockdown->user_id);echo ucfirst($username[0]->username);?>
			<br>Emergency:  <?php echo $lockdown->emergency_type;?>
			<br>Location:  <?php echo $lockdown->location;?>
			<br><?php echo htmlspecialchars_decode($lockdown->notes);?></span>'
		});
	<?php }
	}}else{?>
	swal.closeModal();
<?php }?>
});
</script>