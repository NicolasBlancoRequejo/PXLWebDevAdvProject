<?php echo validation_errors(); ?>
<div class="page-header">
    <h1><?php echo $page_heading; ?></h1>
</div>
<div class="span8">
    <?php echo form_open('me/index', 'role="form"'); ?>
    
    <div class="form-group">
        <?php echo form_error('usr_fname'); ?>
        <label for="usr_fname"><?php echo $this->lang->line('usr_fname'); ?></label>
        <?php echo form_input($usr_fname); ?>
    </div>
    <div class="form-group">
        <?php echo form_error('usr_lname'); ?>
        <label for="usr_lname"><?php echo $this->lang->line('usr_lname'); ?></label>
        <?php echo form_input($usr_lname); ?>
    </div>  
    <div class="form-group">
        <?php echo form_error('usr_uname'); ?>
        <label for="usr_uname"><?php echo $this->lang->line('usr_uname'); ?></label>
        <?php echo form_input($usr_uname); ?>
    </div>   

    <div class="form-group">
        <label for="usr_email"><?php echo $this->lang->line('usr_email'); ?></label>
        <?php echo form_input($usr_email); ?>
    </div>   
    <div class="form-group">
        <label for="usr_confirm_email"><?php echo $this->lang->line('usr_confirm_email'); ?></label>
        <?php echo form_input($usr_confirm_email); ?>
    </div>   

    <div class="form-group">
        <label for="usr_add1"><?php echo $this->lang->line('usr_add1'); ?></label>
        <?php echo form_input($usr_add1); ?>
    </div>  
    <div class="form-group">
        <label for="usr_add2"><?php echo $this->lang->line('usr_add2'); ?></label>
        <?php echo form_input($usr_add2); ?>
    </div>          
    <div class="form-group">
        <label for="usr_add3"><?php echo $this->lang->line('usr_add3'); ?></label>
        <?php echo form_input($usr_add3); ?>
    </div> 
    <div class="form-group">
        <label for="usr_town_city"><?php echo $this->lang->line('usr_town_city'); ?></label>
        <?php echo form_input($usr_town_city); ?>
    </div>         
    <div class="form-group">
        <label for="usr_zip_pcode"><?php echo $this->lang->line('usr_zip_pcode'); ?></label>
        <?php echo form_input($usr_zip_pcode); ?>
    </div>        
    
    <div class="form-group">
        <?php echo form_error('usr_profilepic'); ?>
        <label for="usr_profilepic"><?php echo $this->lang->line('usr_profilepic'); ?></label>
        <?php echo form_input($usr_profilepic); ?>
    </div>

    <?php echo form_hidden($id); ?>

    <div class="form-group">
        <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go'); ?></button> or <button type="submit" class="btn btn-success"><?php echo anchor('users', $this->lang->line('common_form_elements_cancel')); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>

<?php echo anchor('me/change_password/', 'Change Password'); ?>