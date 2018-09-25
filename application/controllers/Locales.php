<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locales extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Locales_model');
	}
    public function index()
    {
       $data['locales'] = $this->Locales_model->obtenerLocales();
		$this->plantilla->publica('publica/vistaLocales', $data);        
    }

}
?>