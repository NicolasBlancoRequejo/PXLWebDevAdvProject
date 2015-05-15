<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registreer pagina</title>
</head>
<body>	
    <div id="container">
	<h1>Registreer</h1>
        
        <?php
        echo form_open('site/signup_validation');
        
        echo validation_errors();
        
        echo "<p>Email: ";
        echo form_input('email',$this->input->post('email'));
        echo "</p>";
        
        echo "<p>Wachtwoord: ";
        echo form_password('password');
        echo "</p>";
        
        echo "<p>Bevestig wachtwoord: ";
        echo form_password('cpassword');
        echo "</p>";
        
        echo "<p>";
        echo form_submit('signup_submit','Registreer');
        echo "</p>";
        
        echo form_close();
        ?>
        
        
    </div>
</body>
</html>

