 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisatauser extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('WisataModel');
		$this->load->model('KecamatanModel');
	}

	public function index()
	{
		$datacontent['url']='website/userleaflet';
		$datacontent['title']='Halaman Leaflet Point';
		// $datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('website/userleaflet/mapView',$datacontent,TRUE);
		$data['js']=$this->load->view('website/userleaflet/js/mapJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('website/layouts/wisatauser',$data);
	}
}