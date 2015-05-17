function openModal() {
	$('#eventModal').modal('show');
}

function addEvent() {
	$('#addModal').modal('show');
}

function editEvent() {
	$('#editModal').modal('show');
}

/*function saveAddEvent() { 
	$('#addSave').click(function( e ) {  
		e.preventDefault();  
		var beginuur = $('#beginuur').val();  
		var einduur = $('#einduur').val();  
		var commentaar = $('#commentaar').val();  
		var locatie = $('#locatie').val();  
		var foto = $('#foto').val();  
		$.ajax({  
			type: "POST",  
			url: "<?=base_url()?>index.php/applicant_work/update",  
			cache: false,  
			dataType: "json",  
			data: 'id='+id+'&Eposition='+position+'&Edesignation='+designation+'&Eworkplace='+workplace+'&dtFrom='+dtFrom+'&dtTo='+dtTo+'&Esector='+sector+'&Egrade='+grade,  
			success: function(result){  
			if(result.error) {  
			$(".alert").fadeIn('slow');  
			$("#error_message").html(result.message);  
			} else {        
			$(location).attr('href','<?php echo base_url() ?>index.php/applicant_work/refresh/'+modul_id);        }  
			}  
		});
		alert(commentaar);
	});
}*/

function saveEditEvent() {
	
}

function cancelAddEvent() {
	$('#addModal').modal('hide');
}

function cancelEditEvent() {
	$('#editModal').modal('hide');
}

function deleteEvent() {
	$('#deleteModal').modal('show');
}