<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leafletpoint extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('WisataModel');
		$this->load->model('KecamatanModel');
	}

	public function index()
	{
		$datacontent['url']='admin/leafletpoint';
		$datacontent['title']='Halaman Leaflet Point';
		// $datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('admin/leafletpoint/mapView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/leafletpoint/js/mapJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
}
