<body>	
    <div class="container" id="main">
        <div class="navbar navbar-fixed-top">
            <div class="container">
                <button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="/"><img src="<?php echo base_url(); ?>images/logo.png" alt="Your Logo"></a>

                <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">News</a></li>                           
                        <li><a href="#">Forum</a></li>                           
                        <li><a href="#">Events</a></li>    
                        <li><a href="#">Contact</a></li>                           


                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Registreer<strong class="caret"></strong></a>
                            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                <?php
                                echo form_open('site/signup_validation');

                                echo validation_errors();

                                echo "<p>Email: ";
                                echo form_input('email', $this->input->post('email'));
                                echo "</p>";

                                echo "<p>Wachtwoord: ";
                                echo form_password('password');
                                echo "</p>";

                                echo "<p>Bevestig wachtwoord: ";
                                echo form_password('cpassword');
                                echo "</p>";

                                echo "<p>";
                                echo form_submit('signup_submit', 'Registreer','class="btn btn-default"');
                                echo "</p>";

                                echo form_close();
                                ?>
                            </div>
                        </li>
                    </ul>

                    
                    <ul class="nav pull-right">
                        <li class="dropdown">
                          <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
                          <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                               <?php

                                echo form_open('site/login_validation');

                                        echo validation_errors();

                                        echo "<p>Email: <br />";
                                        echo form_input('email',$this->input->post('email'));
                                        echo "</p>";

                                        echo "<p>Password: <br />";
                                        echo form_password('password');
                                        echo "</p>";

                                        echo "<p>";
                                        echo form_submit('login_submit', 'Login','class="btn btn-default"');
                                        echo "</p>";

                                echo form_close();

                                ?>
                          </div>
                        </li>
                    </ul>
                    <form class="navbar-form pull-left">
                        <input type="text" class="form-control" placeholder="Search this site..." id="searchInput">
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>

                </div>

            </div>
            
        </div>
