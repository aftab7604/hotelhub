	<style>
	    .datepicker {
            z-index: 9999 !important;
            position: absolute !important;
        }
        
        .ui-datepicker {
            position: fixed !important;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }
        
		.goog-te-banner-frame,.custom-translate {
			display: none;
		}
		body {
			top: 0 !important;
		}
		.goog-tooltip {
			display: none !important;
		}
		.goog-tooltip:hover {
			display: none !important;
		}
		.goog-text-highlight {
			background-color: transparent !important;
			border: none !important; 
			box-shadow: none !important;
		}
		#mceu_89-body, #mceu_58-body, #mceu_120-body{display:none !important;}
		/*#side-menu li a{ color:#97999f !important}*/
		/*.nav li span{
			color: #000;
		}*/
		/*.sidebar .sidebar-head {
			padding: 4px 20px;
			width: 240px;
			position: fixed;
			z-index: 999;
			left: 0;
			top: 0;
			background: #fff;
		}*/
		#side-menu{
			position: relative;
			z-index: 11;
		}
		/*.sidebar .sidebar-head {
			z-index: 999;
			background: #000 !important;
		}*/
	</style>
			<!-- /.container-fluid -->
            <footer class="footer text-center"> <?php echo date("Y");?> &reg; HOPS 247 - All Rights Reserved <!--Develope by 
            <a href="https://www.fiverr.com/php_developer_6/fix-any-php-javascript-jquery-htmlcss-bugs?funnel=4dcb841e-1a6f-409f-a534-0b89f04facd6">Luqman R.</a>--> </footer>
        </div>
        <!-- ==============================================================-->
        <!-- End Page Content -->
        <!-- ==============================================================-->
        <div id="sound"></div>
        <div id="noti"></div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!--<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
    <!-- Bootstrap Core JavaScript -->
    <!--<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--chat JavaScript -->
    <!--<script src="<?php echo base_url();?>assets/js/chat.js"></script>-->
    <!-- Magnific popup JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <!-- MULTI Select JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!-- Calendar JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/moment/moment.js"></script>
    <script src='<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>
    
	<?php if($this->uri->segment(2) == 'calendar'){?>
    	<script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/cal-init-events.js?<?php echo time();?>"></script>
    <?php }else{?>
    	<script src="<?php echo base_url();?>assets/plugins/bower_components/calendar/dist/cal-init.js?<?php echo time();?>"></script>
    <?php }?>
    <!-- Footable -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/footable/js/footable.all.min.js"></script>
    <!-- Clock Plugin JavaScript -->
    <!-- Im using clock css but i dont know where, thats why commenting -->
    <!--<link href="<?php echo base_url();?>assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">-->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!--FooTable init-->
    <script src="<?php echo base_url();?>assets/js/footable-init.js"></script>
    <!-- jQuery for carousel -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/owl.carousel/owl.custom.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <script src="<?php echo base_url();?>assets/js/cbpFWTabs.js"></script>
    <!-- Sweet-Alert  -->
    <?php //if($this->uri->segment(2) == 'my_board'){?>
    	<link href="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css">
    	<script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert2.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <?php //}else{?>
    	<!--<link href="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
		<script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>-->
    <?php //}?>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <!--<script src="<?php echo base_url();?>assets/js/custom.min.js"></script>-->
    <script src="<?php echo base_url();?>assets/js/custom.js?<?php echo time();?>"></script>
    <!--DataTables -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jasny-bootstrap.js"></script>
    <!--Mentions-->
    <link href='<?php echo base_url();?>assets/css/jquery.mentionsInput.css' rel='stylesheet' type='text/css'>
    <script src='<?php echo base_url();?>assets/js/underscore-min.js' type='text/javascript'></script>
    <script src='<?php echo base_url();?>assets/js/jquery.events.input.js' type='text/javascript'></script>
    <script src='<?php echo base_url();?>assets/js/jquery.elastic.js' type='text/javascript'></script>
    <script src='<?php echo base_url();?>assets/js/jquery.mentionsInput.js' type='text/javascript'></script>
    <!--Tinymce Editor-->
    <!--<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=yz7pdwlbipbaf6318sszxx1ww4de2gzggllojz1j210yadef"></script>    
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
    
    <!-- <script src="//cdn.tiny.cloud/1/cur38c577ohpv15d5ho0wx9sb0sfubcjo19yk61xojn915mf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    
	<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
	<style>
		.tox-promotion-link,
		.tox-statusbar__branding {
			display: none !important;
		}
	</style>	
	<script>
	    if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', function () {
                let activeElement = document.activeElement;
                if (activeElement.tagName === "INPUT" && activeElement.classList.contains("hasDatepicker")) {
                    $(".ui-datepicker").css("bottom", "120px");
                } else {
                    $(".ui-datepicker").css("bottom", "10px");
                }
            });
        }
        
        $("input.hasDatepicker").on("focus", function () {
            setTimeout(() => {
                window.scrollTo(0, document.body.scrollHeight);
            }, 300);
        });
    
		tinymce.init({
			selector:'textarea#mymce',
			license_key: 'gpl',
			plugins: 'advlist autolink lists link image charmap print preview anchor,searchreplace visualblocks code fullscreen,insertdatetime media table contextmenu paste code',
			// plugins: [
			// 	//'spellchecker',
			// 	'advlist autolink lists link image charmap print preview anchor',
			// 	'searchreplace visualblocks code fullscreen',
			// 	'insertdatetime media table contextmenu paste code'
			//   ],
			spellchecker_languages: 'English=en',
			browser_spellcheck: true,
  			contextmenu: false,
			external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
			nanospell_server: "php",
			toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',			
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			}
		});
		tinymce.init({
			selector:'textarea#notes',
			license_key: 'gpl',
			plugins: [
				//'spellchecker',
			  ],
		    spellchecker_languages: 'English=en',
			browser_spellcheck: true,
  			contextmenu: false,
			external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
			nanospell_server: "php",
			//toolbar: 'spellchecker',			
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			}
		});
		
		<?php if($this->uri->segment(2) == 'picked_tickets' || $this->uri->segment(2) == 'pending_tickets' || $this->uri->segment(2) == 'add_keys' || $this->uri->segment(2) == 'view' || $this->uri->segment(1) == 'settings' ){?>
			tinymce.init({
				selector:'textarea.notes',
				plugins: 'emoticons',
				spellchecker_languages: 'English=en',
				browser_spellcheck: true,
				contextmenu: false,
				external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
				nanospell_server: "php",
				menubar: "false",
				license_key: 'gpl',
				toolbar: 'styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons',		
				setup: function (editor) {
					editor.on('change', function (){
						editor.save();
					});
				}
			});
		<?php } ?>
		
		<?php if($this->uri->segment(2) == 'create_ticket' || $this->uri->segment(1) == 'logbook' || $this->uri->segment(1) == 'welcome_call' || $this->uri->segment(2) == 'manage' || $this->uri->segment(1) == 'mpor' || ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' || $this->uri->segment(2) == 'add_new_case' || $this->uri->segment(2) == 'calendar' || $this->uri->segment(2) == 'add_agenda' || $this->uri->segment(2) == 'ticket_info' || $this->uri->segment(2) == 'mass_survey')){?>
			tinymce.init({
				height: 250,
				selector:'textarea',
					/*plugins: [
						'emoticons',
					],*/
					plugins: 'advlist autolink lists link image charmap print preview anchor emoticons,searchreplace visualblocks code fullscreen,nsertdatetime media table paste imagetools wordcount',

				spellchecker_languages: 'English=en',
				browser_spellcheck: true,
				contextmenu: false,
				external_plugins: {"nanospell": "/assets/nanospell/plugin.js"},
				nanospell_server: "php",
				menubar: "false",
				license_key: 'gpl',
				
				force_br_newlines : true,
				// force_p_newlines : false,
				// forced_root_block : '',
  
				automatic_uploads: true,
				file_picker_types: 'image',
				file_picker_callback: function (cb, value, meta) {
					var input = document.createElement('input');
					input.setAttribute('type', 'file');
					input.setAttribute('accept', 'image');
				
					input.onchange = function () {
					  var file = this.files[0];
					  var reader = new FileReader();
					  reader.onload = function () {
						var id = 'blobid' + (new Date()).getTime();
						var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
						var base64 = reader.result.split(',')[1];
						var blobInfo = blobCache.create(id, file, base64);
						blobCache.add(blobInfo);
						cb(blobInfo.blobUri(), { title: file.name });
					  };
					  reader.readAsDataURL(file);
					};
					input.click();
				},
				
				toolbar: 'styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons | link imagee',
				setup: function (editor) {
					editor.on('change', function (){
						editor.save();
					});
				}
			});
		<?php } ?>
    </script>
    
    <!-- Emojis -->
    <?php if($this->uri->segment(2) == 'picked_tickets' || $this->uri->segment(2) == 'pending_tickets' || $this->uri->segment(2) == 'closed_tickets' || $this->uri->segment(1) == 'message' || $this->uri->segment(1) == 'dashboard'){?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.emojipicker.css">
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.emojipicker.js"></script>
        <!-- Emoji Data -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.emojipicker.tw.css">
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.emojis.js"></script>
    <?php } ?>
    
    <link href="<?php echo base_url();?>assets/css/lightbox.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/js/lightbox.min.js"></script> 
    <!--Style Switcher-->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/spectrum.js"></script>
    <!--On/Off Button-->
	<link href="//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!--Notifications-->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Nestable js -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/nestable/jquery.nestable.js"></script>
    <!--Message Emojis js -->
    <script src="<?php echo base_url();?>assets/js/inputEmoji.js"></script>
    <!-- Chart JS -->
    <!--<script src="<?php echo base_url();?>assets/plugins/bower_components/Chart.js/Chart_custom.js"></script>-->
    <!--DataTables Export Buttons-->
    <?php if($this->uri->segment(2) == 'analytics' || $this->uri->segment(2) == 'statistics' || $this->uri->segment(2) == 'room_breakout' || $this->uri->segment(2) == 'checklist_report' || $this->uri->segment(2) == 'ranker' || $this->uri->segment(2) == 'add_agenda'){?>
        <script src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
        
        <?php if($this->uri->segment(2) == 'add_agenda'){?>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <script src="//mpryvkin.github.io/jquery-datatables-row-reordering/1.2.2/jquery.dataTables.rowReordering.js"></script>
        <?php } ?>
        
		<!--<script src="//cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
        <script src="//editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>-->
        <!--<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>-->
        <!--<link href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.bootstrap.min.css" rel="stylesheet" type="text/css">-->
        <script>
			$(document).ready(function(){
				/*DataTables Export Buttons*/
				$('#myTable_HK_Statistic').DataTable({
					aaSorting: [[0, 'asc']],
			  		"pageLength": 100,
					//dom: 'lBfrtip',//lBfrtip, Bfrtip
					dom: '<"roww view-filter"<"col-sm-12"<"pull-left"l><"pull-right m-l-20"Br><"pull-right"f><"clearfix">>>t<"roww view-pager"<"col-sm-12"<"text-center"ip>>>',
					responsive: true,
					buttons: [
						{extend: 'excelHtml5', footer: true, title: 'Export Excel File', text: 'Export to Excel',
							exportOptions: {
								format: {
									body: function ( data, row, column, node){
										return column === 0 ?
											//data.replace( /[$,]/g, '' ) :
											data.replace( /ECHECKOUTS/g, 'CHECKOUTS' ) :
											data;
									}
								},
								stripHtml: true,							
							}
						},
						{extend: 'pdfHtml5', footer: true, title: 'Export PDF File', text: 'Export to PDF', orientation: 'landscape', pageSize: 'A4', 
							exportOptions: {
								format: {
									body: function ( data, row, column, node){
										data = data.replace(/<.*?>/g, "");
										data = data.replace(/ECHECKOUTS/g, "CHECKOUTS");
										data = data.replace(/zzzzzMPOR AVERAGE/g, "MPOR AVERAGE");
										data = data.replace(/zzzzzSOLD ROOMS/g, "SOLD ROOMS");
        								return $.trim(data);
									}
								},
								stripHtml: true,
							},
						},
						/*{extend: 'copy', title: 'Data export', text: 'Copy Data'},
						{extend: 'print', title: 'Data export', text: 'Print Data'},
						{extend: 'csvHtml5', title: 'Export Excel File', text: 'Export to CSV'}*/
					]
				});
				$('#myTableHKStatistic').DataTable({
					aaSorting: [[0, 'asc']],
			  		"pageLength": 100,
					//dom: 'lBfrtip',//lBfrtip, Bfrtip
					dom: '<"roww view-filter"<"col-sm-12"<"pull-left"l><"pull-right m-l-20"Br><"pull-right"f><"clearfix">>>t<"roww view-pager"<"col-sm-12"<"text-center"ip>>>',
					responsive: true,
					buttons: [
						{extend: 'excelHtml5', title: 'Export Excel File', text: 'Export to Excel',
							exportOptions: {
								format: {
									body: function ( data, row, column, node){
										return column === 0 ?
											//data.replace( /[$,]/g, '' ) :
											data.replace( /ECHECKOUTS/g, 'CHECKOUTS' ) :
											data;
									}
								},
								stripHtml: true,							
							}
						},
						{extend: 'pdfHtml5', title: 'Export PDF File', text: 'Export to PDF', orientation: 'landscape', pageSize: 'A4', 
							exportOptions: {
								format: {
									body: function ( data, row, column, node){
										data = data.replace(/<.*?>/g, "");
										data = data.replace(/ECHECKOUTS/g, "CHECKOUTS");
										data = data.replace(/zzzzzMPOR AVERAGE/g, "MPOR AVERAGE");
										data = data.replace(/zzzzzSOLD ROOMS/g, "SOLD ROOMS");
        								return $.trim(data);
									}
								},
								stripHtml: true,
							},
						},
						/*{extend: 'copy', title: 'Data export', text: 'Copy Data'},
						{extend: 'print', title: 'Data export', text: 'Print Data'},
						{extend: 'csvHtml5', title: 'Export Excel File', text: 'Export to CSV'}*/
					]
				});
				$('#myTable_room_breakout').DataTable({
					aaSorting: [[1, 'asc']],
					responsive: true,
					"pageLength": 100,
					//dom: 'lBfrtip',//lBfrtip, Bfrtip
					dom: '<"roww view-filter"<"col-sm-12"<"pull-left"l><"pull-right m-l-20"Br><"pull-right"f><"clearfix">>>t<"roww view-pager"<"col-sm-12"<"text-center"ip>>>',
					buttons: [
						{extend: 'excelHtml5', title: 'Export Excel File', text: 'Export to Excel',
							exportOptions: {stripHtml: true, columns: [ 1, 2, 7 ]}
						},
						{extend: 'pdfHtml5', title: 'Export PDF File', text: 'Export to PDF', orientation: 'landscape', pageSize: 'A4',
							exportOptions: {stripHtml: true, columns: [ 1, 2, 7 ]}
						}
						//, 'colvis'
						/*{extend: 'copy', title: 'Data export', text: 'Copy Data'},
						{extend: 'print', title: 'Data export', text: 'Print Data'},
						{extend: 'csvHtml5', title: 'Export Excel File', text: 'Export to CSV'}*/
					]
				});
				$('#myTablePMP_chk_rept').DataTable({
					aaSorting: [[1, 'asc']],
					responsive: true,
					"pageLength": 100,
					dom: '<"roww view-filter"<"col-sm-12"<"pull-left"l><"pull-right m-l-20"Br><"pull-right"f><"clearfix">>>t<"roww view-pager"<"col-sm-12"<"text-center"ip>>>',
					buttons: [
						{extend: 'excelHtml5', title: 'Export Excel File', text: 'Export to Excel',
							exportOptions: {stripHtml: true, }
						},
						{extend: 'pdfHtml5', title: 'Export PDF File', text: 'Export to PDF', orientation: 'landscape', pageSize: 'A4',
							exportOptions: {stripHtml: true,}
						}
					]
				});
				var table = $('#PRODUCTIVITY_RANKER').DataTable({
					"columnDefs": [{
						"visible": false,
						"targets": 1
					}],
					"order": [
						[1, 'asc']
					],
					//"displayLength": 50,
					"drawCallback": function(settings) {
						var api = this.api();
						var rows = api.rows({
							page: 'current'
						}).nodes();
						var last = null;
						api.column(1, {
							page: 'current'
						}).data().each(function(group, i) {
							if (last !== group) {
								$(rows).eq(i).before('<tr class="group"><td colspan="8"><strong>' + group + '</strong></td></tr>');
								last = group;
							}
						});
					},
					aaSorting: [[0, 'asc']],
					responsive: true,
					"pageLength": 50,
					dom: '<"roww view-filter"<"col-sm-12"<"pull-left"l><"pull-right m-l-20"Br><"pull-right"f><"clearfix">>>t<"roww view-pager"<"col-sm-12"<"text-center"ip>>>',
					buttons: [
						{extend: 'excelHtml5', title: 'Export Excel File', text: 'Export to Excel', //footer: true,
							exportOptions: {stripHtml: true, }
						},
						{extend: 'pdfHtml5', title: 'Export PDF File', text: 'Export to PDF', orientation: 'landscape', pageSize: 'A4', //footer: true,
							exportOptions: {stripHtml: true,}
						}
					]
				});
				
				// Order by the grouping
				$('#PRODUCTIVITY_RANKER tbody').on('click', 'tr.group', function() {
					var currentOrder = table.order()[0];
					if (currentOrder[0] === 1 && currentOrder[1] === 'asc') {
						table.order([1, 'desc']).draw();
					} else {
						table.order([1, 'asc']).draw();
					}
				});
			});
		</script>
	<?php }?>
    
    <!--e-Signature-->
    <?php if($this->uri->segment(1) == 'key_log' || $this->uri->segment(1) == 'mpor' || $this->uri->segment(2) == 'my_boardss' || $this->uri->segment(2) == 'manager_screen' || $this->uri->segment(2) == 'vendor_signIn' ){?>
		<link href="<?php echo base_url();?>assets/css/jquery.signaturepad.css" rel="stylesheet">
		<script src="<?php echo base_url();?>assets/js/numeric-1.2.6.min.js"></script> 
		<script src="<?php echo base_url();?>assets/js/bezier.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.signaturepad.js"></script> 
		
        <script src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
		<!--<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>-->
		<script src="<?php echo base_url();?>assets/js/json2.min.js"></script>
    <?php }?>
    
    <!--Push Notifications Sound-->
    <script type="text/javascript">
		function playSound(filename){
			document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="/' + filename + '.mp3" type="audio/mpeg" /><source src="/' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="/' + filename +'.mp3" /></audio>';
		}
	</script>
    <!--Push Notifications-->
	<script>
    	//request permission on page load
    	document.addEventListener('DOMContentLoaded', function () {
		if (!Notification) {
			alert('Desktop notifications not available in your browser. Try Chromium.'); 
			return;
		}
    
		if (Notification.permission !== "granted")
			Notification.requestPermission();
		});
		function notifyMe(title, bodyMsg, post_url){
			if (Notification.permission !== "granted")
				Notification.requestPermission();
			else {
				var notification = new Notification(title, {
					icon: 'https://www.hops247.com/assets/images/favicon.png',
					body: bodyMsg,
				});
				notification.onclick = function (){
					window.open(post_url);      
				};
			}		
		}
	</script>
 	<script src="<?php echo base_url();?>assets/js/jquery.plugin.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/timer.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.countdown.min.js"></script>
    <script>
        //upadte top notification status
		function markAsSeen(nt_id) {
			$.ajax({
				url: "<?php echo site_url('mpor/mark_notification_seen'); ?>",
				type: "POST",
				data: { notification_id: nt_id },
				success: function(response) {
							
				}
			});
		}
		$(document).ready(function(){
			<?php if($this->uri->segment(2) != 'my_board' && $this->uri->segment(2) != 'viewww'){?>
			let activeToasts = {}; // Store active notifications by ID
				setInterval(function(){
					var data_string = "method_type=notification_assigned";
					$.ajax({
						url: "<?php echo site_url("mpor/get_notifications/") ?>",
						type: "POST",
						data: data_string,
						success: function(data){
						    // Extract notification IDs from response
							let newNotifications = [];
							$(data).find(".toast-container").each(function(){
								let n_id = $(this).data("n_id");
								newNotifications.push(n_id);
							});

							// Hide old notifications that are not in the latest data
							for (let id in activeToasts) {
								if (!newNotifications.includes(id)) {
									toastr.remove(activeToasts[id]);
									delete activeToasts[id];
								}
							}
							
							$('#noti').html(data);
						}
					});
				}, 20000);
				setInterval(function(){
					var data_string = "method_type=notification_assigned";
					$.ajax({
						url: "<?php echo site_url("mpor/get_top_notifications/") ?>",
						type: "POST",
						data: data_string,
						success: function(data){
							$('.top_notifications').html(data);
							if($('#noti_count').html() == 0) {
								$('#badge').hide();
							} else {
								$('#badge').show();
								$('#badge').html($('#noti_count').html());
							}							
						}
					});
				}, 1000);

			<?php }?>

			<?php if($this->uri->segment(2) == 'manager_screen' || $this->uri->segment(2) == 'live_progress'){?>

				setInterval(function () {
					$.ajax({
						url: "<?php echo site_url('mpor/get_timer/') ?>",
						type: "GET",
						dataType: "json",
						success: function (response) {
							if (response && response.length > 0) {
								response.forEach(function (item, index) {
									var timerElement = $("#timerValue_" + item.mpor_id);
									var gapTimerElement = $("#timerValueeee_" + item.mpor_id);
									var completedTimeElement = $("#completedTime_" + item.mpor_id);
									var startedTimeElement = $("#startedTime_" + item.mpor_id);
									var statusElement = $("#status_" + item.mpor_id);
									var actionElement1 = $("#action1_" + item.mpor_id);
									var actionElement2 = $("#action2_" + item.mpor_id);

									//Update Action Button
									if (actionElement1.length || actionElement2.length) {
										<?php if ($this->session->userdata['logged_in']['role'] == '3') { ?>
											// Role 3: Inspector
											if (item.approved == "Approved") {
												var username = item.inspected_by_name ? item.inspected_by_name : "Unknown";
												actionElement1.html("Approved by " + username);
											} else if (item.approved == "Normal Re-Inspect" || item.approved == "Re-Inspect") {
												actionElement1.html("Normal Re-Inspect");
											} else if (item.approved == "Premium Re-Inspect") {
												actionElement1.html("Premium Re-Inspect");
											} else if (item.status === "Completed") {
												actionElement1.html("Waiting for Inspection");
											} else {
												actionElement1.html("&mdash;");
											}
										<?php } else { ?>
											// Other Roles: Show buttons
											if (item.approved == "Approved") {
												var username = item.inspected_by_name ? item.inspected_by_name : "Unknown";
												actionElement2.html("Approved by " + username);
											} else if (item.approved == "Normal Re-Inspect" || item.approved == "Re-Inspect") {
												actionElement2.html("Normal Re-Inspect");
											} else if (item.approved == "Premium Re-Inspect") {
												actionElement2.html("Premium Re-Inspect");
											} else if (item.status == "Completed") {
												actionElement2.html(`
													<button type="button" data-toggle="modal" data-target="#apr-room-modal-${item.mpor_id}" class="btn btn-success waves-effect waves-light" title="Approved">
														<i class="fa fa-check"></i>
													</button>
													<button type="button" data-toggle="modal" onclick="reInspectModal(${item.assign_to_id}, ${item.mpor_id})" data-target="#reinspt-room-modal-${item.mpor_id}" class="btn btn-danger waves-effect waves-light" title="Re-Inspect">
														<i class="fa fa-repeat"></i>
													</button>
												`);
											} else {
												actionElement2.html("&mdash;");
											}
										<?php } ?>
									}

									// **Update Status**
									if (statusElement.length) {
										statusElement.text(item.status);
									}

									// **Update Started Time**
									if (startedTimeElement.length && item.started_at !== "0000-00-00 00:00:00") {
										var startedDate = parseDate(item.started_at);
										if (startedDate) {
											var hours = startedDate.getHours();
											var minutes = startedDate.getMinutes();
											var amPm = hours >= 12 ? "PM" : "AM";

											hours = hours % 12 || 12; // Convert to 12-hour format
											minutes = minutes < 10 ? "0" + minutes : minutes;

											var formattedStartedTime = hours + ":" + minutes + " " + amPm;
											startedTimeElement.text(formattedStartedTime);
										} else {
											console.warn("Invalid date:", item.started_at);
											startedTimeElement.text("—"); // Show default text if invalid
										}
									} else {
										startedTimeElement.text("—");
									}


									// **Update Completed Time**
									if (completedTimeElement.length && item.completed_at !== "0000-00-00 00:00:00") {
										var completedDate = parseDate(item.completed_at);
									//	var completedDate = new Date(item.completed_at);
										if(completedDate) {
											var hours = completedDate.getHours();
											var minutes = completedDate.getMinutes();
											var amPm = hours >= 12 ? "PM" : "AM";

											hours = hours % 12 || 12; // Convert to 12-hour format
											minutes = minutes < 10 ? "0" + minutes : minutes;

											var formattedCompletedTime = hours + ":" + minutes + " " + amPm;
											completedTimeElement.text(formattedCompletedTime);
										} else {
											console.warn("Invalid date:", item.completed_at);
											completedTimeElement.text("—"); // Show default text if invalid
										}
									} else {
										completedTimeElement.text("—");
									}

									// **Update Timer**
									if (timerElement.length) {
										if (item.status === "In-Progress" && item.started_at) {
											let startedAt = item.started_at; 
											let timezoneOffset = <?php echo json_encode(isset($this->session->userdata['logged_in']['tz']) ? $this->session->userdata['logged_in']['tz'] : 0); ?>;
											timezoneOffset = parseFloat(timezoneOffset) || 0;

											let result = calculateTimeDifference(startedAt, timezoneOffset);

											if (!isNaN(result.timeInSeconds) && result.timeInSeconds >= 0) {
												if (!timerElement.data("running")) {
													timerElement.timer({
														seconds: isNaN(result.timeInSeconds) ? 0 : result.timeInSeconds, // Ensuring valid seconds
														format: "%H:%M:%S",
														onTick: function(time) {
															if (!time || time.includes("NaN")) {
																timerElement.text("—");
															}
														}
													});
													timerElement.data("running", true);
												}
											} else {
												timerElement.text("—");
											}
										} else if (item.status === "Completed" && item.started_at && item.completed_at) {

											var startDate = parseDate(item.started_at);
    										var endDate = parseDate(item.completed_at);

											if (startDate && endDate) {
												var diffMs = endDate - startDate;
												var formattedTime = isNaN(diffMs) || diffMs < 0 ? "—" : formatTime(diffMs);
											} else {
												var formattedTime = "—"; // Handle invalid dates
											}

											if (timerElement.data("running")) { 
												timerElement.timer('remove'); // Stop the timer
												timerElement.removeData("running");
											}

											timerElement.text(formattedTime); // Set final time
										} else {
											timerElement.text('—');
										}
									}

									// **Update Gap Timer**
									if (gapTimerElement.length) {
										var nextTask = response[index + 1];

										if (item.status !== "Completed") {
											gapTimerElement.text('—');
											if (gapTimerElement.data("running")) {
												gapTimerElement.timer('remove'); // Stop any running timer
												gapTimerElement.removeData("running");
											}
										} else if (nextTask && nextTask.started_at && item.completed_at) {

											var nextStartDate = parseDate(nextTask.started_at);
    										var currentEndDate = parseDate(item.completed_at);

											if (nextStartDate && currentEndDate && !isNaN(nextStartDate.getTime()) && !isNaN(currentEndDate.getTime())) {

												var gapDiffMs = nextStartDate - currentEndDate;
												if (gapDiffMs >= 0) {
													var formattedGapTime = formatTime(gapDiffMs) || "—"; // Ensuring a fallback
													if (gapTimerElement.data("running")) {
														gapTimerElement.timer('remove');
														gapTimerElement.removeData("running");
													}
													gapTimerElement.text(formattedGapTime);
												} else {
													gapTimerElement.text("—"); // Ensuring no NaN displays
												}
											} else {
												gapTimerElement.text("—"); // Handle invalid dates gracefully
											}


										} else if (nextTask && nextTask.status === "Pending") {
											var dateStart = new Date(item.completed_at);
											var dateEnd = new Date();
											var timeDiffSec = Math.floor((dateEnd - dateStart) / 1000);

											if (!isNaN(timeDiffSec) && timeDiffSec >= 0) {
												if (!gapTimerElement.data("running")) {
													gapTimerElement.timer({
														seconds: isNaN(timeDiffSec) ? 0 : timeDiffSec, // Ensuring valid seconds
														format: "%H:%M:%S",
														onTick: function(time) {
															if (!time || time.includes("NaN")) {
																gapTimerElement.text("—");
															}
														}
													});
													gapTimerElement.data("running", true);
												}
											} else {
												gapTimerElement.text("—");
											}

										} else {
											gapTimerElement.text('—');
											if (gapTimerElement.data("running")) {
												gapTimerElement.timer('remove');
												gapTimerElement.removeData("running");
											}
										}
									}

								});
							}
						},
						error: function (xhr, status, error) {
							console.error("Error fetching timer values:", error);
						}
					});
				}, 4000);

                window.reInspectModal = function (id, mpor_id) {
					$.ajax({
						url: "<?php echo site_url('mpor/check_reInspect'); ?>/" + id, // Pass the ID in the URL
						method: "GET",
						dataType: "json", // Ensure the response is parsed as JSON
						success: function (data) {
							let premiumInspection = $("#inspection_type_premium_" + mpor_id);
								
							if (data && data.length > 0) {							
								premiumInspection.show();
							} else {
								premiumInspection.hide();
							}
						},
						error: function () {
							console.log("Error in AJAX request.");
						}
					});
				}
				// **Helper function to format time in HH:MM:SS**
				function formatTime(milliseconds) {
					var totalSeconds = Math.floor(milliseconds / 1000);
					var hours = Math.floor(totalSeconds / 3600);
					var minutes = Math.floor((totalSeconds % 3600) / 60);
					var seconds = totalSeconds % 60;
					return [hours, minutes, seconds].map(v => String(v).padStart(2, '0')).join(':');
				}

				function parseDate(dateString) {
					if (!dateString || dateString === "0000-00-00 00:00:00") return null;

					// Detect Safari (excluding Chrome on iOS)
					var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

					if (isSafari) {
						// Safari Fix: Convert "YYYY-MM-DD HH:MM:SS" → "YYYY/MM/DD HH:MM:SS"
						dateString = dateString.replace(/-/g, "/");
					} else {
						// Chrome Fix: Convert "YYYY-MM-DD HH:MM:SS" → "YYYY-MM-DDTHH:MM:SS"
						dateString = dateString.replace(" ", "T");
					}

					let date = new Date(dateString);

					if (isNaN(date.getTime())) {
						console.warn("Invalid Date:", dateString);
						return null;
					}
					return date;
				}


				function calculateTimeDifference(startedAt, timezoneOffset) {
					let dateStart = parseDate(startedAt);
					if (!dateStart) return { startedTime: "--:--:--", timeInSeconds: NaN };

					let dateEnd = new Date();
					dateEnd.setHours(dateEnd.getUTCHours() + (timezoneOffset || 0));

					let diffInSeconds = Math.floor((dateEnd - dateStart) / 1000);
					if (isNaN(diffInSeconds) || diffInSeconds < 0) return { startedTime: "--:--:--", timeInSeconds: NaN };

					let hours = Math.floor(diffInSeconds / 3600).toString().padStart(2, "0");
					let minutes = Math.floor((diffInSeconds % 3600) / 60).toString().padStart(2, "0");
					let seconds = (diffInSeconds % 60).toString().padStart(2, "0");

					return { startedTime: `${hours}:${minutes}:${seconds}`, timeInSeconds: diffInSeconds };
				}

			<?php }?>
			
			$('#single_hotel_top, #single_hotel').change(function(e){
				var hotel_id	= $(this).val();
				var data_string = "hotel_id="+hotel_id;
				$.ajax({
					url:"<?php echo site_url("login/swtich_hotel") ?>",
					method: "POST",
					data: data_string,
					success:function(data){
						location.reload();
					}
				});
			});
			
			$('#mpor_type').change(function(e){
				var type	= $(this).val();
				if(type == '1'){
					$('#emp_list').show();
					$('#room_list').hide();
					$('#room_type').hide();
				}
				if(type == '2'){
					$('#emp_list').hide();
					$('#room_list').show();
					$('#room_type').hide();
				}
				if(type == '3'){
					$('#emp_list').hide();
					$('#room_list').hide();
					$('#room_type').show();
				}
				if(type == '0'){
					$('#emp_list').hide();
					$('#room_list').hide();
					$('#room_type').hide();
				}
            });
			$('.chk_sty').change(function(e){
				var chk_sty_val	= $(this).val();
				var mpor_id 	= $(this).attr("id").replace("chk_sty_", "");
				$('#loader_main').show();
				var data_string = "mpor_id="+mpor_id+"&chk_stay="+chk_sty_val+"&method_type=checkout_stayover";
				$.ajax({
					url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){$('#loader_main').hide();}
				});
            });
			$('.dnd_drpdwn').change(function(e){
				var is_dnd	= $(this).val();
				var mpor_id = $(this).attr("id").replace("dnd_", "");
				$('#loader_main').show();
				var data_string = "mpor_id="+mpor_id+"&is_dnd="+is_dnd+"&method_type=not_dnd";
				$.ajax({
					url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){$('#loader_main').hide();}
				});
            });
			$('.sp_request_drpdwn').change(function(e){
				var request_val = $(this).val();
				var mpor_id 	= $(this).attr("id").replace("req_", "");
				$('#loader_main').show();
				var data_string = "mpor_id="+mpor_id+"&sp_request="+request_val+"&method_type=request";
				$.ajax({
					url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){$('#loader_main').hide();}
				});
            });
			
			<?php if($this->uri->segment(1) != 'dashboard' && $this->uri->segment(1) != ''){?>
				setTimeout(function(){$("#side-menu li a:first").removeClass("active");}, 100);
			<?php }else{?>
				setTimeout(function(){$("#side-menu li a:first").addClass("active");}, 100);
			<?php }?>
			
			<?php if($this->uri->segment(2) == 'checklist_report' || $this->uri->segment(2) == 'manager_screen' || $this->uri->segment(2) == 'statistics' || $this->uri->segment(2) == 'analytics' || $this->uri->segment(2) == 'ranker' || $this->uri->segment(2) == 'assign_agenda'){?>
				//$(".open-close").trigger('click');
				setTimeout(function(){$(".open-close-2").trigger('click');}, 100);
			<?php }?>
			
			//http://www.bootstraptoggle.com/
			$("#MassSurveyInfo").on('submit',(function(e){
				e.preventDefault();
				var iserror =  false;
				
				var message 			= $('#message').val();
				var notes	 			= $('#ad_notes').val();
				var footer 				= $('#footer').val();
				var thank_you_message	= $('#thank_you_message').val();
				
				if ($("#questions_1 :selected").length == 0){
				   alert('One question should be selected');
				   var iserror =  true;
				   return false;
				}
				var searchIDs = [];
				$.each($("#questions_1 option:selected"), function(){ 
					searchIDs.push($(this).val());
				});
				
				/*if ($('.survey_questions:checked').length < 1){
				   alert('One question should be on');
				   var iserror =  true;
				   return false;
				}
				var searchIDs = $(".survey_questions:checked").map(function(){
				  return $(this).val();
				}).get();*/
				
				//alert(searchIDs);
				
				if(!iserror){
					var data_string = "message="+message+"&notes="+notes+"&footer="+footer+"&thank_you_message="+thank_you_message;
					$('#loader_main').show();
					$.ajax({
					url: "<?php echo site_url("guest_survey/save_mass_survey/") ?>",
					type: "POST",
					data: data_string,
						success: function(data){
							var data_string = "questions="+searchIDs;
							$.ajax({
								url: "<?php echo site_url("guest_survey/mass_survey_update_question_state/") ?>",
								type: "POST",
								data: data_string,
									success: function(data){
										$('#loader_main').hide();
										location.reload();
									}
								});
						}
					});
				}
			}));
			$("#guestSurveyInfo").on('submit',(function(e){
				e.preventDefault();
				var iserror =  false;
				
				var message 	= $('#message').val();
				var notes	 	= $('#ad_notes').val();
				var footer 		= $('#footer').val();
				
				if ($('.survey_questions:checked').length < 1){
				   alert('One question should be on');
				   var iserror =  true;
				   return false;
				}
				
				var q_1		= $('#toggle-trigger-1').prop('checked');
				var q_2		= $('#toggle-trigger-2').prop('checked');
				var q_3		= $('#toggle-trigger-3').prop('checked');
				var q_4		= $('#toggle-trigger-4').prop('checked');
				var q_5		= $('#toggle-trigger-5').prop('checked');
				var q_6		= $('#toggle-trigger-6').prop('checked');
				var q_7		= $('#toggle-trigger-7').prop('checked');
				
				if(q_1){var q_1 = 'on';}else{var q_1 = 'off';}
				if(q_2){var q_2 = 'on';}else{var q_2 = 'off';}
				if(q_3){var q_3 = 'on';}else{var q_3 = 'off';}
				if(q_4){var q_4 = 'on';}else{var q_4 = 'off';}
				if(q_5){var q_5 = 'on';}else{var q_5 = 'off';}
				if(q_6){var q_6 = 'on';}else{var q_6 = 'off';}
				if(q_7){var q_7 = 'on';}else{var q_7 = 'off';}
				
				if(!iserror){
					var data_string = "message="+message+"&notes="+notes+"&footer="+footer+"&q_1="+q_1+"&q_2="+q_2+"&q_3="+q_3+"&q_4="+q_4+"&q_5="+q_5+"&q_6="+q_6+"&q_7="+q_7;
					$('#loader_main').show();
					$.ajax({
					url: "<?php echo site_url("guest_survey/save_guest_survey/") ?>",
					type: "POST",
					data: data_string,
						success: function(data){
							$('#loader_main').hide();
							location.reload();
						}
					});
				}
			}));
			$('[name="time_in"]').blur(function(){
				var validTime = $(this).val().match(/^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/);
				if (!validTime) {
					$(this).val('').focus().css('background', '#fdd');
				} else {
					var form_raw_id = $(this).attr("id");
					var form_id 	= form_raw_id.replace("time_in_", "");
					
					$(this).css('background', 'transparent');
					var string_date  = Date.parseExact($(this).val(), "hh:mm tt");
					var string_date1 = new Date(string_date.getTime() + 20*60000);
					var string_date2 = string_date1.toString("hh:mm tt").toLowerCase();
					$('#call_back_'+form_id).val(string_date2);
				}
			});
			$(".ticket_type").click(function(){
				var type = $(this).val();
				if(type == 'not_req'){
					$('#dual').hide();
					$('#sec_3').hide();
					$('.popup-btn').text('SAVE INFO');
				}else{
					$('#dual').show();
					$('#sec_3').show();
					$('.popup-btn').text('GENERATE TICKET');
				}
			});
			$(".dual_ticket").click(function(){
				var dualVal = $(this).val();
				if(dualVal == 'yes'){$('#ticket_2').show();}
				else{$('#ticket_2').hide();}
			});
			$('.rooms_drop').change(function(e) {
				var currentRoom = $(this).val();
				var currentRoomID =  $(this).attr("id");

                $('.rooms_drop').each(function(i, obj) {
					var roomInLoop = $(this).val();
					if(roomInLoop!="")
					{
						if(roomInLoop == currentRoom)
						{
							if($(this).attr("id")!=currentRoomID)
							{
								alert('Room #'+currentRoom+" already selected. Kindly select a different room.");
								$("#"+currentRoomID).prop('selectedIndex',0);
								return false;
							}
						}
					}
				});
            });
			$(".selectpicker").change(function(){
				$('#show_count').html('Rooms Selected ('+$("#room_no option:selected").length+')');				
			});
			$('.clockpicker').clockpicker({
				donetext: 'Done',
			}).find('input').change(function() {
				console.log(this.value);
			});
			$('#myTable').DataTable();
			$('#myTableTask').DataTable({
			  	aaSorting: [[2, 'asc']]
			});
			$('#myTableMPOR').DataTable({
			  	aaSorting: [[1, 'asc']],
        		responsive: true,
			  	"pageLength": 100,
			});
			$('#MPOR_INSPECTOR_CENTRAL').DataTable({
			  	aaSorting: [[1, 'asc']],
        		responsive: true,
			  	"pageLength": 100,
			});
			$('#myTablePMP_info').DataTable({
			  	aaSorting: [[0, 'asc']],
        		responsive: true,
			  "pageLength": 100
			});
			var groupColumn = 0;
			var hide_cols	= [0,1];
			var MASSSURVEYunique_code = [];
			var MASSSURVEYcounter 	= 0;
			var table = $('#myTableMASSSURVEY').DataTable({
				"columnDefs": [
					{ "visible": false, "targets": hide_cols },
					{ "orderable": false, "targets": [2,3,4,5,6,7,8,9,10,11] }
				],
				"order": [[ groupColumn, 'desc' ]],//asc
				"displayLength": 100,
				"drawCallback": function ( settings ) {
					var api 	= this.api();
					var rows 	= api.rows( {page:'current'} ).nodes();
					var last 	= null;
					
					api.column(1, {page:'current'} ).data().each( function ( group, i ) {
						if ( last !== group ) {
							last = group;
							MASSSURVEYunique_code.push(group);
						}
					});
					api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
						if ( last !== group ) {
							var rowData = api.row(i).data();//alert(rowData[unique_code]);
							$(rows).eq( i ).before(
								'<tr class="group"><td>'+group+'</td><td colspan="6"></td><td colspan="3"><button type="button" class="btn btn-warning" onclick="sendMassSurveyEMail('+MASSSURVEYunique_code[MASSSURVEYcounter]+');"> <i class="fa fa-check"></i> SEND SUVERY EMAIL DATED '+group+' </button></td></tr>'
							);
							last = group;
							MASSSURVEYcounter = MASSSURVEYcounter+1;
						}
					});
				}
			});
			// Order by the grouping
			/*$('#myTableMASSSURVEY tbody').on( 'click', 'tr.group', function(){
				var currentOrder = table.order()[0];
				if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
					table.order( [ groupColumn, 'desc' ] ).draw();
				}
				else {
					table.order( [ groupColumn, 'asc' ] ).draw();
				}
			});*/
		
			$('#myTablePMP').DataTable({
			  	aaSorting: [[0, 'asc']],
        		responsive: true,
			  "pageLength": 100
			});
			$('#myTableLead').DataTable({
			  	aaSorting: [[3, 'asc']],
			  "pageLength": 100
			});
			$('#myTabletodo').DataTable({
				aaSorting: [[3, 'asc']]
			});
			jQuery('#date-range').datepicker({
				toggleActive: true,
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
			});
			jQuery('#datetimepicker-history').datepicker({
                format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
				//startDate: '-0d',
				endDate: '-1d',
				container: 'body',
			});
			jQuery('#close_tkt_arrival').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
				endDate: '+0d',
				container: 'body',
			/*}).on('changeDate', function(ev){*/
			});
			jQuery('#close_tkt_dept').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
				endDate: '+0d',
				container: 'body',
			});
			$('#task_start_date_1, #task_start_date_2, #task_start_date_3, #task_start_date_4, #task_start_date_5').datepicker({
                format: 'mm-dd-yyyy',
                autoclose: false, // Prevents auto-closing on selection
                todayHighlight: true,
                startDate: '-0d',
                container: 'body',
            });
            
            $('#task_start_date_1, #task_start_date_2, #task_start_date_3, #task_start_date_4, #task_start_date_5, #task_end_date_1, #task_end_date_2, #task_end_date_3, #task_end_date_4, #task_end_date_5, #datetimepicker1, #datetimepicker2, #datetimepicker3, #datetimepicker4, #datetimepicker5, #datetimepicker6')
			.on('focus', function (e) {
				if (!$(this).data('keyboard-enabled')) { 
					e.preventDefault();
					$(this).blur(); // Prevent keyboard if disabled
				}
			})
			.on('dblclick', function () {
				let isKeyboardEnabled = $(this).data('keyboard-enabled') || false;
				$(this).data('keyboard-enabled', !isKeyboardEnabled); // Toggle state
				
				if (isKeyboardEnabled) {
					// Disable keyboard again
					$(this).blur();
				} else {
					// Enable keyboard
					$(this).off('focus').focus();
				}
			});

                
			jQuery('#task_end_date_1, #task_end_date_2, #task_end_date_3, #task_end_date_4, #task_end_date_5').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#event_start_date').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			}).datepicker("setDate", new Date());
			jQuery('#event_end_date').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			}).datepicker("setDate", new Date());		
			jQuery('#datetimepicker1').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				//startDate: '-0d',
				endDate: '+0d',
			});
			jQuery('#datetimepicker2').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datetimepicker3').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datetimepicker4').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datetimepicker5').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datetimepicker6').datepicker({
                format: 'mm-dd-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker_due_2').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker_due_3').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker_due_4').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker_due_5').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose').datepicker({
                format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose-end_date').datepicker({
        		format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				container: 'body',
				startDate: '-0d'
			});
			jQuery('#datepicker-autoclose-achivement_date').datepicker({
        		format: 'dd-mm-yyyy',
				autoclose: true,
				todayHighlight: true,
				defaultDate : '',
				container: 'body',
				startDate: '-0d'
			});
			$(document).on('click', '.btn-add', function(e){
				e.preventDefault();
				var controlForm		= $('.controls:first'),
					currentEntry 	= $(this).parents('.entry:first'),
					newEntry 		= $(currentEntry.clone()).appendTo(controlForm);
				newEntry.find('input').val('');
				controlForm.find('.entry:not(:last) .btn-add')
					.removeClass('btn-add').addClass('btn-remove')
					.removeClass('btn-success').addClass('btn-danger')
					.html('<span class="glyphicon glyphicon-minus"></span>');
				}).on('click', '.btn-remove', function(e){
					$(this).parents('.entry:first').remove();
					e.preventDefault();
					return false;
			});
			$('.areatype').change(function(){
				var chk_id = $(this).attr("id").replace("area_type_agenda_", "");
				if(this.value == 'custom'){
					$('#area_type_agenda_'+chk_id).hide();
					$('#custom_area_'+chk_id).show();
					$('#switch_back_drp_'+chk_id).show();
					$('#custom_area_'+chk_id).val('');
					$('#custom_area_'+chk_id).prop('required',true);
					$('#area_type_agenda_'+chk_id).prop('required',false);
				}else{
					$('#custom_area_'+chk_id).val(this.value);
					$('#area_type_agenda_'+chk_id).show();
					$('#custom_area_'+chk_id).hide();
					$('#switch_back_drp_'+chk_id).hide();
					$('#custom_area_'+chk_id).prop('required',false);
					$('#area_type_agenda_'+chk_id).prop('required',true);
				}
			});
			$(".switchBack").click(function(){
				var chk_id = $(this).attr("id").replace("switch_back_drp_", "");
				$('#area_type_agenda_'+chk_id).show();
				$('#custom_area_'+chk_id).hide();
				$('#switch_back_drp_'+chk_id).hide();
				$('#custom_area_'+chk_id).prop('required',false);
				$('#area_type_agenda_'+chk_id).prop('required',true);
				$('#area_type_agenda_'+chk_id).val($("#area_type_agenda option:first").val());
			});
			$('#area_type_agenda').change(function(){
				if(this.value == 'custom'){
					$('#area_type_agenda').hide();
					$('#custom_area').show();
					$('#switch_back_drp').show();
					$('#custom_area').val('');
					$("#custom_area").prop('required',true);
					$("#area_type_agenda").prop('required',false);
				}else{
					$('#custom_area').val(this.value);
					$('#area_type_agenda').show();
					$('#custom_area').hide();
					$('#switch_back_drp').hide();
					$("#custom_area").prop('required',false);
					$("#area_type_agenda").prop('required',true);
				}
			});
			$("#switch_back_drp").click(function(){
				$('#area_type_agenda').show();
				$('#custom_area').hide();
				$('#switch_back_drp').hide();
				$("#custom_area").prop('required',false);
				$("#area_type_agenda").prop('required',true);
				$("#area_type_agenda").val($("#area_type_agenda option:first").val());
			});
			$('#area_type').change(function(){
				if(this.value == 'custom'){
					$('#area_name').val('');
				}else{
					$('#area_name').val(this.value);
				}
			});
			$('#room_no').change(function() {
				var room_no = $('#room_no').val();
				var arrv	= $('#close_tkt_arrival').val();
				var dept	= $('#close_tkt_dept').val();
				
				if(room_no != '' && arrv != '' && dept != ''){
					$('#hk_date_range_info').show();
					$('#spinner').show();
					var data_string = "arrival_date="+arrv+"&departure_date="+dept+"&room_no="+room_no;
					$.ajax({
						url: "<?php echo site_url("mpor/get_hk_dateRange/") ?>",
						type: "POST",
						data: data_string,
						success: function(data){
							$('#spinner').hide();
							$('#hk_names').html(data);
						}
					});
				}else{
					$('#hk_date_range_info').hide();
				}
			});
			$('#close_tkt_arrival').change(function() {
				var room_no = $('#room_no').val();
				var arrv	= $('#close_tkt_arrival').val();
				var dept	= $('#close_tkt_dept').val();
				
				if(room_no != '' && arrv != '' && dept != ''){
					$('#hk_date_range_info').show();
					$('#spinner').show();
					var data_string = "arrival_date="+arrv+"&departure_date="+dept+"&room_no="+room_no;
					$.ajax({
						url: "<?php echo site_url("mpor/get_hk_dateRange/") ?>",
						type: "POST",
						data: data_string,
						success: function(data){
							$('#spinner').hide();
							$('#hk_names').html(data);
						}
					});
				}else{
					$('#hk_date_range_info').hide();
				}
			});
			$('#close_tkt_dept').change(function() {
				var room_no = $('#room_no').val();
				var arrv	= $('#close_tkt_arrival').val();
				var dept	= $('#close_tkt_dept').val();
				
				if(room_no != '' && arrv != '' && dept != ''){
					$('#hk_date_range_info').show();
					$('#spinner').show();
					var data_string = "arrival_date="+arrv+"&departure_date="+dept+"&room_no="+room_no;
					$.ajax({
						url: "<?php echo site_url("mpor/get_hk_dateRange/") ?>",
						type: "POST",
						data: data_string,
						success: function(data){
							$('#spinner').hide();
							$('#hk_names').html(data);
						}
					});
				}else{
					$('#hk_date_range_info').hide();
				}
			});
			$("#employee_role").change(function(){
				var employee_role = this.value;
				if(employee_role == '4'){
					$('#second_dv').show();
				}else{
					$('#second_dv').hide();
				}
			});
			$(".rat_cls").click(function(){
				var rating		= $(this).val();
				var raw_btn_ID	= $(this).attr("name");
				var auto_id 	= raw_btn_ID.replace("rating_", "");
				//alert(auto_id); return false;
				var room_no		= $('#room_no_'+auto_id).val();
				var guest_name 	= $('#guest_name_'+auto_id).val();
				var time_in		= $('#time_in_'+auto_id).val();
				var call_back	= $('#call_back_'+auto_id).val();
				var ratings		= $('input[name=rating_'+auto_id+']:checked').val();
				var initals		= $('#initals_'+auto_id).val();
				
				if(room_no == ''){
					$('#error_'+auto_id).html('Please select room no first!');
					setTimeout(function(){$('#error_'+auto_id).html('');}, 3000);
					return false;
				}
				if(guest_name == ''){
					$('#error_'+auto_id).html('Please enter name first!');
					setTimeout(function(){$('#error_'+auto_id).html('');}, 3000);
					return false;
				}
				if(time_in == ''){
					$('#error_'+auto_id).html('Please define check-In ime first!');
					setTimeout(function(){$('#error_'+auto_id).html('');}, 3000);
					return false;
				}
				if(call_back == ''){
					$('#error_'+auto_id).html('Call back time is not define!');
					setTimeout(function(){$('#error_'+auto_id).html('');}, 3000);
					return false;
				}
				if(!ratings){
					$('#error_'+auto_id).html('Please select email/rating first!');
					setTimeout(function(){$('#error_'+auto_id).html('');}, 3000);
					return false;
				}
				
				$.ajax({
					url: "<?php echo site_url("rooms/get_room_type/");?>",
					type: "POST",
					data: "room_no="+$('#room_no_'+auto_id).val(),
					success: function(data){
						$('#room_type').text(data);
					}
				});
				
				//Filling POP UP values
				$('#email_hdn').hide();
				$('#rating_hdn').hide();
				$('#t_rating').val(rating);
				
				if(rating == 'email'){
					$('#email_hdn').show();
					$('#sec_2').hide();
					$('#sec_3').hide();
					$('.popup-btn').text('GENERATE EMAIL');
				}
				else{
					$('#dual').hide();
					$('#rating_hdn').show();
					$('#sec_2').show();
					$('#sec_3').hide();
					$('.popup-btn').text('SAVE INFO');//GENERATE TICKET
				}
				
				$('#room_num').text($('#room_no_'+auto_id).val());
				$('#guest_name').text($('#guest_name_'+auto_id).val());
				$('#t_time_in').text($('#time_in_'+auto_id).val());
				$('#t_call_back').text($('#call_back_'+auto_id).val());
				
				$('#responsive-modal').modal();
			});
			$(".guest_call_update").click(function(){
				var raw_btn_ID	= $(this).attr("id");
				var submitBtnID = raw_btn_ID.replace("u_", "");//alert(submitBtnID);
				var formID 		= "guest_call_update_"+submitBtnID;
				
				var room_no		= $('#u_room_no_'+submitBtnID).val()
				var guest_name 	= $('#u_guest_name_'+submitBtnID).val()
				var time_in		= $('#u_time_in_'+submitBtnID).val()
				var call_back	= $('#u_call_back_'+submitBtnID).val()
				
				//var rating		= $('#u_rating_'+submitBtnID).val()
				var rating		= $('input[name=u_rating_'+submitBtnID+']:checked').val()
				var initals		= $('#u_initals_'+submitBtnID).val()

				if(room_no == ''){
					$('#u_error_'+submitBtnID).html('Please select room no first!');
					setTimeout(function(){$('#u_error_'+submitBtnID).html('');}, 3000);
					return false;
				}
				if(guest_name == ''){
					$('#u_error_'+submitBtnID).html('Please enter name first!');
					setTimeout(function(){$('#u_error_'+submitBtnID).html('');}, 3000);
					return false;
				}
				if(time_in == ''){
					$('#u_error_'+submitBtnID).html('Please define check-In ime first!');
					setTimeout(function(){$('#u_error_'+submitBtnID).html('');}, 3000);
					return false;
				}
				if(call_back == ''){
					$('#u_error_'+submitBtnID).html('Call back time is not define!');
					setTimeout(function(){$('#u_error_'+submitBtnID).html('');}, 3000);
					return false;
				}
				if(!rating){
					$('#u_error_'+submitBtnID).html('Please select email/rating first!');
					setTimeout(function(){$('#u_error_'+submitBtnID).html('');}, 3000);
					return false;
				}
				$('#loader_main').show();
				var data_string = "room_no="+room_no+"&guest_name="+guest_name+"&time_in="+time_in+"&call_back="+call_back+"&rating="+rating+"&initals="+initals+"&call_id="+submitBtnID;
				$.ajax({
					url: "<?php echo site_url("welcome_call/update_welcome_call/");?>",
					type: "POST",
					data: data_string,
					success: function(data){
						$('#loader_main').hide();
						//notifyMe('Guest Welcome Call!!', 'Guest Call added by '+initals, 'https://www.hops247.com/welcome_call');
						$('#t_rating').text('');
						$('#room_num').text('');
						$('#guest_name').text('');
						$('#t_time_in').text('');
						$('#t_call_back').text('');
					}
				});
			});
			$('.email, .sms, .dept').change(function() {
				var tktTypes 	= new Array();
				var method 		= $(this).attr('class').split(" ");
				var notiType 	= method[1];
				var user_id 	= method[0].replace(notiType+"_", "");
				
				$("."+notiType+"_"+user_id).each(function() {
					if($(this).prop('checked')){
						tktTypes.push($(this).val());
					}
				});
				var tktsString = tktTypes.join(',');
				var data_string = "user_id="+user_id+"&tkt_ids="+tktsString+"&method="+notiType;
				
				$('#loader_main').show();
				$.ajax({
					url: "<?php echo site_url("settings/update_user_ticket_noti/");?>",
					type: "POST",
					data: data_string,
					success: function(data){
						$('#loader_main').hide();
					}
				});
			});
			//Events
			$('#repeat_event').change(function(){
				if($(this).val() == 'custom'){
					$('.bs-pending-ticket').modal();
				}
			});
			$('#event_start_date').change(function(){
				var stDate	= $("#event_start_date").val();
					jQuery('#event_end_date').datepicker({
						format: 'mm-dd-yyyy',
						autoclose: true,
						todayHighlight: true,
						container: 'body',
						startDate: '-0d'
					}).datepicker("setDate", stDate);
				
				var days_Names		= ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				var ordinals 		= ["", "first", "second", "third", "fourth", "fifth", "sixth"];
				var start_date 		= $("#event_start_date").val().split("-");
				var start_dateFMT	= new Date(start_date[2], start_date[0] - 1, start_date[1]);
				var start_monthFMT	= new Intl.DateTimeFormat("en-US", {month: "long"}).format;
				var ST_month 		= start_monthFMT(start_dateFMT);
				var ST_date			= start_dateFMT.getDate();
				var ST_dayName 		= days_Names[start_dateFMT.getDay()];
				
				$('#repeat_event option[value="every_fullday"]').text('Every '+ST_dayName);
				$('#repeat_event option[value="dayOfEveryMonth"]').text('Day '+ST_date+' of every month');
				$('#repeat_event option[value="every_noOfday"]').text('Every '+ordinals[Math.ceil(ST_date/7)]+' '+ST_dayName);
				$('#repeat_event option[value="everyYear"]').text('Every '+ST_month+' '+ST_date);
			});
			$("#assign_to_dp_ur").change(function(){
				if($(this).val() == 'dept'){
					$('#dept_drp').show();
					$('#user_drp').hide();
					$("#select_dept_drp").prop('required',true);
				}
				else if($(this).val() == 'user'){
					$('#dept_drp').hide();
					$('#user_drp').show();
					$("#select_users_drp").prop('required',true);
				}
				else{
					$('#dept_drp').hide();
					$('#user_drp').hide();
					$("#select_users_drp").prop('required',false);
					$("#select_dept_drp").prop('required',false);
				}
			});
			$(".assignto").change(function(){
				var chk_id = $(this).attr("id").replace("edit_assign_to_dp_ur_", "");
				if($(this).val() == 'dept'){
					$('#edit_dept_drp_'+chk_id).show();
					$('#edit_user_drp_'+chk_id).hide();
					$('#edit_select_dept_drp_'+chk_id).prop('required',true);
				}
				else if($(this).val() == 'user'){
					$('#edit_dept_drp_'+chk_id).hide();
					$('#edit_user_drp_'+chk_id).show();
					$('#edit_select_users_drp_'+chk_id).prop('required',true);
				}
				else{
					$('#edit_dept_drp_'+chk_id).hide();
					$('#edit_user_drp_'+chk_id).hide();
					$('#edit_select_users_drp_'+chk_id).prop('required',false);
					$('#edit_select_dept_drp_'+chk_id).prop('required',false);
				}
			});
			$('#all_day').change(function() {
				if ($(this).prop('checked')) {
					$("#event_start_time").prop('required',false);
					$("#event_end_time").prop('required',false);
					
					$("#event_start_time").attr("disabled","disabled");
					$("#event_end_time").attr("disabled","disabled");
				}
				else {
					$("#event_start_time").prop('required',true);
					$("#event_end_time").prop('required',true);
					
					$("#event_start_time").prop( "disabled", false );
					$("#event_end_time").prop( "disabled", false );
				}
			});
			$("#cus_occur").change(function(){
				if($(this).val() == 'daily'){
					$('#cus_daily').show();
					$('#cus_weekly, #cus_sameDayMonth, #cus_sameWeekMonth, #cus_sameDayYear, #cus_sameWeekYear').hide();
				}
				else if($(this).val() == 'weekly'){
					$('#cus_weekly').show();
					$('#cus_daily, #cus_sameDayMonth, #cus_sameWeekMonth, #cus_sameDayYear, #cus_sameWeekYear').hide();
				}
				else if($(this).val() == 'sameDayMonth'){
					$('#cus_sameDayMonth').show();
					$('#cus_daily, #cus_weekly, #cus_sameWeekMonth, #cus_sameDayYear, #cus_sameWeekYear').hide();
				}
				else if($(this).val() == 'sameWeekMonth'){
					$('#cus_sameWeekMonth').show();
					$('#cus_daily, #cus_weekly, #cus_sameDayMonth, #cus_sameDayYear, #cus_sameWeekYear').hide();
				}
				else if($(this).val() == 'sameDayYear'){
					$('#cus_sameDayYear').show();
					$('#cus_daily, #cus_weekly, #cus_sameDayMonth, #cus_sameWeekMonth, #cus_sameWeekYear').hide();
				}
				else if($(this).val() == 'sameWeekYear'){
					$('#cus_sameWeekYear').show();
					$('#cus_daily, #cus_weekly, #cus_sameDayMonth, #cus_sameWeekMonth, #cus_sameDayYear').hide();
				}
				else{
					$('#cus_daily, #cus_weekly, #cus_sameDayMonth, #cus_sameWeekMonth, #cus_sameDayYear, #cus_sameWeekYear').hide();
				}
			});
			$("#event_start_time, #event_end_time").change(function(){
				var startIndex = $("#event_start_time").prop('selectedIndex');
				var endIndex = $("#event_end_time").prop('selectedIndex');
				
				$('.current_time').removeClass('current_time');
				
				var i;
				for (i = startIndex; i < endIndex; i++) {
					$('.'+i).addClass(' current_time');
				}
				//SELECT * FROM events WHERE CURRENT_DATE() BETWEEN event_start AND event_end
				//SELECT * FROM events WHERE CURRENT_DATE() BETWEEN start_date AND end_date
				
				
				/*var startTime = $(this).val();
				var endTime = $("#event_end_time").val();
				
				var timeArr = Array(
					{ "time" : "12:00 AM", "shorttime" : "0a1" },
					{ "time" : "12:30 AM", "shorttime" : "0a2" },
					{ "time" : "01:00 AM", "shorttime" : "1a1" },
					{ "time" : "01:30 AM", "shorttime" : "1a2" },
					{ "time" : "02:00 AM", "shorttime" : "2a1" },
					{ "time" : "02:30 AM", "shorttime" : "2a2" }
				);
				
				$.map(timeArr, function(value, key){
					 if(value.time == startTime){
				$('.current_time').removeClass('current_time');
				$('.'+value.shorttime).addClass(' current_time');
					 }
				});*/
				//alert($("#event_start_time").prop('selectedIndex'));
				//alert($("#event_end_time").prop('selectedIndex'));
			});
			$('.room_percent_number').change(function(e){
				var chk_sty_val	= $(this).val();
				if(chk_sty_val == 'percentage'){
					$('#percentage').show();
					$('#number').hide();
				}
				else{
					$('#percentage').hide();
					$('#number').show();
				}
            });
			$('#key_req').change(function(e){
				var key_req	= $(this).val();
				if(key_req == 'yes'){
					$('#available_keys').show();
					$("#key_id").prop('required',true);
				}
				else{
					$('#available_keys').hide();
					$("#key_id").prop('required',false);
				}
            });
		});
		
		(function(){
			[].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
				new CBPFWTabs(el);
			});
		})();
		function sendMassSurveyEMail(unique_code){
			var data_string = "unique_code="+unique_code;
			$('#loader_main').show();
			$.ajax({
			url: "<?php echo site_url("guest_survey/send_email_mass_survey/") ?>",
			type: "POST",
			data: data_string,
				success: function(data){
					$('#loader_main').hide();
					location.reload();
				}
			});
		}
		function print_this(div_id){
			var mywindow = window.open("", "PRINT", "height=400,width=600");
			//view have file for this function
		}
		function panic_button(qst_ans){
			if(qst_ans == 'yes'){
				$('#sec_1').hide();
				$('#sec_2').show();
				$('#sec_2_footer').show();
				$('.panic-title').text('EMERGENCY PANIC SYSTEM ACTIVATED');
			}
		}
		function getMporInfo(date){
			var data_string = "date="+date;
			
			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("mpor/history_mpor/");?>",
				type: "POST",
				data: data_string,
				success: function(data){
					$('#results').html(data);
					$('#loader_main').hide();
				}
			});
		}
		function validateEmail(sEmail){
			var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if (filter.test(sEmail)) {return true;}
			else {return false;}
		}
		function guestCallTicket(){
			var room_no		= $('#room_num').text();
			var room_type	= $('#room_type').text();
			var guest_name	= $('#guest_name').text();
			var time_in		= $('#t_time_in').text();
			var call_back	= $('#t_call_back').text();
			var call_type	= $('#t_rating').val();
			
			var guest_email	= $('#guest_email').val();
			
			var ratingPoint = $('#guest_rating').val();
			var ticket_type = $('input[name="ticket_type"]:checked').val();//not_req
			var dual_ticket = $('input[name="dual_ticket"]:checked').val();
			var dept_1		= $('#dept_1').val();
			var dept_2		= $('#dept_2').val();
			var pm_notes	= $('#pm_notes').val();
			var pm_notes_2	= $('#pm_notes_2').val();
			
			if(call_type == 'email'){
				if(guest_email == ''){
					$('#popup_error').html('Please enter guest email first!');
					setTimeout(function(){$('#popup_error').html('');}, 3000);
					return false;
				}
				if (validateEmail(guest_email)){}else{
					$('#popup_error').html('Please enter guest email in correct format');
					setTimeout(function(){$('#popup_error').html('');}, 3000);
					return false;
				}
				var data_string = "room_no="+room_no+"&room_type="+room_type+"&guest_name="+guest_name+"&guest_email="+guest_email+"&time_in="+time_in+"&call_back="+call_back+"&call_type="+call_type;
			}else{
				if(ratingPoint == ''){
					$('#popup_error').html('Please select rating first!');
					setTimeout(function(){$('#popup_error').html('');}, 3000);
					return false;
				}
				if(ticket_type == ''){
					$('#popup_error').html('Please select ticket type first!');
					setTimeout(function(){$('#popup_error').html('');}, 3000);
					return false;
				}
				if(dual_ticket == ''){
					$('#popup_error').html('Please select dual ticket option first!');
					setTimeout(function(){$('#popup_error').html('');}, 3000);
					return false;
				}
				if(ticket_type != 'not_req'){
					if(dept_1 == ''){
						$('#popup_error').html('Please select department first!');
						setTimeout(function(){$('#popup_error').html('');}, 3000);
						return false;
					}
					if(dual_ticket == 'yes'){
						if(dept_2 == ''){
							$('#popup_error').html('Please select second department first!');
							setTimeout(function(){$('#popup_error').html('');}, 3000);
							return false;
						}
					}
				}
				var data_string = "room_no="+room_no+"&room_type="+room_type+"&guest_name="+guest_name+"&time_in="+time_in+"&call_back="+call_back+"&ratingPoint="+ratingPoint+"&ticket_type="+ticket_type+"&dual_ticket="+dual_ticket+"&dept_1="+dept_1+"&dept_2="+dept_2+"&pm_notes="+pm_notes+"&pm_notes_2="+pm_notes_2+"&call_type="+call_type;
			}
			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("welcome_call/save_welcome_call/");?>",
				type: "POST",
				data: data_string,
				success: function(data){
					$('#ticket_2').hide('');
					$('#guest_call_form')[0].reset();
					
					$('#t_rating').val('');
					$('#t_time_in').text('');
					$('#t_call_back').text('');
					$('#room_num').text('');
					$('#room_type').text('');
					$('#guest_name').text('');
					$('#guest_email').text('');
					
					$('#loader_main').hide();
					$('#guest_call_form').modal('hide');
					$('.modal.in').modal('hide');
					tinyMCE.activeEditor.setContent('');
					notifyMe('Guest Welcome Call!!', 'Guest Call added', 'https://www.hops247.com/welcome_call');
					//playSound('bing');
				}
			});
		}
		function saveCaseStatus(case_id, user_id){
			var case_id 	= case_id;
			var user_id 	= user_id;
			var status		= $('#status_'+case_id).val();
			
			if(status == ''){
				$('#popup_error').html('Please select stattus option first!');
				setTimeout(function(){$('#popup_error').html('');}, 3000);
				return false;
			}
			
			var data_string = "status="+status+"&case_id="+case_id+"&user_id="+user_id;
			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("support/update_case_status/");?>",
				type: "POST",
				data: data_string,
				success: function(data){
					$('#loader_main').hide();
					location.reload();
				}
			});
		}
		function selectAll(){
			$('#mainDivOfCheck input:checkbox').attr('checked', 'checked');
		}
		function deSelectAll(){
			$('#mainDivOfCheck input:checkbox').removeAttr('checked');
		}
		function expandAll(){
			$('#demo-foo-row-toggler').trigger('footable_expand_all');
		}
		function collapseAll(){
			$('#demo-foo-row-toggler').trigger('footable_collapse_all');
		}
		function showmessageBox(ticket_id){
			$('#action_bar_'+ticket_id).hide();
			$('#quickReplyDiv_'+ticket_id).show();
			$('#qmajax_'+ticket_id).val('');
			$('.imageNo_'+ticket_id).prop('checked', false);
			$('.plane_'+ticket_id).hide();
			$('.imageNo_'+ticket_id).removeClass('hidden');
			$('.mentions').html('<div></div>');
			$('.taggedImages_'+ticket_id).html('');
			$('#quick_message_'+ticket_id).val('');
		}
		/*function hidemessageBox(ticket_id){
			$('#replydiv_'+ticket_id).hide();
		}*/
		function hideQuickmessageBox(ticket_id){
			$('#qmajax_'+ticket_id).val('');
			$('#quickReplyDiv_'+ticket_id).hide();
			$('.imageNo_'+ticket_id).prop('checked', false);
			$('.plane_'+ticket_id).show();
			$('.imageNo_'+ticket_id).addClass(' hidden ');
			$('.mentions').html('<div></div>');
			$('.taggedImages_'+ticket_id).html('');
			$('#quick_message_'+ticket_id).val('');
			$('#action_bar_'+ticket_id).show();
		}
		function mpor_dnd(mpor_id){
			$('#loader_main').show();
			var form = $('#mpor_dnd_'+mpor_id)[0];
			$.ajax({
				url: "<?php echo site_url("mpor/update_mpor_room_started_info/");?>",
				type: "POST",
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					$('#dnd-modal-'+mpor_id).modal('hide');
					$('#loader_main').hide();
					location.reload();
				}
			});
		}
		/*function reinspect(mpor_id){
			var notes		= $('#notes_'+mpor_id).val();
			var data_string = "mpor_id="+mpor_id+"&notes="+notes+"&method_type=reinspect";

			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("mpor/update_mpor_room_started_info/");?>",
				type: "POST",
				data: data_string,
				success: function(data){					
					$('#loader_main').hide();
					$('#reinspt-room-modal-'+mpor_id).modal('hide');
					$('.modal.in').modal('hide');
					tinyMCE.activeEditor.setContent('');
				}
			});
		}
		function mpor_apr_room(mpor_id){
			var notes		= $('#notes_'+mpor_id).val();
			
			//if(notes == ''){
//				$('#popup_error_'+mpor_id).html('Notes are required!!');
//				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
//				return false;
//			}
			var data_string = "mpor_id="+mpor_id+"&notes="+notes+"&method_type=approved";

			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("mpor/update_mpor_room_started_info/");?>",
				type: "POST",
				data: data_string,
				success: function(data){					
					$('#loader_main').hide();
					$('#apr-room-modal-'+mpor_id).modal('hide');
					$('.modal.in').modal('hide');
					tinyMCE.activeEditor.setContent('');
				}
			});
		}*/
		function mpor_gen_ticket(mpor_id){
			var room_no		= $('#room_no_'+mpor_id).val();
			var room_type	= $('#room_type_'+mpor_id).val();
			var ticket_type	= $('input[name="ticket_type"]:checked').val();
			var dept		= $('#dept_'+mpor_id).val();
			var maintenence	= $('#maintenence_'+mpor_id).val();
			var notes		= $('#notes_'+mpor_id).val();
						
			if(room_no == ''){
				$('#popup_error_'+mpor_id).html('Room number is required!!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			if(room_type == ''){
				$('#popup_error_'+mpor_id).html('Room type is required!!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			if(ticket_type == ''){
				$('#popup_error_'+mpor_id).html('Ticket type is required!!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			if(dept == ''){
				$('#popup_error_'+mpor_id).html('Please select any department!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			if(maintenence == ''){
				$('#popup_error_'+mpor_id).html('Please select any maintenence type!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			if(notes == ''){
				$('#popup_error_'+mpor_id).html('Notes are required!!');
				setTimeout(function(){$('#popup_error_'+mpor_id).html('');}, 3000);
				return false;
			}
			var data_string = "mpor_id="+mpor_id+"&room_no="+room_no+"&room_type="+room_type+"&ticket_type="+ticket_type+"&dept="+dept+"&maintenence="+maintenence+"&notes="+notes;
			
			$('#loader_main').show();
			/*$.ajax({
				url: "<?php echo site_url("welcome_call/save_mpor_ticket/");?>",
				type: "POST",
				data: data_string,
				success: function(data){
					$('#mpor_gen_ticket_'+mpor_id)[0].reset();
					
					$('#loader_main').hide();
					$('#gen-ticket-modal-'+mpor_id).modal('hide');
					$('.modal.in').modal('hide');
					tinyMCE.activeEditor.setContent('');
				}
			});*/
			var form = $('#mpor_gen_ticket_'+mpor_id)[0];
			$.ajax({
				url: "<?php echo site_url("welcome_call/save_mpor_ticket/");?>",
				type: "POST",
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData:false,
					success: function(data){
						$('.rem_file').click();
						$('#mpor_gen_ticket_'+mpor_id)[0].reset();
						$('#loader_main').hide();
						$('#gen-ticket-modal-'+mpor_id).modal('hide');
						$('.modal.in').modal('hide');
						tinyMCE.activeEditor.setContent('');
						//location.reload();
					}
				});
		}
		function updatePickupTicket(ticket_id){
			var main_div = 'update_pickup_form_'+ticket_id;
			$('#loader_main').show();
			$.ajax({
				url: "<?php echo site_url("ticket/update_ticket_info/") ?>",
				type: "POST",
				data: $('#'+main_div).serialize(),
				success: function(data){
					$('#loader_main').hide();
					location.reload();
				}
			});
		}
		function get_custom_repeat(){
			var cus_occur = $("#cus_occur").val();
			if(cus_occur == 'daily'){
				var days = $("#cus_daily_days").val();
				if(days.length > 0 && days > 0){
					$("#custom_message").text('Every '+days+' Days');
					$('.bs-pending-ticket').modal('hide');
				}else{
					alert("Please add number of days first");	
				}
			}
			else if(cus_occur == 'weekly'){
				var days 		= $("#cus_weekly_days").val();
				var chkArray 	= [];
				var weekdays;
				
				$(".chk:checked").each(function() {
					chkArray.push($(this).val());
				});
				
				weekdays = chkArray.join(', ');
				if(days == '' || days == 0){
					alert("Please add number of days first");
				}else if(weekdays.length > 0){
					$("#custom_message").text('Every '+days+' Weeks on '+ weekdays);
					$('.bs-pending-ticket').modal('hide');
				}else{
					alert("Please check at least one of the checkbox");	
				}
			}
			else if(cus_occur == 'sameDayMonth'){
				var days 	= $("#cus_sameDayMonth_days").val();
				var months 	= $("#cus_sameDayMonth_months").val();
				
				if(days == '' || days == 0){
					alert("Please add number of days first");
				}else if(months == '' || months == 0){
					alert("Please add number of months first");
				}else{
					$("#custom_message").text('Day '+days+' of every '+ months+' months');
					$('.bs-pending-ticket').modal('hide');
				}
			}
			else if(cus_occur == 'sameWeekMonth'){
				var months 	= $("#cus_sameWeekMonth_months").val();
				var weekNum	= $("#cus_sameWeekMonth_weekNum").val();
				var dayName	= $("#cus_sameWeekMonth_dayName").val();
				
				if(months == '' || months == 0){
					alert("Please add number of months first");
				}else{
					$("#custom_message").text('Every '+months+' months on the '+weekNum+' '+dayName+' of the months');
					$('.bs-pending-ticket').modal('hide');
				}
			}
			else if(cus_occur == 'sameDayYear'){
				var days		= $("#cus_sameDayYear_days").val();
				var monthsName 	= $("#cus_sameDayYear_monthsName").val();
				
				if(days == '' || days == 0){
					alert("Please add number of days first");
				}else{
					$("#custom_message").text('Every '+monthsName+' '+days);
					$('.bs-pending-ticket').modal('hide');
				}
			}
			else if(cus_occur == 'sameWeekYear'){
				var weekNum		= $("#cus_sameWeekYear_weekNum").val();
				var dayName 	= $("#cus_sameWeekYear_dayName").val();
				var monthsName 	= $("#cus_sameWeekYear_monthsName").val();
				
				$("#custom_message").text('Every year on the '+weekNum+' '+dayName+' of '+monthsName);
				$('.bs-pending-ticket').modal('hide');
			}
			else{
				$("#custom_message").text('');
			}
		}
		function delete_event(){
			var event_id 	= $("#event_id").val();
			var data_string = "event_id="+event_id;
			
			$.ajax({
				url: "<?php echo site_url("event/delete_event/");?>",
				type: "POST",
				data: data_string,
				success: function(data){}
			});
		}
		function copy_ticket_url(ticket_id){
			var copyText = document.getElementById("ticket_url_"+ticket_id);
			copyText.select();
			document.execCommand("copy");
			alert("Text copied");
		}
		function get_user_tracks(user_id){
			$('#loader_main').show();
			$.ajax({
				url:"<?php echo site_url("users/get_tracking/")?>",
				method:"POST",
				data:{user_id: user_id},
				success:function(data){
					$('#results').html(data);
					$('#loader_main').hide();
				}
			});
			$.ajax({
				url:"<?php echo site_url("users/get_tracking_records/")?>",
				method:"POST",
				data:{user_id: user_id},
				success:function(data){
					$('#total_results').html(data);
				}
			});
		}
		<?php if(isset($this->session->userdata['logged_in']['username'])){?>
			/*function SavemessageBox(ticket_id){
				var main_div = 'messageForm_'+ticket_id;
				var repl_div = '#replies_'+ticket_id;
				var edit_val = $('#edit_notes_'+ticket_id).val();
				var userName = '<?php echo $this->session->userdata['logged_in']['username'];?>';
				if(edit_val == ''){
				}else{
					$('#loader_main').show();
					var form = $('#'+main_div)[0];
					$.ajax({
						url: "<?php echo site_url("pmp/save_notes_reply/") ?>",
						type: "POST",
						//data: $('#'+main_div).serialize(),
						data: new FormData(form),
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							$('.chat-list').append('<li class="m-b-10"><div class="chat-body"><div class="chat-text"><h4>'+userName+'</h4><p>'+edit_val+'</p><b>Few Seconds Ago</b></div></div></li>');
							tinyMCE.activeEditor.setContent('');
							$('.rem_file').click();
							$('#loader_main').hide();
						}
					});
				}
			}*/
			function SaveQuickmessageBox(ticket_id){
				$('textarea#quick_message_'+ticket_id).mentionsInput('val', function(text){
					var mention_raw_user	= text.match(/\[(.*?)\]/);
					var mention_raw_userID	= text.match(/\((.*?)\)/);
					if (mention_raw_user){
						var mentioned		= $.trim(mention_raw_user[1]);
						var mentioned_HTML	= '<strong>'+mentioned+'</strong>';
						
						var mentioned_ID	= $.trim(mention_raw_userID[1]);
						var mention_userID 	= mentioned_ID.split("contact:");
						var mention_user_id	= mention_userID[1];
						
						text 				= text.replace("(contact:"+mention_user_id+")", "");
						var final_message	= text.replace("@["+mentioned+"]", mentioned_HTML);
					}else{
						var final_message	= text;
					}
					var images = '';
					$(".taggedImages_"+ticket_id+" li img").each(function(){
					  images += '<a class="image-popup-vertical-fit" href="'+$(this).attr('src')+'"><img class="img-responsive" style="margin-right: 5px; float: left;" src="'+$(this).attr('src')+'" width="50"></a>';
					})
					
					var final_messages	= final_message+ '<div style="float: left; width:100%;">'+images+ '</div>';
					$('#qmajax_'+ticket_id).val(final_messages);
					
					var main_div = 'quickMessageForm_'+ticket_id;
					var repl_div = '#replies_'+ticket_id;
					var edit_val = $('#quick_message_'+ticket_id).val();
					var userName = '<?php echo $this->session->userdata['logged_in']['username'];?>';
					if(edit_val == ''){alert('Message is required');
					}else{
						$('#loader_main').show();
						var form = $('#'+main_div)[0];
						if(mention_user_id){
							var data_string = "user_id="+mention_user_id+"&ticket_id="+ticket_id;
							$.ajax({
								url: "<?php echo site_url("pmp/save_tickets_reply_noti/") ?>",
								type: "POST",
								data: data_string,
								success: function(data){}
							});
						}
						$.ajax({
							url: "<?php echo site_url("pmp/save_notes_reply/") ?>",
							type: "POST",
							data: new FormData(form),
							contentType: false,
							cache: false,
							processData:false,
							success: function(data){
								$('#replies_'+ticket_id+' .chat-list').append('<li class="m-b-10"><div class="chat-body"><div class="chat-text"><h4>'+userName+'</h4><p>'+final_messages+'</p><b>Few Seconds Ago</b></div></div></li>');
								$('#loader_main').hide();
								$('#qmajax_'+ticket_id).val('');
								$('#quickReplyDiv_'+ticket_id).hide();
								$('.imageNo_'+ticket_id).prop('checked', false);
								$('.plane_'+ticket_id).show();
								$('.imageNo_'+ticket_id).addClass(' hidden ');
								$('.mentions').html('<div></div>');
								$('.taggedImages_'+ticket_id).html('');
								$('#quick_message_'+ticket_id).val('');
								$('#action_bar_'+ticket_id).show();
							}
						});
					}
				});
			}
		<?php }?>
		$('.showmessage').on('click', function(e){
				$('#replydiv').show();
			});
		$(".delete_selected").click(function(){
			$('.delete_selected').hide();
			$('.delete').show();
			$('.canceldel').show();
			
			$('#hdn_tr').show();
			$('.hdn_td').show();
		});
		$(".delete").click(function(){
			$('.delete_selected').show();
			$('.delete').hide();
			$('.canceldel').hide();
			
			var del_ids = '';		
			$("input[id^='del_']").each(function(index){
				var all_del_ids = $(this).attr("id");
				if($('#' + all_del_ids).is(":checked")){
					all_del_ids = all_del_ids.replace("del_", "");
					del_ids += all_del_ids+ ',';
				}
			});
			if(del_ids == ''){
				alert('Select any item to delete first!!');
			}else{
				var data_string = "mpor_ids="+del_ids;
				$.ajax({
					url: "<?php echo site_url("mpor/delete_mpor_multiple/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){
						location.reload();
					}
				});
			}
			$('#hdn_tr').hide();
			$('.hdn_td').hide();
		});
		$(".canceldel").click(function(){
			$('.delete_selected').show();
			$('.delete').hide();
			$('.canceldel').hide();
			
			$('#hdn_tr').hide();
			$('.hdn_td').hide();
		});
		
		function savempor(mpor_id){
			var notes = $('#add_notes_'+mpor_id).val();
			
			if(notes == ''){
			}else{
				$('#loader_main').show();
				var data_string = "mpor_id="+mpor_id+"&notes="+notes+"&method_type=notes";
				$.ajax({
					url: "<?php echo site_url("mpor/update_mpor_room_started_info/") ?>",
					type: "POST",
					data: data_string,
					success: function(data){
						//tinyMCE.activeEditor.setContent('');
						$('#loader_main').hide();
						$('.bs-mpor-notes-'+mpor_id).modal('hide');
						//location.reload();
					}
				});
			}
		}
		function composeLogBook(){
			var message = $('#message').val();
			var heading = $('#heading').val();
			if(heading){
			$('#loader_main').show();
			var form = $('#new_enrty_form')[0];
			$.ajax({
				url: "<?php echo site_url("logbook/save_logbook/");?>",
				type: "POST",
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData:false,
					success: function(data){
						$('.rem_file').click();
						$('#heading').val('');
						tinyMCE.activeEditor.setContent('');
						$('#loader_main').hide();
						location.reload();
					}
				});
			}else{
				alert('Subject is required');
			}
		}
		function getLeadId(id){$('#lead_id').val(id);}
		function likeParentLog(lead_id){
			$('#loader_main').show();
			var data_string = "lead_id="+lead_id;
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("logbook/save_logbook_parent_like/") ?>",
				data: data_string,
			})
			.done(function(msg){
				$('#loader_main').hide();
			});
		}
		function likeChildLog(r_lead_id){
			$('#loader_main').show();
			var data_string = "r_lead_id="+r_lead_id;
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("logbook/save_logbook_child_like/") ?>",
				data: data_string,
			})
			.done(function(msg){
				$('#loader_main').hide();
			});
		}
		function replyLogBook(){
			var message = $('#message1').val();
			if(message){
			$('#loader_main').show();
			var form = $('#new_reply_form')[0];
			$.ajax({
				url: "<?php echo site_url("logbook/save_reply_logbook/");?>",
				type: "POST",
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData:false,
					success: function(data){
						$('.rem_file').click();
						tinyMCE.activeEditor.setContent('');
						$('#loader_main').hide();
						location.reload();
					}
				});
			}else{
				alert('Message is required');
			}
		}
		function pickupTicket(ticket_id){
			var time = $('#time_'+ticket_id).val();
			if(time){
				$('#loader_main').show();
				var form = $('#pickup_form_'+ticket_id)[0];
				$.ajax({
					url: "<?php echo site_url("ticket/ticket_picked/");?>"+'/'+ticket_id,
					type: "POST",
					data: new FormData(form),
					contentType: false,
					cache: false,
					processData:false,
						success: function(data){
							$('.rem_file').click();
							tinyMCE.activeEditor.setContent('');
							$('#time_'+ticket_id).val($("#time_"+ticket_id +" option:first").val());
							$('#pick_up_ticket-'+ticket_id).modal('hide');
							$('.bs-pending-ticket-'+ticket_id).modal('hide');
							$('#loader_main').hide();
							location.reload();
						}
					});
			}else{
				alert('Estimated time of completion is required');
			}
		}	
		<?php if($this->uri->segment(2) == 'checklist'){?>
			$('input[type="checkbox"]').on('change', function(e){
				$('#item_id').val(this.value);
				var cate_id = $(this).attr('name');
				$('#cat_id').val(cate_id);
				
				if(e.target.checked){
					var cat_name	= $('#main_cat_div_'+cate_id).find('.cat_name').text();
					var scat_name	= $('.subCat_hdn_'+this.value).text();
					var room_no		= $('#room_no').val();

					$('#modal_title').html('Room #'+room_no+', '+cat_name+' --> '+scat_name);
					
					$('#checked').val(1);
					$('#add_item').modal();
				}else{					
					$('#loader_main').show();
					$('#checked').val(0);
					var hotel_id	= $('#hotel_id').val();
					var user_id		= $('#user_id').val();
					var room_no 	= $('#room_no').val();
					var room_type 	= $('#room_type').val();
					var cat_id 		= $('#cat_id').val();
					var item_id 	= $('#item_id').val();
					var quarter 	= $('#quarter').val();
					var data_string = "room_no="+ room_no +"&room_type="+room_type+"&cat_id="+cat_id+"&item_id="+item_id+"&quarter="+quarter+"&user_id="+user_id+"&hotel_id="+hotel_id;
					$.ajax({
						method: "POST",
						url: "<?php echo site_url("pmp/del_emp_checklist/") ?>",
						data: data_string,
					})
					.done(function(msg){
						$('#loader_main').hide();
					});
				}
			});
			$('#flaged').on('change', function(e){
				var flaged = this.value;
				if(flaged == 'flag'){
					$('#flaged_type').show();
					$('#flaged_type_sub').show();
					$('#outside_vendor').show();
					$('#repair_req').hide();
					$('#repair_no').hide();
					$('#repair_yes').hide();
					
				}else{
					$('#flaged_type').hide();
					$('#flaged_type_sub').hide();
					$('#outside_vendor').hide();
					$('#repair_req').show();
					$('#repair_no').hide();
				}
			});
			$('#repairno').on('click', function(e){
				$('#repair_yes').hide();
				$('#repair_no').show();
			});
			$('#repairyes').on('click', function(e){
				$('#repair_yes_notes').val('');
				$('#repair_yes').show();
				$('#repair_no').show();
			});
			$(document).ready(function (e){
				$("#uploadimage").on('submit',(function(e){
				e.preventDefault();
				$('#loader_main').show();
				$.ajax({
					url: "<?php echo site_url("pmp/save_emp_checklist/") ?>",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
						success: function(data){
							$('#add_item').modal('hide');
							$('#loader_main').hide();
							$('#uploadimage')[0].reset();
							tinyMCE.activeEditor.setContent('');
						}
					});
				}));
			});
			$('#add_item').on('hidden.bs.modal', function (e) {
				var item_id = $('#item_id').val();
				$('#subCat_'+item_id).prop('checked', false);

				$('.rem_file').click();
			  	$(this)
				.find("textarea,select")
				   .val('')
				   .end()
				.find("input[type=checkbox], input[type=radio]")
				   .prop("checked", "")
				   .end();
			});
		<?php }?>
		function changeStatusOfItem(itemId,status){
			$('#loader_main').show();
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("pmp/changeItemStatus/") ?>",
				data: {'itemId': itemId,'status': status}
			})
			.done(function(msg){
				$('#loader_main').hide();
				location.reload();
			});
		}
		function deleteItem(itemId){
			$('#loader_main').show();
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("pmp/deleteItem/") ?>",
				data: {'itemId': itemId}
			})
			.done(function(msg){
				$('#loader_main').hide();
				location.reload();
			});
		}
		/*Category*/
		function changeStatusOfCategory(categoryId,status){
			$('#loader_main').show();
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("pmp/changeCategoryStatus/") ?>",
				data: {'categoryId': categoryId,'status': status}
			})
			.done(function(msg){
				$('#loader_main').hide();
				location.reload();
			});
		}
		function deleteCategory(categoryId){
			$('#loader_main').show();
			$.ajax({
				method: "POST",
				url: "<?php echo site_url("pmp/deleteCategory/") ?>",
				data: {'categoryId': categoryId}
			})
			.done(function(msg){
				$('#loader_main').hide();
				location.reload();
			});
		}
		function popToLoadID(popup_id){
			var ticket_id = popup_id.split("-");
			var data_string = "ticket_id="+ticket_id[3];
			$.ajax({
				url: "<?php echo site_url("pmp/update_notes_reply_status/") ?>",
				type: "POST",
				data: data_string,
				success: function(data){}
			});
			setTimeout(function(){
				$(popup_id).modal();
			},400);
		}
		function showEmojies(id){
			$('#quick_message_'+id).emojiPicker({width:'300px', height: '200px', button: false});
			$('#quick_message_'+id).emojiPicker('toggle');
		}
		function tagImages(ticket_id, clicked_id){
			$('.tagImage_'+ticket_id+'_'+clicked_id).prop('checked', true);
			$('.imageNo_'+ticket_id).removeClass('hidden');
			$('.plane_'+ticket_id).hide();
			$('#action_bar_'+ticket_id).hide();
			
			var imageScr = $('#image_'+ticket_id+'_'+clicked_id).attr('src');
			$('.taggedImages_'+ticket_id).append('<li id="tagged_added_'+clicked_id+'"><img src="'+imageScr+'" alt="" data-toggle="tooltip" class="img-circlee" data-original-title="" width="160"></li>');
			$('#quickReplyDiv_'+ticket_id).show();
			$('#replydiv_'+ticket_id).hide();
		}
		$(".chk_tag").change(function(){
			var raw_id		= $(this).attr('id').split("_");
			var ticket_id	= raw_id[0];
			var clicked_id	= raw_id[1];
					
			if($('.imageNo_'+ticket_id+':checked').length == 0){
				$('.plane_'+ticket_id).show();
				$('#action_bar_'+ticket_id).show();
				$('.imageNo_'+ticket_id).addClass(' hidden ');
				
				$('#quickReplyDiv_'+ticket_id).hide();
				$('#replydiv_'+ticket_id).hide();
				$('.taggedImages_'+ticket_id).html('');
			}
			if($('.tagImage_'+ticket_id+'_'+clicked_id).is(":checked")){
				var imageScr = $('#image_'+ticket_id+'_'+clicked_id).attr('src');
				$('.taggedImages_'+ticket_id).append('<li id="tagged_added_'+clicked_id+'"><img src="'+imageScr+'" alt="" data-toggle="tooltip" class="img-circlee" data-original-title="" width="160"></li>');
			}else{
				$('#tagged_added_'+clicked_id).remove();
			}
		});
		function loadpopupModal(id){
			var data_string = "ticket_id="+id;
			$.ajax({
				url: "<?php echo site_url("pmp/update_notes_reply_status/") ?>",
				type: "POST",
				data: data_string,
				success: function(data){}
			});
		}
		function getViewsNames(id){
			$('#loader_main').show();
			var data_string = "ticket_id="+id;
			$.ajax({
				url: "<?php echo site_url("pmp/get_notes_reply_status/") ?>",
				type: "POST",
				data: data_string,
				success: function(data){
					$('#bird_eye_'+id).html(data);
					$('#loader_main').hide();
				}
			});
		}
	</script>
	<?php if($this->uri->segment(2) == 'create_ticket'){?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".frontdesk").change(function(){
					if(this.checked) {
						$('#frontdesk').show();
					}else{
						$('#frontdesk').hide();
					}
				});
				$(".housekeeping").change(function(){
					if(this.checked){
						$('#housekeeping').show();
					}else{
						$('#housekeeping').hide();
					}
				});
				$(".food").change(function(){
					if(this.checked){
						$('#foods').show();
					}else{
						$('#foods').hide();
					}
				});
				$(".sales").change(function(){
					if(this.checked){
						$('#sales').show();
					}else{
						$('#sales').hide();
					}
				});
				$(".maint").change(function(){
					if(this.checked){
						$('#maint').show();
					}else{
						$('#maint').hide();
					}
				});
				$(".manageronduty").change(function(){
					if(this.checked){
						$('#manageronduty').show();
					}else{
						$('#manageronduty').hide();
					}
				});
				$(".guestroomneeded").change(function(){
					if(this.checked) {
						$('#gstrooms').show();
						$('#nightdeptdate').show();
					}else{
						$('#gstrooms').hide();
						$('#nightdeptdate').hide();
					}
				});
				$(".meetingroomneeded").change(function(){
					if(this.checked) {
						$('#peoples').show();
					}else{
						$('#peoples').hide();
					}
				});
				$("input[name=houseguest][type=radio]").change(function(){
					if($(this).val() == 'yes'){
						$('#outhouseguest').hide();
						$('#furtherresrv').hide();
						$('#standardguest').hide();
						$('#inhouseguest').show();
					}
					if($(this).val() == 'no'){
						$('#outhouseguest').show();
						$('#inhouseguest').hide();
						$('#furtherresrv').hide();
						$('#standardguest').hide();
					}
					if($(this).val() == 'standard'){
						$('#outhouseguest').hide();
						$('#inhouseguest').hide();
						$('#furtherresrv').hide();
						$('#standardguest').show();
					}
				});
				$("input[name=special_project][type=radio]").change(function(){
					if($(this).val() == 'yes'){
						$('#sp_yes').show();
						$('#sp_no').hide();
						$('#ser_sec').hide();
						$('#hus_gst').hide();
						$("#tkt_typ").prop('required',true);
					}
					if($(this).val() == 'no'){
						$('#sp_no').show();
						$('#ser_sec').show();
						$('#hus_gst').show();
						$('#sp_yes').hide();
						$("#tkt_typ").prop('required',false);
					}
				});
				$("#tkt_typ").change(function(){
					if($(this).val() == ''){
						$('#tkt_typ_room, #public_list, #back_list, #exterior_list, #admin_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'rooms'){
						$('#tkt_typ_room').show();
						$('#public_list, #back_list, #exterior_list, #admin_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'public'){
						$('#public_list').show();
						$('#tkt_typ_room, #back_list, #exterior_list, #admin_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'back'){
						$('#back_list').show();
						$('#tkt_typ_room, #public_list, #exterior_list, #admin_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'exterior'){
						$('#exterior_list').show();
						$('#tkt_typ_room, #public_list, #back_list, #admin_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'admin'){
						$('#admin_list').show();
						$('#tkt_typ_room, #public_list, #back_list, #exterior_list, #rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
				});
				$("#tkt_typ_room_list").change(function(){
					if($(this).val() == ''){
						$('#rooms_list, #rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'allrooms'){
						$('#task_list').show();
						$('#rooms_list, #rooms_type, #rooms_floors').hide();
					}
					if($(this).val() == 'multirooms'){
						$('#rooms_list').show();
						$('#rooms_type, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'room_type'){
						$('#rooms_type').show();
						$('#rooms_list, #rooms_floors, #task_list').hide();
					}
					if($(this).val() == 'floor'){
						$('#rooms_floors').show();
						$('#rooms_list, #rooms_type, #task_list').hide();
					}
				});
				$("#public_list_1, #back_list_1, #exterior_list_1, #admin_list_1, #rooms_list_1, #rooms_type_1, #rooms_floors_1").change(function(){
					if($(this).val() == ''){
						$('#task_list').hide();
					}else{
						$('#task_list').show();
					}
				});
				$("#no_of_task").change(function(){
        			var tasks = $(this).val();
					$('#task_list_1,#task_list_2,#task_list_3,#task_list_4,#task_list_5').hide();
					
					for (i = 1; i <= tasks; i++){
						$('#task_list_'+i).show();
					}
				});
				$('#furtherresrv').hide();
				$('.furtherreservation').on('change', function(){
					if( $(this).find(":selected").val() == 'yes'){
						$('#furtherresrv').show();
					}else{
						$('#furtherresrv').hide();
					}
				});
			});
			$('.guestroomnumber').on('change', function (e){
				var optionSelected = $(".guestroomnumber option:selected").attr('data-roomtype');
				$('.inhouseguest-room').val(optionSelected);
			});
		</script>
    <?php } ?>
    
	<script>
        $(document).ready(function(){
        /*    $('.save').click(function(){
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover/edit this checklist!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, save it!",   
                    cancelButtonText: "No, cancel please!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){
                    if (isConfirm) {     
                        swal("Saved!", "Your checklist has been saved.", "success");
                        $("#add_checklist").submit();
                    } else {     
                        swal("Cancelled", "Your checklist file is ready for save :)", "error");   
                    } 
                });
            });*/
            $('.checklistNotCreated').click(function(){
                swal("Important Message!", "Please contact manager. Checklist for this room/room type has not been created yet!");
            });
			
        });
    </script>
	
    <?php if($this->uri->segment(2) == 'add_checklist' || $this->uri->segment(2) == 'view_checklist'){?>
    	<script>
            $(document).ready(function(){
				<?php if($this->uri->segment(2) == 'add_checklist'){?>
					swal("Important Message!", "This is defualt checklist. If you want to delete any category or items just uncheck those and save checklist against any room type");
				<?php } else { ?>
					swal("Important Message!", "If you want to delete any category or items just uncheck those and save checklist");
				<?php } ?>
				$(document).on('blur', '.cat, .subcat', function() {
					var id = $(this).attr("id");
					
					if($(this).hasClass("cat"))
					{
						var idOfChkBox = "checkbox_cat";
						var idOfLabel = "label_cat";
					}
					else
					{
						var idOfChkBox = "checkbox_subCat";
						var idOfLabel = "label_subCat";
					}
					
					$("#"+idOfChkBox+id).val($(this).val());
					$("#"+idOfLabel+id).text($(this).val());
					
					$(".showUs").show();
					$(".hideUs").hide();
				});
				$(document).on('click', '.edit_cat, .edit_subCat', function(){
					var myID = $(this).attr("id");
					
					if($(this).hasClass("edit_cat"))
					{
						var idOfLabel = "label_cat";
						var idOfHdnLabel = "hdn_label_cat";
						var textToReplace = "edit_cat";
					}
					else
					{
						var idOfLabel = "label_subCat";
						var idOfHdnLabel = "hdn_label_subCat";
						var textToReplace = "edit_subCat";
					}
					var newID = myID.replace(textToReplace, "");
					$("#"+idOfLabel+newID).hide();
					$("#"+idOfHdnLabel+newID).show();
					setTimeout(function(){
						$("#"+idOfHdnLabel+newID).focus();
					}, 100);
				});

				$(document).on('blur', '.cat, .subcat', function(){
					var newValue = $(this).val();
					var labelId = $(this).closest("label").attr("id").replace("hdn_label_", "label_");
					
					$("#" + labelId).text(newValue).show();
					$(this).closest("label").hide();
				});
				
				
				$('#add_category').click(function(){
					var randCategoryId = Math.floor((Math.random() * 50000) + 1);
					$('.form-body').append('<div class="white-box m-b-10 p-20" id="main_cat_div_'+randCategoryId+'"><div class="row m-t-10"><div class="col-lg-4 col-xs-12 col-sm-12"><div class="checkbox checkbox-dangerr"><input type="checkbox" name="category['+randCategoryId+'][cat_name]" id="checkbox_cat_'+randCategoryId+'" value="Name Your Category Here..." checked="checked"><label style="text-decoration:underline; font-style:italic;" class="showUs" id="label_cat_'+randCategoryId+'" for="checkbox_cat_'+randCategoryId+'">Name Your Category Here...</label><div class="btn-group m-r-10 pull-right"><button id="edit_cat_'+randCategoryId+'" class="edit_cat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button></div><label class="hideUs" style="display:none;" id="hdn_label_cat_'+randCategoryId+'"><input type="text" class="cat" id="_'+randCategoryId+'" value="Name Your Category Here..."/></label></div></div><div class="col-lg-4 col-xs-12 col-sm-12"></div><div class="col-lg-4 col-xs-12 col-sm-12"><button type="button" class="add_sub_category btn btn-danger waves-effect waves-light m-t-5 pull-right" id="'+randCategoryId+'"><i class="fa fa-plus"></i></button></div></div>');
					$('html,body').animate({
						scrollTop: $("#main_cat_div_"+randCategoryId).offset().top},
					'slow');
				});
				$(document).on('click', ".add_sub_category",function(){
					var categoryId = $(this).attr('id');
					var randSubCategoryId = Math.floor((Math.random() * 100000) + 189);

					var htmlToAppend = '<div class="row"><div class="col-lg-4 col-xs-12 col-sm-12"><div class="checkbox"><input type="checkbox" name="category['+categoryId+']['+randSubCategoryId+']" id="checkbox_subCat_'+randSubCategoryId+'" value="Name Your Item Here..." checked="checked"><label class="showUs" id="label_subCat_'+randSubCategoryId+'" for="checkbox_subCat_'+randSubCategoryId+'">Name Your Item Here...</label><div class="btn-group m-r-10 pull-right"><button id="edit_subCat_'+randSubCategoryId+'" class="edit_subCat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button></div><label class="hideUs" style="display:none;" id="hdn_label_subCat_'+randSubCategoryId+'"><input type="text" class="'+categoryId+' subcat" id="_'+randSubCategoryId+'" value="Name Your Item Here..."/></label></div></div></div>';
					$('#main_cat_div_'+categoryId).append(htmlToAppend);
				});
            });
        </script>
    <?php } ?>
    <?php if($this->uri->segment(2) == 'manage_board_checklist'){?>
    	<script>
            $(document).ready(function(){
				//swal("Important Message!", "This is defualt Board checklist. If you want delete any category or items just uncheck those and save board checklist.");
				$(document).on('blur', '.cat, .subcat', function() {
					var id = $(this).attr("id");
					
					if($(this).hasClass("cat"))
					{
						var idOfChkBox = "checkbox_cat";
						var idOfLabel = "label_cat";
					}
					else
					{
						var idOfChkBox = "checkbox_subCat";
						var idOfLabel = "label_subCat";
					}
					
					$("#"+idOfChkBox+id).val($(this).val());
					$("#"+idOfLabel+id).text($(this).val());
					
					$(".showUs").show();
					$(".hideUs").hide();
				});
				$(document).on('click', '.edit_cat, .edit_subCat', function(){
					var myID = $(this).attr("id");
					
					if($(this).hasClass("edit_cat"))
					{
						var idOfLabel = "label_cat";
						var idOfHdnLabel = "hdn_label_cat";
						var textToReplace = "edit_cat";
					}
					else
					{
						var idOfLabel = "label_subCat";
						var idOfHdnLabel = "hdn_label_subCat";
						var textToReplace = "edit_subCat";
					}
					var newID = myID.replace(textToReplace, "");
					$("#"+idOfLabel+newID).hide();
					$("#"+idOfHdnLabel+newID).show();
					$("#"+idOfHdnLabel+newID).focus();
				});
				
				$('#add_category').click(function(){
					var randCategoryId = Math.floor((Math.random() * 50000) + 1);
					$('.form-body').append('<div class="white-box m-b-10 p-20" id="main_cat_div_'+randCategoryId+'"><div class="row m-t-10"><div class="col-lg-4 col-xs-12 col-sm-12"><div class="checkbox checkbox-dangerr"><input type="checkbox" name="category['+randCategoryId+'][cat_name]" id="checkbox_cat_'+randCategoryId+'" value="Name Your Category Here..." checked="checked"><label style="text-decoration:underline; font-style:italic;" class="showUs" id="label_cat_'+randCategoryId+'" for="checkbox_cat_'+randCategoryId+'">Name Your Category Here...</label><div class="btn-group m-r-10 pull-right"><button id="edit_cat_'+randCategoryId+'" class="edit_cat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button></div><label class="hideUs" style="display:none;" id="hdn_label_cat_'+randCategoryId+'"><input type="text" class="cat" id="_'+randCategoryId+'" value="Name Your Category Here..."/></label></div></div><div class="col-lg-4 col-xs-12 col-sm-12"></div><div class="col-lg-4 col-xs-12 col-sm-12"><button type="button" class="add_sub_category btn btn-danger waves-effect waves-light m-t-5 pull-right" id="'+randCategoryId+'"><i class="fa fa-plus"></i></button></div></div>');
					$('html,body').animate({
						scrollTop: $("#main_cat_div_"+randCategoryId).offset().top},
					'slow');
				});
				$(document).on('click', ".add_sub_category",function(){
					var categoryId = $(this).attr('id');
					var randSubCategoryId = Math.floor((Math.random() * 100000) + 189);

					var htmlToAppend = '<div class="row"><div class="col-lg-4 col-xs-12 col-sm-12"><div class="checkbox"><input type="checkbox" name="category['+categoryId+']['+randSubCategoryId+']" id="checkbox_subCat_'+randSubCategoryId+'" value="Name Your Item Here..." checked="checked"><label class="showUs" id="label_subCat_'+randSubCategoryId+'" for="checkbox_subCat_'+randSubCategoryId+'">Name Your Item Here...</label><div class="btn-group m-r-10 pull-right"><button id="edit_subCat_'+randSubCategoryId+'" class="edit_subCat btn btn-defaultt btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-pencil m-r-5"></i></button></div><label class="hideUs" style="display:none;" id="hdn_label_subCat_'+randSubCategoryId+'"><input type="text" class="'+categoryId+' subcat" id="_'+randSubCategoryId+'" value="Name Your Item Here..."/></label></div></div></div>';
					$('#main_cat_div_'+categoryId).append(htmlToAppend);
				});
            });
        </script>
    <?php } ?>
	
    <!-- ASYNCHRONOUS Google Translate -->
    	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script type="text/javascript">
			function getCookie(cname){
				var name = cname + "=";
				var decodedCookie = decodeURIComponent(document.cookie);
				var ca = decodedCookie.split(';');
				for(var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}
			function delete_cookie( name, path, domain ) {
			  if( get_cookie( name ) ) {
				document.cookie = name + "=" +
				  ((path) ? ";path="+path:"")+
				  ((domain)?";domain="+domain:"") +
				  ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
			  }
			}
			function googleTranslateElementInit(){
				new google.translate.TranslateElement({
					pageLanguage: 'en',
					layout: google.translate.TranslateElement.FloatPosition.TOP_RIGHT,
					autoDisplay: true //phly false tha ya
				}, 'google_translate_element');
			}
			(function (){
				var googleTranslateScript = document.createElement('script');
				googleTranslateScript.type = 'text/javascript';
				googleTranslateScript.async = true;
				googleTranslateScript.src =	'//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(
					googleTranslateScript);
			})();
			
			<?php if(isset($this->session->userdata['logged_in']['lang']) && $this->session->userdata['logged_in']['lang'] == 'en'){?>
				document.cookie = "GoogleAccountsLocale_session=-1; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/";
				document.cookie = "googtrans=-1; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/";
				document.cookie = "googtrans=-1; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/; domain=hops247.com";
			<?php }else{?>				
				Cookies.set('GoogleAccountsLocale_session', 'es', { expires: 999 });//es
				Cookies.set('googtrans', '/en/es', { expires: 999 });// /en/es
			<?php }?>
        </script>
    <!-- End script -->
	<script>
		$(document).ready(function(){
			/*DASHBOARD SLIDER*/
			var speed = 5000;
			var run = setInterval(rotate, speed);
			var slides = $('.slide');
			var container = $('#slides ul');
			var elm = container.find(':first-child').prop("tagName");
			var item_width = container.width();
			var previous = 'prev'; //id of previous button
			var next = 'next'; //id of next button
			slides.width(item_width); //set the slides to the correct pixel width
			container.parent().width(item_width);
			container.width(slides.length * item_width); //set the slides container to the correct total width
			container.find(elm + ':first').before(container.find(elm + ':last'));
			resetSlides();
			
			//if user clicked on prev button
			$('#buttons a').click(function (e) {
				//slide the item
				
				if (container.is(':animated')) {
					return false;
				}
				if (e.target.id == previous) {
					container.stop().animate({
						'left': 0
					}, 1500, function () {
						container.find(elm + ':first').before(container.find(elm + ':last'));
						resetSlides();
					});
				}
				
				if (e.target.id == next) {
					container.stop().animate({
						'left': item_width * -2
					}, 1500, function () {
						container.find(elm + ':last').after(container.find(elm + ':first'));
						resetSlides();
					});
				}
				
				//cancel the link behavior            
				return false;
				
			});
			
			//if mouse hover, pause the auto rotation, otherwise rotate it    
			container.parent().mouseenter(function () {
				clearInterval(run);
			}).mouseleave(function () {
				run = setInterval(rotate, speed);
			});
			function resetSlides() {
				//and adjust the container so current is in the frame
				container.css({
					'left': -1 * item_width
				});
			}});
		function rotate(){
			$('#next').click();
		}
		
		    </script>
    
<?php if($this->uri->segment(2) == 'agenda_checklist'){?>
    <script>
		$(document).ready(function(){
			$("#page_list").sortable({
				placeholder : "ui-state-highlight",
				update : function(event, ui){
					$('#loader_main').show();
					var page_id_array = new Array();
					$('#page_list tr').each(function(){
						page_id_array.push($(this).attr("id"));
					});
					$.ajax({
						url:"<?php echo site_url("agenda/update_priority_of_agenda_list/") ?>",
						method:"POST",
						data:{page_id_array:page_id_array},
						success:function(data){
							$('#loader_main').hide();
						}
					});
				}
			});
		});
	</script>
<?php }?>

<?php if($this->uri->segment(1) == 'message'){?>
    <link href="<?php echo base_url();?>assets/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
    
    <script>
        $(document).ready(function(){
            $(".select2").select2();
        });
    </script>
<?php }?>
</body>
</html>