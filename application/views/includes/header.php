<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Link Affiliate Code Generator</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  
  <script src="<?php echo base_url(); ?>files/js/jquery1.9.js"></script>
  <script src="<?php echo base_url(); ?>files/ckeditor/ckeditor.js"></script>
  
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
                <a class="brand" style="color: #ffffff;">Link Affiliate Code Generator</a>
	      <ul class="nav">
                 <?php 
                 $is_admin = $this->session->userdata('is_admin');
                 $lg_id = $this->session->userdata('lg_id');
                    if($is_admin==1){
                 ?> 
	        <li <?php if($this->uri->segment(2) == 'user_list'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/user_list">Users</a>
	        </li>
                    <?php }?>
	        <li <?php if($this->uri->segment(2) == 'affiliate_code'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/affiliate_code">Affiliate Code</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'affiliate_code'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/user_list/email_header/<?php echo $lg_id;?>">Email header</a>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>admin/user_list/update/<?php echo $lg_id;?>">Account</a>
	            </li>
                    <li>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>
                    
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	
