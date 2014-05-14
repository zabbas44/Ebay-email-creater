<?php
class Admin_products extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $manufacture_id = "all";        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/products';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($manufacture_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($manufacture_id !== 0){
                $filter_session_data['manufacture_selected'] = $manufacture_id;
            }else{
                $manufacture_id = $this->session->userdata('manufacture_selected');
            }
            $data['manufacture_selected'] = $manufacture_id;

            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch manufacturers data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['count_products']= $this->products_model->count_products($manufacture_id, $search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
//            echo $search_string;
            if($search_string){
                if($order){
                    $data['products'] = $this->products_model->get_products($manufacture_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($manufacture_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['products'] = $this->products_model->get_products($manufacture_id, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($manufacture_id, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['manufacture_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_products']= $this->products_model->count_products();
            $data['products'] = $this->products_model->get_products('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/products/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('rfid', 'RFID', 'required');
            $this->form_validation->set_rules('make', 'Car make', 'required');
            $this->form_validation->set_rules('model', 'Car Model', 'required');
            $this->form_validation->set_rules('vin', 'Car VIN', 'required|');
            $this->form_validation->set_rules('stock', 'Stock', 'required|');
            $this->form_validation->set_rules('year', 'year', 'required');
            $this->form_validation->set_rules('color', 'Car Color', 'required');
            $this->form_validation->set_rules('location', 'location', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('geo_location', 'geo_location', 'required');
            $this->form_validation->set_rules('miles', 'miles', 'required');
            $this->form_validation->set_rules('gps_number', 'gps_number', 'required');
            $this->form_validation->set_rules('h_o_scan', 'h_o_scan', 'required');
//            $this->form_validation->set_rules('pic_o_car', 'Pic Of Car', 'required');
//            $this->form_validation->set_rules('pic_gps_tag', 'pic_gps_tag', 'required');
//            $this->form_validation->set_rules('pic_inside', 'Pic Of Car Inside', 'required');
            $this->form_validation->set_rules('tag_number', 'tag_number', 'required');
            $this->form_validation->set_rules('days_late', 'days_late', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $pic_o_car = $this->do_upload('pic_o_car');
                $pic_gps_tag = $this->do_upload('pic_gps_tag');
                $pic_inside = $this->do_upload('pic_inside');
                
                $data_to_store = array(
                    'rfid' => $this->input->post('rfid'),
                    'make' => $this->input->post('make'),
                    'model' => $this->input->post('model'),
                    'vin' => $this->input->post('vin'),
                    'stock' => $this->input->post('stock'),          
                    'year' => $this->input->post('year'),
                    'color' => $this->input->post('color'),
                    'location' => $this->input->post('location'),
                    'status' => $this->input->post('status'),
                    'geo_location' => $this->input->post('geo_location'),
                    'miles' => $this->input->post('miles'),
                    'gps_number' => $this->input->post('gps_number'),
                    'history_of_scan' => $this->input->post('h_o_scan'),
                    'pic_of_car' => $pic_o_car,
                    'pic_gps_tag' => $pic_gps_tag,
                    'pic_inside' => $pic_inside,
                    'tag_number' => $this->input->post('tag_number'),
                    'days' => $this->input->post('days_late'),
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->store_product($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/add';
        $this->load->view('includes/template', $data);  
    }       
    
    /**
     * Function for file uploading
     */
    
    function do_upload($field_name)
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		
		$this->load->library('upload', $config);
                $file_path = '';
		if ( ! $this->upload->do_upload($field_name))
		{
                    
			$error = array('error' => $this->upload->display_errors());
                    
                        $file_path = '';
    		}
		else
		{
                        $data = $this->upload->data();
                        $file_path = $config['upload_path'] . '' . $data['file_name'];

		}
                return $file_path;
	}

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('rfid', 'RFID #', 'required');
            $this->form_validation->set_rules('make', 'Car make', 'required');
            $this->form_validation->set_rules('model', 'Car Model', 'required');
            $this->form_validation->set_rules('vin', 'Car VIN', 'required|');
            $this->form_validation->set_rules('stock', 'Stock', 'required|');
            $this->form_validation->set_rules('year', 'year', 'required');
            $this->form_validation->set_rules('color', 'Car Color', 'required');
            $this->form_validation->set_rules('location', 'location', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('geo_location', 'geo_location', 'required');
            $this->form_validation->set_rules('miles', 'miles', 'required');
            $this->form_validation->set_rules('gps_number', 'gps_number', 'required');
            $this->form_validation->set_rules('h_o_scan', 'h_o_scan', 'required');
//            $this->form_validation->set_rules('pic_o_car', 'Pic Of Car', 'required');
//            $this->form_validation->set_rules('pic_gps_tag', 'pic_gps_tag', 'required');
//            $this->form_validation->set_rules('pic_inside', 'Pic Of Car Inside', 'required');
            $this->form_validation->set_rules('tag_number', 'tag_number', 'required');
            $this->form_validation->set_rules('days_late', 'days_late', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                
                $pic_o_car = $this->do_upload('pic_o_car');
                $pic_gps_tag = $this->do_upload('pic_gps_tag');
                $pic_inside = $this->do_upload('pic_inside');
                if(empty($pic_o_car))
                    $pic_o_car = $this->input->post('pic_o_car_hidden');
                if(empty($pic_gps_tag))
                    $pic_gps_tag = $this->input->post('pic_gps_tag_hidden');
                if(empty($pic_inside))
                    $pic_inside = $this->input->post('pic_inside_hidden');
                
                 $data_to_store = array(
                    'rfid' => $this->input->post('rfid'),
                    'make' => $this->input->post('make'),
                    'model' => $this->input->post('model'),
                    'vin' => $this->input->post('vin'),
                    'stock' => $this->input->post('stock'),          
                    'year' => $this->input->post('year'),
                    'color' => $this->input->post('color'),
                    'location' => $this->input->post('location'),
                    'status' => $this->input->post('status'),
                    'geo_location' => $this->input->post('geo_location'),
                    'miles' => $this->input->post('miles'),
                    'gps_number' => $this->input->post('gps_number'),
                    'history_of_scan' => $this->input->post('h_o_scan'),
                    'pic_of_car' => $pic_o_car,
                    'pic_gps_tag' => $pic_gps_tag,
                    'pic_inside' => $pic_inside,
                    'tag_number' => $this->input->post('tag_number'),
                    'days' => $this->input->post('days_late'),
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->update_product($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/products/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
//        print_r($data);exit;
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->products_model->delete_product($id);
        redirect('admin/products');
    }//edit

}