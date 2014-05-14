	// JavaScript Document

	$(document).ready(function(){
		CKEDITOR.replace( 'textarea_pop' );		
	});
	var field_id = '';
        var field_id_url = '';
        var fld_ids_affiliate = '';
        var fld_id_list = '';
        var fld_id_url_list = '';
	function generate_html(fl_id){
		var url_value       = $('#url_'+fl_id).val();
		var exploded_url = url_value.split( '/' );
		
		$('.alert').remove();
		$('.alert').remove();
		
		if(url_value == ''){
			var gen_alert = '<div class="alert alert-danger"><strong>Oh snap!</strong> Please provide URL to generate affiliate code. </div>';
			$('#url_pointer').append(gen_alert);
			return false;	
		}
		
		if(exploded_url[4]== ''){
			var gen_alert = '<div class="alert alert-danger"><strong>Oh snap!</strong> Please check URL. Issue with URL </div>';
			$('#url_pointer').append(gen_alert);
			return false;			
		}
		
		if(exploded_url.length < 5){
			var gen_alert = '<div class="alert alert-danger"><strong>Oh snap!</strong> Please check URL. Issue with URL </div>';
			$('#url_pointer').append(gen_alert);
			return false;			
		}
		
		var explode_one = exploded_url[4];
		var product_id  = exploded_url[5].split( '?' );
		
		if(product_id.length > 0){
			product_id = product_id[0];
		}
		
		if(explode_one == '' || product_id== ''){
			var gen_alert = '<div class="alert alert-danger"><strong>Oh snap!</strong> Please check URL. Issue with URL </div>';
			$('#url_pointer').append(gen_alert);
			return false;	
		}
		
		var string_places = 'http://rover.ebay.com/rover/1/710-53481-19255-0/1?icep_ff3=2&pub=5575071570&toolid=10001&campid=5337433556&customid='+explode_one+"&icep_item="+product_id+"&ipn=psmain&icep_vectorid=229508&kwid=902099&mtid=824&kw=lg";
                
                field_id = $("#fld_ids").val();
                field_id_url = $("#fld_ids_url").val();
                fld_ids_affiliate = $("#fld_ids_affiliate").val();
                fld_id_list = parseInt(fl_id);
                fld_id_url_list = url_value;
                if(field_id==''){
                     $("#fld_ids").val(fld_id_list);
                     $("#fld_ids_url").val(fld_id_url_list);
                     $("#fld_ids_affiliate").val(string_places);
                }else{
                    var arr = $("#fld_ids").val().split(',');
                    var flag = true;
                    for(var i=0;i<arr.length;i++){
                        if(parseInt(arr[i])==parseInt(fld_id_list)){
                            flag = false;
                        }
                    }
                    if(flag){
                        $("#fld_ids").val(field_id+","+fld_id_list);
                        $("#fld_ids_url").val(field_id_url+","+fld_id_url_list);
                        $("#fld_ids_affiliate").val(fld_ids_affiliate+","+string_places);
                    }
                }
                
                $.ajax({
                    url: $('#base_url').val()+"admin/get_html",
                    type: "POST",
                    context: document.body,
                    data:{new_link_affiliate:string_places,url:url_value,fld_ids:$("#fld_ids").val(),fld_urls:$("#fld_ids_url").val(),fld_urls_affiliate:$("#fld_ids_affiliate").val()},
                    cache: false,
                    success: function(data) {
                        $('#html_gen').val(data);
                        CKEDITOR.instances['textarea_pop'].setData(data);
                    }

                });
	
		
		
		var gen_alert = '<div class="alert alert-success">HTML CODE GENERATED SUCCESSFULLY! PLEASE COPY BELOW </div>';
		$('#url_pointer').append(gen_alert);
	
	}
