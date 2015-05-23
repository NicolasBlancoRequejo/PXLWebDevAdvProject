<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<title>My calendar</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
		<script type="text/javascript" src="<?php echo base_url("assets/js/modal.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquerycode.php"); ?>"></script>
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>		
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
			#autocomplete {
			position: relative;
			margin-left: -172px;
			margin-top: 4px;
			width: 300px;
			}
			.modal {
			z-index: 20;
			}
		</style>
		
	</head>
	
	<body onload="initialize()">
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
								day_num = $(this).find('.day_num').html();
								document.getElementById('datum').value = day_num;
								day_data = $(this).find('.content').html();
								if (!day_data) {
									$('#eventp').text("No event");	
									document.getElementById('addButton').style.display = "";
									document.getElementById('editButton').style.display = "none";
									document.getElementById('deleteButton').style.display = "none";
								}
								else {									
									$('#eventp').text(day_data);
									document.getElementById('addButton').style.display = "none";
									document.getElementById('editButton').style.display = "";
									document.getElementById('deleteButton').style.display = "";
								}
								$.get('http://localhost/TEDXPXL.be/mycal/getStartTime/'+encodeURI(day_data), function(data){$('#h3beginuur').text("Start time: " + data)});
								$.get('http://localhost/TEDXPXL.be/mycal/getEndTime/'+encodeURI(day_data), function(data){$('#h3einduur').text("End time: " + data)});
								$.get('http://localhost/TEDXPXL.be/mycal/getComment/'+encodeURI(day_data), function(data){$('#h3comment').text("Comment: " + data)});		
								$.get('http://localhost/TEDXPXL.be/mycal/getLocation/'+encodeURI(day_data), function(data){$('#h3locatie').text("Location: " + data)});	
								$.get('http://localhost/TEDXPXL.be/mycal/getLocation/'+encodeURI(day_data), function(data){$('#h3map-canvas').attr('src', "https://www.google.com/maps/embed/v1/place?key=AIzaSyARMLp4OYW9VYpOvYS_SmSwsb2F2vHEwRY&q=" + data)});	
							});
						</script>
						<h1 name="eventp" id="eventp"></h1>				
					</div>
					<div class="modal-body" style="text-align: center">
						<h3 id="h3beginuur" name="h3beginuur"></h3>
						<h3 id="h3einduur" name="h3einduur"></h3>
						<h3 id="h3comment" name="h3comment"></h3>	
						<h3 id="h3locatie" name="h3locatie"></h3>
						<iframe
						width="550"
						height="350"
						frameborder="0" 
						style="border:0"
						id="h3map-canvas">
						</iframe>
					</div>
					<div class="modal-footer" style="text-align: center">
						<button class="btn btn-lg" name="addButton" id="addButton" onclick="addEvent();">Add</button>
						<button class="btn btn-lg" name="editButton" id="editButton" onclick="editEvent();">Edit</button>
						<button class="btn btn-lg" name="deleteButton" id="deleteButton" onclick="deleteEvent();">Delete</button>					
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
					<?php
						$attributes = array("class" => "form-horizontal", "role" => "form", "method" => "post");
						echo form_open(base_url()."mycal/showcal", $attributes);
					?>
					<div class="modal-body" style="text-align: center">
						<div class="form-group">
							<div class="col-sm-10">
								<input type="hidden" name="datum" class="required col-sm-2 col-lg-10" id="datum" value="" />
							</div>
						</div>
						<div class="form-group">
							<label for="naam" class="col-sm-2 control-label">Name:</label>
							<div class="col-sm-10">
								<input type="text" maxlength="255" name="naam" class="required col-sm-2 col-lg-10" id="naam"/>
							</div>
						</div>
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
								<textarea class="form-control" maxlength="255" rows="5" name="commentaar" id="commentaar"></textarea>
							</div>
						</div>	
						<div class="form-group">								
							<label for="autocomplete" class="col-sm-2 control-label">Location:</label>
							<div id="locationField" class="col-sm-10">
								<input id="autocomplete" onFocus="geolocate()" type="text" name="autocomplete"></input>
							</div>
						</div>
						<iframe
						width="550"
						height="350"
						frameborder="0" style="border:0"
						id="map-canvas";
						src="https://www.google.com/maps/embed/v1/place?key=AIzaSyARMLp4OYW9VYpOvYS_SmSwsb2F2vHEwRY&q=Hogeschool+PXL,Hasselt">
						</iframe>
					</div>
					<div class="modal-footer" style="text-align: right">
						<input type="reset" class="btn btn-lg" onclick="cancelAddEvent();" value="Cancel" />
						<input type="submit" class="btn btn-lg btn-primary" id="addSave" value="Save"/>
					</div>
					<?php
						echo form_close();
					?>
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
						<?php
							$attributes = array("class" => "form-horizontal", "role" => "form", "method" => "post");
							echo form_open(base_url()."mycal/editEvent", $attributes);
						?>
						<script type="text/javascript">
							$('#editButton').click(function() {	
								day_data = $(this).find('#eventp').html();
								day_data = "PXL breekt uit";
								$.get('http://localhost/TEDXPXL.be/mycal/editEvent/'+encodeURI(day_data), function(data){$('#editNaam').val(data); $('#editBeginuur').val()});
							});
						</script>
						<div class="form-group">
							<label for="editNaam" class="col-sm-2 control-label">Name:</label>
							<div class="col-sm-10">
								<input type="text" maxlength="255" name="editNaam" class="required col-sm-2 col-lg-10" id="editNaam" /> 
							</div>
						</div>
						<div class="form-group">
							<label for="editBeginuur" class="col-sm-2 control-label">Start&nbsp;time:</label>
							<div class="col-sm-10">
								<input type="time" name="editBeginuur" class="required col-sm-2 col-lg-3" id="editBeginuur"/>
							</div>
						</div>
						<div class="form-group">								
							<label for="editEinduur" class="col-sm-2 control-label">End&nbsp;time:</label>
							<div class="col-sm-10">
								<input type="time" name="editEinduur" class="col-sm-2 col-lg-3" id="editEinduur"/>
							</div>
						</div>
						<div class="form-group">								
							<label for="editCommentaar" class="col-sm-2 control-label">Comment:</label>
							<div class="col-sm-10">
								<textarea class="form-control" maxlength="255" rows="5" id="editCommentaar" name="editCommentaar"></textarea>
							</div>
						</div>	
						<div class="form-group">								
							<label for="autocomplete" class="col-sm-2 control-label">Location:</label>
							<div id="locationField" class="col-sm-10">
								<input id="autocomplete" onFocus="geolocate()" type="text" name="autocomplete"></input>
							</div>
						</div>
						<iframe
						width="550"
						height="350"
						frameborder="0" style="border:0"
						id="map-canvas";
						src="https://www.google.com/maps/embed/v1/place?key=AIzaSyARMLp4OYW9VYpOvYS_SmSwsb2F2vHEwRY&q=Hogeschool+PXL,Hasselt">
						</iframe>
						<?php
							echo form_close();
						?>
					</div>
					<div class="modal-footer" style="text-align: right">
						<input type="reset" class="btn btn-lg" onclick="cancelEditEvent();" value="Cancel" />
						<input type="submit" class="btn btn-lg btn-primary" id="editSave" value="Save"/>
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
						<?php
							$attributes = array("method" => "post");
							echo form_open(base_url()."mycal/delEvent", $attributes);
						?>
						<p>Are you sure you want to delete this event? Click 'Yes' to proceed otherwise click 'No'.</p>  
						<input type="hidden" name="delNaam" class="required col-sm-2 col-lg-10" id="delNaam" value="" />
					<script type="text/javascript">
					$('.calendar .day').click(function() {	
					day_data = $(this).find('.content').html();
					document.getElementById('delNaam').value = day_data;
					});
					</script>
					</div>  
					<div class="modal-footer">  
					
					<div>
					<button id="btn_NoDel" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-white"></i>No</button>  
					<input type="submit" name ="btn_YesDel" id="btn_YesDel" class="btn btn-primary" value="Yes">
					</div>
					<?php
					echo form_close();
					?>
					</div>  
					</div>
					</div>
					</div>  
					
					<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.js"); ?>"></script>
					<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
					</body>
					</html>													