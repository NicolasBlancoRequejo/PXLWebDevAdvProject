<body>	
    <div class="container" id="main">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="<?php echo base_url("home"); ?>"><img src="<?php echo base_url('images/logo.png"'); ?>" alt="Your Logo"></a>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url("home"); ?>">Home</a></li>
            <?php if ($this->session->userdata('logged_in') == TRUE) : ?>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Forum <strong class="caret"></strong></a>

                    <ul class="dropdown-menu">
                            <li><?php echo anchor(base_url('Discussions'), $this->lang->line('top_nav_forum')) ; ?></li>

                            <?php if ($this->session->userdata('usr_access_level') == 1) : ?>
                                <li><?php echo anchor(base_url('admin/dashboard'), $this->lang->line('top_nav_dashboard')) ; ?></li>
                            <?php endif ; ?>
                            <li><?php echo anchor(base_url('Discussions/create'), $this->lang->line('top_nav_create_discussion')) ; ?></li>


                    </ul>
                </li>
            <?php else : ?>
                <li><a href="<?php echo base_url("discussions"); ?>">Forum</a></li>    
            <?php endif ; ?>
            <li><a href="#">Events</a></li>    
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <?php if ($this->session->userdata('logged_in') == TRUE) : ?>
              <li><?php echo anchor(base_url('me'), $this->lang->line('top_nav_profiel')) ; ?></li>
              <li><?php echo anchor(base_url('signin/signout'), $this->lang->line('top_nav_signout')) ; ?></li>
            <?php else : ?>
              <li><?php echo anchor(base_url('signin'), $this->lang->line('top_nav_signin')) ; ?></li>
            <?php endif ; ?>
          </ul>
          <form class="navbar-form pull-left">
            <input type="text" class="form-control" placeholder="Search this site..." id="searchInput">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="views">