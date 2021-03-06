<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class Offers extends REST_Controller {

        function __construct() {
// Construct our parent class
                parent :: __construct();

                 if(!$this->isValidApiKey){
                $this->response($this->invalidResponse, 400);
                }
// Configure limits on our controller methods. Ensure
// you have created the 'limits' table and enabled 'limits'
// within application/config/rest.php
                $this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key
                $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
                $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
                $this->load->library('offers_lib');
        }

        function list_get() {
                $offset = $this->get('offset');
                $list = $this->offers_lib->showOffers($offset);
                if (!empty ($list['allOffers'])) {
                        $this->response($list['allOffers']['offers'], 200); // 200 being the HTTP response code
                }
                else {
                        $this->response(array('response' => array('error' => 'Offers could not be found')), 200);
                }
        }

        function offerdetails_get() {

                if (!$this->get('id')) {                                        
                $this->response(array('response' => array('error' => 'Offer ID is required')), 200);
                }

                $this->offers_lib->set_id($this->get('id'));
                $details = $this->offers_lib->offer_details();

                if (!empty ($details)) {
               
                $this->response($details, 200); // 200 being the HTTP response code
               
                }else {
                
                $this->response(array('response' => array('error' => 'Offer Details could not be found')), 200);
                
                }
                
        }

        function sendMessage_post(){
                $this->load->model('admin/emails_model');
                $this->emails_model->offerContactEmail();
          $this->response(array('response' => "Email Sent"), 200); // 200 being the HTTP response code     
        }
}