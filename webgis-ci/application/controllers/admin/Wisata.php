<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('WisataModel','Model');
		$this->load->model('KecamatanModel');
		$this->load->model('KategoriwisataModel');
	}

	public function index()
	{
		$datacontent['url']='admin/wisata';
		$datacontent['title']='Halaman Hotpost';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('admin/wisata/tableView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/wisata/js/tableJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
	public function form($parameter='',$id='')
	{
		$datacontent['url']='admin/wisata';
		$datacontent['parameter']=$parameter;
		$datacontent['id']=$id;
		$datacontent['title']='Form Hotpost';
		$data['content']=$this->load->view('admin/wisata/formView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/wisata/js/formJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
	public function simpan()
	{
		if($this->input->post()){
			$data=[
				'id_kecamatan'=>$this->input->post('id_kecamatan'),
				'id_kategori_wisata'=>$this->input->post('id_kategori_wisata'),
				'keterangan'=>$this->input->post('keterangan'),
				'lokasi'=>$this->input->post('lokasi'),
				'lat'=>$this->input->post('lat'),
				'lng'=>$this->input->post('lng'),
				'tanggal'=>$this->input->post('tanggal'),
				'polygon'=>$this->input->post('polygon'),
			];
			// upload
			if($_FILES['marker']['name']!=''){
				$upload=upload('marker','marker','image');
				if($upload['info']==true){
					$data['marker']=$upload['upload_data']['file_name'];
				}
				elseif($upload['info']==false){
					$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> '.$upload['message'].' </div>';
					$this->session->set_flashdata('info',$info);
					redirect('admin/wisata');
					exit();
				}
			}
			// upload
			
			if($_POST['parameter']=="tambah"){
				$this->Model->insert($data);
			}
			else{
				$this->Model->update($data,['id_wisata'=>$this->input->post('id_wisata')]);
			}

		}
		redirect('admin/wisata');
	}

	
	
	

	

	public function hapus($id=''){
		// hapus file di dalam folder
		$this->db->where('id_wisata',$id);
		$get=$this->Model->get()->row();
		$geojson_wisata=$get->geojson_wisata;
		unlink('assets/unggah/geojson/'.$geojson_wisata);
		// end hapus file di dalam folder
		$this->Model->delete(["id_wisata"=>$id]);
		redirect('admin/wisata');
	}


	public function datatable(){
		header('Content-Type: application/json');
		$url = 'admin/wisata';
		$kolom =['id_wisata','tanggal','lokasi','nm_kecamatan','keterangan','lat','lng','nm_kategori_wisata'];

		if ( $this->input->get('sSearch')){
			$this->db->group_start();
			for ( $i=0 ; $i<count($kolom) ; $i++ )
			{
		    	$this->db->or_like($kolom[$i],$this->input->get('sSearch',TRUE));
			}
			$this->db->group_end();
		}
		//order
		if ( $this->input->get('iSortCol_0') ){
			for ( $i=0 ; $i<intval( $this->input->get('iSortingCols',TRUE) ) ; $i++ )
			{
			    if ( $this->input->get( 'bSortable_'.intval($_GET['iSortCol_'.$i]),TRUE) == "true" )
			    {
			        $this->db->order_by($kolom[intval( $this->input->get('iSortCol_'.$i,TRUE))],$this->input->get('sSortDir_'.$i,TRUE) );
			    }
			}
		}

      	if($this->input->get('iDisplayLength',TRUE)!="-1"){
	        $this->db->limit($this->input->get('iDisplayLength',TRUE),$this->input->get('iDisplayStart'));
		}

		$dataTable = $this->Model->get();
		$iTotalDisplayRecords=$this->Model->get()->num_rows();
		$iTotalRecords=$dataTable->num_rows();
		$output = [
		  "sEcho" => intval($this->input->get('sEcho')),
		  "iTotalRecords" => $iTotalRecords,
		  "iTotalDisplayRecords" => $iTotalDisplayRecords,
		  "aaData" => array()
		];
		$no=1;
		foreach ($dataTable->result() as $row) {
			$r = null;
			$r[] = $no++;
			$r[] = $row->tanggal;
			$r[] = $row->lokasi;
			$r[] = $row->nm_kecamatan;
			$r[] = $row->keterangan;
			$r[] = $row->lat;
			$r[] = $row->lng;
			$r[] = $row->nm_kategori_wisata;
			$r[] = '<div class="btn-group">
								<a href="'.site_url($url.'/form/ubah/'.$row->id_wisata).'" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
								<a href="'.site_url($url.'/hapus/'.$row->id_wisata).'" class="btn btn-danger" onclick="return confirm(\'Hapus data?\')"><i class="fa fa-trash"></i> Hapus</a>
							</div>';
			$output['aaData'][] = $r;				
		}
		echo json_encode($output,JSON_PRETTY_PRINT);

	}
/**
	<tbody>
		<?php
			$no=1;
			foreach ($datatable->result() as $row) {
				?>
					<tr>
						<td class="text-center"><?=$no?></td>
						<td><?=$row->lokasi?></td>
						<td><?=$row->nm_kecamatan?></td>
						<td><?=$row->keterangan?></td>
						<td><?=$row->lat?></td>
						<td><?=$row->lng?></td>
						<td><?=$row->tanggal?></td>
						<td><?=$row->nm_kategori_wisata?></td>
						<td class="text-center">
							<div class="btn-group">
								<a href="<?=site_url($url.'/form/ubah/'.$row->id_wisata)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
								<a href="<?=site_url($url.'/hapus/'.$row->id_wisata)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
							</div>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
	**/
}
