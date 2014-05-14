    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
               <?php 
        $is_admin = $this->session->userdata('is_admin');
        if($is_admin==1){?>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst("Users");?>
          </a> 
          <span class="divider">/</span>
        </li>
        <?php }?>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst("User");?>
        </h2>
      </div>

<div class="container">
    <fieldset>
       
<?php
$attributes = array('class' => 'form-signin','style' => 'max-width:500px;');
echo validation_errors();
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Create an account</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="First name"').'&nbsp;&nbsp;&nbsp;';
echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"').'&nbsp;&nbsp;&nbsp;';
echo form_input('email_address', set_value('email_address'), 'placeholder="Email"').'&nbsp;&nbsp;&nbsp;';

echo form_input('username', set_value('username'), 'placeholder="Username"').'&nbsp;&nbsp;&nbsp;';
echo form_password('password', '', 'placeholder="Password"').'&nbsp;&nbsp;&nbsp;';
echo form_password('password2', '', 'placeholder="Password confirm"').'&nbsp;&nbsp;&nbsp;';

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
        </fieldset>
</div>
    </div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>