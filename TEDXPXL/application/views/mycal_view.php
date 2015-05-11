<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="UTF-8">
	<title>My calendar</title>
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
			font-size: 40px;
		}
		.day_num {
			font-size: 25px;
			color: white;
		}
		.neprcell {
			font-size: 15px;
			color: white;
		}
		.weekdays {
			font-size: 15px;
			text-align: center;
			background-color: #AB0505;
			color: white;
		}
		.title {
			font-size: 30px;
		}
		.heading {
			background-color: #AB0505;
			color: white;
		}
	</style>

	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<?php echo $calendar; ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.calendar .day').click(function() {
			day_num = $(this).find('.day_num').html();
			day_data = prompt('Enter or edit event', $(this).find('.content').html());
			if (day_data != null) {
				$.ajax({
					url: window.location,
					type: 'POST', 
					data: {
						day: day_num,
						data: day_data
					},
					success: function(msg) {
						location.reload();
					}
				});
			}
		})
	});
	</script>

</body>
</html>