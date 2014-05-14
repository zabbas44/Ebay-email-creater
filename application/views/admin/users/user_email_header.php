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
          <a href="#">Email Header</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Email <?php echo ucfirst("Header");?>
        </h2>
      </div>

<div class="container">
    <fieldset>
       
<?php

$attributes = array('class' => 'form-signin','style' => 'max-width:500px;','enctype'=>"multipart/form-data");
echo validation_errors();
echo form_open('admin/user_list/email_header/'.$this->uri->segment(4).'', $attributes);

$title = (isset($user['email_header_title']))?$user['email_header_title']:'';
$image = (isset($user['email_header']))?$user['email_header']:'';
echo '<h2 class="form-signin-heading">Email Account Header</h2>';
echo form_input('header_title', $title , 'placeholder="Header Title"').'&nbsp;&nbsp;&nbsp;';
?>
<div class="control-group">
    <span style="font-size: 18px;font-weight: bold;">Header Image</span>
    <div class="controls">
      <input type="file" name="email_header" id="email_header" />
      <input type="hidden" name="email_header_hidden" id="email_header_hidden" value="<?php echo $image; ?>"  />
      <!--<span class="help-inline">OOps</span>-->
      <br />
      <img src="<?php echo base_url().$image;?>" />
    </div>
  </div>
    
    <?php 
echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
        </fieldset>
</div>
    </div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>