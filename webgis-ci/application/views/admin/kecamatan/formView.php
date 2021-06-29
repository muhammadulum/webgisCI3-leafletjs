<?php
$id_kecamatan="";
$kd_kecamatan="";
$nm_kecamatan="";
$geojson_kecamatan="";
$warna_kecamatan="";
if($parameter=='ubah' && $id!=''){
    $this->db->where('id_kecamatan',$id);
    $row=$this->Model->get()->row_array();
    extract($row);
}

// value ketika validasi
if($this->session->flashdata('error_value')){
    extract($this->session->flashdata('error_value'));
}

?>
<?=content_open('Form Kecamatan')?>
    <?php
        // menampilkan error validasi
        if($this->session->flashdata('error_validation')){
            foreach ($this->session->flashdata('error_validation') as $key => $value) {
                echo '<div class="alert alert-danger">'.$value.'</div>';
            }
        }
    ?>
    <form method="post" action="<?=site_url($url.'/simpan')?>" enctype="multipart/form-data">
        <?=input_hidden('parameter',$parameter)?>
    	<?=input_hidden('id_kecamatan',$id_kecamatan)?>
    	<div class="form-group">
    		<label>Kode Kecamatan</label>
    		<div class="row">
	    		<div class="col-md-4">
	    			<?=input_text('kd_kecamatan',$kd_kecamatan)?>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>Nama Kecamatan</label>
    		<div class="row">
	    		<div class="col-md-6">
	    			<?=input_text('nm_kecamatan',$nm_kecamatan)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>GeoJSON</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('geojson_kecamatan',$geojson_kecamatan)?>
                    <?php if ($parameter=='ubah'): ?>
                        <small class="text-success">Biarkan kosong jika tidak ingin diubah</small>
                    <?php endif ?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Warna</label> 
    		<div class="row">
	    		<div class="col-md-3">
	    			<?=input_color('warna_kecamatan',$warna_kecamatan)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="simpan" value="true" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=site_url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
    	</div>
    </form>
<?=content_close()?>