<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leafletpolygon extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('WisataModel');
		$this->load->model('KecamatanModel');
	}

	public function index()
	{
		$datacontent['url']='admin/leafletpolygon';
		$datacontent['title']='Halaman Leaflet Polygon';
		// $datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('admin/leafletpolygon/mapView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/leafletpolygon/js/mapJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
}
