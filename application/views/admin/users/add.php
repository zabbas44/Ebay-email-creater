    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst("Users");?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst("User");?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new User created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      <div class="container login">
<?php
$attributes = array('class' => 'form-signin');
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Create an account</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="First name"');
echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"');
echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');

echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password"');
echo form_password('password2', '', 'placeholder="Password confirm"');

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => 'add','enctype'=>"multipart/form-data");
      

      //form validation
      echo validation_errors();
      
      echo form_open('admin/create_member/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">RFID</label>
            <div class="controls">
              <input type="text" id="" name="rfid" value="<?php echo set_value('rfid'); ?>" />
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Make</label>
            <div class="controls">
              <input type="text" id="" name="make" value="<?php echo set_value('car make'); ?>" />
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Model</label>
            <div class="controls">
              <input type="text" id="" name="model" value="<?php echo set_value('Car Model'); ?>" />
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Vin</label>
            <div class="controls">
              <input type="text" id="" name="vin" value="<?php echo set_value('Vin'); ?>" />
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Stock</label>
            <div class="controls">
              <input type="text" name="stock" value="<?php echo set_value('Stock'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Year</label>
            <div class="controls">
              <input type="text" name="year" value="<?php echo set_value('Stock'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Color</label>
            <div class="controls">
              <input type="text" name="color" value="<?php echo set_value('Color'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Location</label>
            <div class="controls">
              <input type="text" name="location" value="<?php echo set_value('Location'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Status</label>
            <div class="controls">
                <select name="status">
                    <option value="Active">Active</option>
                    <option value="No_Active">No Active</option>
                    <option value="Auction">Auction</option>
                </select>
                
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Geo Location</label>
            <div class="controls">
              <input type="text" name="geo_location" value="<?php echo set_value('Geo Location'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Miles</label>
            <div class="controls">
              <input type="text" name="miles" value="<?php echo set_value('Miles'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">GPS Number</label>
            <div class="controls">
              <input type="text" name="gps_number" value="<?php echo set_value('GPS Number'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">History of Scan</label>
            <div class="controls">
              <input type="text" name="h_o_scan" value="<?php echo set_value('History of Scan'); ?>" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Picture of the car</label>
            <div class="controls">
              <input type="file" name="pic_o_car" id="pic_o_car" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Picture of the GPS tag number</label>
            <div class="controls">
                <input type="file" name="pic_gps_tag" id="pic_gps_tag" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Picture of the inside of the vehicle </label>
            <div class="controls">
              <input type="file" name="pic_inside" id="pic_inside" />
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Tag Number</label>
            <div class="controls">
              <input type="text" name="tag_number" value="<?php echo set_value('Tag Number'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Days Late </label>
            <div class="controls">
              <input type="text" name="days_late" value="<?php echo set_value('Days'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <?php
//          echo '<div class="control-group">';
//            echo '<label for="manufacture_id" class="control-label">Manufacture</label>';
//            echo '<div class="controls">';
//              //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
//              
//              echo form_dropdown('manufacture_id', $options_manufacture, set_value('manufacture_id'), 'class="span2"');
//
//            echo '</div>';
//          echo '</div">';
          ?>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     