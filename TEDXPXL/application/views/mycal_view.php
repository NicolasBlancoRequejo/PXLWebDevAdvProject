<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<title>My calendar</title>
		<!--		
			<link src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" />
			<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-theme.min.css"); ?>" />
		-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
		<script type="text/javascript" src="<?php echo base_url("assets/js/modal.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquerycode.php"); ?>"></script>
		<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700);
			.calendar {
			font-family: 'Open Sans',sans-serif;
			font-size: 12px;
			border: 3px #AB0505 solid;
			}
			table.calendar {
			margin: auto;			
			}
			.calendar .days td {
			width: 180px;
			height: 140px;
			padding: 4px;
			border: 2px solid white;
			vertical-align: top;
			background-color: #808080;	
			text-align: center;
			vertical-align: middle;
			}
			.calendar .days td:hover {
			background-color: #FF2B06;
			}
			.calendar .highlight {
			color: #AB0505;
			//font-size: 40px;
			}
			.day_num {
			font-size: 25px;
			color: white;
			}
			.neprcell {
			font-size: 15px;
			text-align: center;
			}
			.weekdays {
			font-size: 15px;
			text-align: center;
			background-color: #AB0505;
			color: white;
			}
			.title {
			text-align: center;
			font-size: 30px;
			}
			.heading {
			background-color: #AB0505;
			color: white;
			}
			#foto {
			position: relative;
			left: -16px;
			bottom: -5px;
			display: block;
			}
		</style>
		
	</head>
	
	<body>
		<?php echo $calendar; ?>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.calendar .day').click(function() {
					openModal();
				})
			});
		</script>
		
		<div id="eventModal" class="modal fade">
			<div class="modal-dialog">
				<div id="modalContent" class="modal-content">
					<div class="modal-header" style="text-align: center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<script type="text/javascript">
							$('.calendar .day').click(function() {	
								day_data = $(this).find('.content').html();
								if (!day_data) {
									$('#eventp').text("No event");
								}
								else {
									$('#eventp').text(day_data);
								}								
							});
						</script>
						<h1 id="eventp"></h1>				
					</div>
					<div class="modal-body" style="text-align: center">
						<h3>Lorem ipsum dolor sit amet, ea pro erant laboramus, consequat quaerendum instructior nam ne. 
							Autem quidam ex qui. 
							Eu has perfecto suavitate instructior, ea his mazim bonorum, mea ludus eirmod ex. 
							Ei sumo tritani sea, ad mea reque scaevola euripidis, an quo probo perfecto convenire.
						</h3>
					</div>
					<div class="modal-footer" style="text-align: center">
						<button class="btn btn-lg" onclick="addEvent();">Add</button>
						<button class="btn btn-lg" onclick="editEvent();">Edit</button>
						<button class="btn btn-lg" onclick="deleteEvent();">Delete</button>					
					</div>
				</div>
			</div>
		</div>
		
		<div id="addModal" class="modal fade">
			<div class="modal-dialog">
				<div id="modalContent" class="modal-content">
					<div class="modal-header" style="text-align: center">
						<h1>Add event</h1>
					</div>
					<form class="form-horizontal" role="form" method="post" >
						<div class="modal-body" style="text-align: center">
							
							<div class="form-group">
								<label for="beginuur" class="col-sm-2 control-label">Start&nbsp;time:</label>
								<div class="col-sm-10">
									<input type="time" name="beginuur" class="required col-sm-2 col-lg-3" id="beginuur"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="einduur" class="col-sm-2 control-label">End&nbsp;time:</label>
								<div class="col-sm-10">
									<input type="time" name="einduur" class="col-sm-2 col-lg-3" id="einduur"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="commentaar" class="col-sm-2 control-label">Comment:</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="5" id="commentaar"></textarea>
								</div>
							</div>	
							<div class="form-group">								
								<label for="locatie" class="col-sm-2 control-label">Location:</label>
								<div class="col-sm-10">
									<input type="text" name="locatie" class="col-sm-2 col-lg-3" id="locatie"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="foto" class="col-sm-2 control-label">Photo's:</label>
								<div class="col-sm-10">
									<input type="file" name="foto" class="col-sm-2 col-lg-8" id="foto"/>
								</div>
							</div>
							
						</div>
						<div class="modal-footer" style="text-align: right">
							<input type="reset" class="btn btn-lg" onclick="cancelAddEvent();" value="Cancel" />
							<input type="submit" class="btn btn-lg btn-primary" id="addSave" value="Save"/>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div id="modalContent" class="modal-content">
					<div class="modal-header" style="text-align: center">
						<h1>Edit event</h1>
					</div>
					<div class="modal-body" style="text-align: center">
						<form class="form-horizontal" role="form" >
							<div class="form-group">
								<label for="beginuur" class="col-sm-2 control-label">Start&nbsp;time:</label>
								<div class="col-sm-10">
									<input type="time" name="beginuur" class="required col-sm-2 col-lg-3" id="beginuur"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="einduur" class="col-sm-2 control-label">End&nbsp;time:</label>
								<div class="col-sm-10">
									<input type="time" name="einduur" class="col-sm-2 col-lg-3" id="einduur"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="commentaar" class="col-sm-2 control-label">Comment:</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="5" id="commentaar"></textarea>
								</div>
							</div>	
							<div class="form-group">								
								<label for="locatie" class="col-sm-2 control-label">Location:</label>
								<div class="col-sm-10">
									<input type="text" name="locatie" class="col-sm-2 col-lg-3" id="locatie"/>
								</div>
							</div>
							<div class="form-group">								
								<label for="foto" class="col-sm-2 control-label">Photo's:</label>
								<div class="col-sm-10">
									<input type="file" name="foto" class="col-sm-2 col-lg-8" id="foto"/>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer" style="text-align: right">
						<button class="btn btn-lg" onclick="cancelEditEvent();">Cancel</button>
						<button type="submit" class="btn btn-lg btn-primary" onclick="saveEditEvent();">Save</button>
					</div>
				</div>
			</div>
		</div>
		<div id="deleteModal" class="modal fade">  
			<div class="modal-dialog">
				<div id="modalContent" class="modal-content">
					<div class="modal-header">  
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  
						<h3 id="myModalLabel">Warning</h3>  
					</div>  
					<div class="modal-body">  
						<p>Are you sure you want to delete this event? Click 'Yes' to proceed otherwise click 'No'.</p>  
					</div>  
					<div class="modal-footer">  
						<button id="btn_No" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-white"></i>No</button>  
						<button id="btn_YesDel" class="btn btn-primary"><i class="icon-ok icon-white"></i>Yes</button>  
					</div>  
				</div>
			</div>
		</div>  
		
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	</body>
</html>							