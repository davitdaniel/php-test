<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Analysis extends REST_Controller {

	public function __construct() {
		header('Access-Control-Allow-Origin: *');
   		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		$this->load->model('api/Analysis_model','am');
	}

	/**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
		$id = $this->input->get("id");
        $data = $this->am->getPrintInfo($id);
     
        $this->response($data, REST_Controller::HTTP_OK);
	}

	/**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->post();
        $insertId = $this->am->insert($input);
     
        $data = $this->am->getPrintInfo($insertId);
     
        $this->response($data, REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put()
    {
    	$id = $this->input->get("id");
        $input = $this->put();
    	$data = $this->am->update($input, $id);
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete()
    {
    	$id = $this->input->get("id");
        $this->am->delete($id);
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }

    public function index_options() {
        return $this->response(NULL, REST_Controller::HTTP_OK);
    }

    
}
