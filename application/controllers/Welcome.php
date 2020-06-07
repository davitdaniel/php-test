<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Welcome extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api/Print_model','pm');
	}

	/**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
		$id = $this->input->get("id");
        $data = $this->pm->getPrintInfo($id);
     
        $this->response($data, REST_Controller::HTTP_OK);
	}

	/**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $data = $this->pm->insert($input);
     
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
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
    	$data = $this->pm->update($input, $id);
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
        $this->pm->delete($id);
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
}
