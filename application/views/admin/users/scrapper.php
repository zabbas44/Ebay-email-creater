
<link rel="stylesheet" href="<?php echo base_url(); ?>files/css/style.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>files/css/bootstrap.css" />
<script src="<?php echo base_url(); ?>files/js/email.js"></script>
<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1)); ?>
            </a> 
  <!--          <span class="divider">/</span>-->
        </li>
        <li class="active">
            <?php echo ucfirst("Affiliate Code"); ?>
        </li>
    </ul>

    <div class="page-header users-header">
        <h2>
            <?php echo ucfirst("Affiliate Code"); ?>
            <span style="float: right;" onclick="addRow(this.form);" class="btn btn-success">Add Row Link</span>
        </h2>
    </div>
    <div class="page-content">
        <div class="center-page-content">
            <div class="panel panel-default">
                <div class="panel-heading center-align"><strong>Link Affiliate Code Generator</strong></div>
                <div class="panel-body">
                    <table width="100%" border="0">
                        <tr>
                            <td>
                                <span id="itemRow">
                                    <div class="input-group"> <span class="input-group-addon">@</span>
                                        <input class="form-control" type="text" id="url_1" name="url" placeholder="URL">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" onClick="generate_html('1')">Generate Html</button>
                                        </span> 
                                    </div>
                                </span>
                                <br/>
                                <span id="url_pointer"></span>
                            </td>
                        </tr>
                        <tr>
                            <style>
                                #cke_1_contents{
                                    height: 800px !important;
                                        
                                }
                            </style>
                            <td><textarea name="textarea_pop" id="textarea_pop" ></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>"/>
    <input type="hidden" name="html_gen" id="html_gen" value=""/>
    <input type="hidden" name="fld_ids" id="fld_ids" value=""/>
    <input type="hidden" name="fld_ids_url" id="fld_ids_url" value=""/>
    <input type="hidden" name="fld_ids_affiliate" id="fld_ids_affiliate" value=""/>
<script>
    var rowNum = 1;
    function addRow(frm) {
        rowNum++;
        var row = '<br /><div class="input-group" id="rowNum' + rowNum + '"> <span class="input-group-addon">@</span><input class="form-control" type="text" id="url_'+rowNum+'" name="name_url[]" placeholder="URL"><span class="input-group-btn"><button class="btn btn-default" type="button" onClick="generate_html('+rowNum+')">Generate Html</button>&nbsp;&nbsp;<button class="btn btn-primary" type="button" onClick="removeRow(' + rowNum + ');">Remove</button></span> </div>';
        //var row = '<p id="rowNum' + rowNum + '">Item quantity: <input type="text" name="new_url[]" size="4" value=""> Item name: <input type="text" name="name_url[]" value="' + frm.add_name.value + '"> </p>';
        jQuery('#itemRow').append(row);
    }
    function removeRow(rnum) {
        jQuery('#rowNum'+rnum).remove();
        var field_id = $("#fld_ids").val();
        var field_id_url = $("#fld_ids_url").val();
        var fld_ids_affiliate = $("#fld_ids_affiliate").val();
        var arr = $("#fld_ids").val().split(',');
        var arr_url = $("#fld_ids_url").val().split(',');
        var arr_affiliate = $("#fld_ids_affiliate").val().split(',');
        var flag = true;
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i])==parseInt(rnum)){
                arr.splice( $.inArray(arr[i],arr) ,1 );
                arr_url.splice( $.inArray(arr_url[i],arr_url) ,1 );
                arr_affiliate.splice( $.inArray(arr_affiliate[i],arr_affiliate) ,1 );
                
//                console.log(arr.join(','));
//                console.log(arr_url.join(','));
//                console.log(arr_affiliate.join(','));
                $("#fld_ids").val(arr.join(','));
                $("#fld_ids_url").val(arr_url.join(','));
                $("#fld_ids_affiliate").val(arr_affiliate.join(','));
                flag = false;
            }
        }
         
        
    }
</script>