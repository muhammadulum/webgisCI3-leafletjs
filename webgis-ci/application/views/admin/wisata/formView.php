<?php
$id_wisata="";
$id_kecamatan="";
$lokasi="";
$keterangan="";
$lat="";
$lng="";
$polygon="";
$id_kategori_wisata="";
$tanggal=date('Y-m-d');
if($parameter=='ubah' && $id!=''){
    $this->db->where('id_wisata',$id);
    $row=$this->Model->get()->row_array();
    extract($row);
}
?>
<?=content_open('Form wisata')?>
    <form method="post" action="<?=site_url($url.'/simpan')?>" enctype="multipart/form-data">
    	<?=input_hidden('id_wisata',$id_wisata)?>
        <?=input_hidden('parameter',$parameter)?>
    <div class="row">
        <div class="col-md-6">
    	<div class="form-group">
    		<label>Lokasi</label>
    		<div class="row">
	    		<div class="col-md-8">
	    			<?=input_text('lokasi',$lokasi)?>
		    	</div>
	    	</div>
    	</div>
    	<div class="form-group">
    		<label>Nama Kecamatan</label>
    		<div class="row">
	    		<div class="col-md-10">
	    			<?php
	    				$op['']='Pilih Kecamatan';
                        $get=$this->KecamatanModel->get();
	    				foreach ($get->result() as $row) {
	    					$op[$row->id_kecamatan]=$row->nm_kecamatan;
	    				}
	    			?>
	    			<?=select('id_kecamatan',$op,$id_kecamatan)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Keterangan</label>
    		<div class="row">
	    		<div class="col-md-12">
    				<?=textarea('keterangan',$keterangan)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Titik Koordinat</label> 
    		<div class="row">
	    		<div class="col-md-6">
	    			<?=input_text('lat',$lat)?>
	    		</div>
	    		<div class="col-md-6">
	    			<?=input_text('lng',$lng)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Tanggal</label>
    		<div class="row">
	    		<div class="col-md-8">
    				<?=input_date('tanggal',$tanggal)?>
    			</div>
    		</div>
    	</div>
    	
        
        <div class="form-group">
            <label>Kategori</label>
            <div class="row">
                <div class="col-md-10">
                    <?php
                        $op=null;
                        $op['']='Pilih Kategori';
                        $get=$this->KategoriwisataModel->get();
                        foreach ($get->result() as $row) {
                            $op[$row->id_kategori_wisata]=$row->nm_kategori_wisata;
                        }
                    ?>
                    <?=select('id_kategori_wisata',$op,$id_kategori_wisata)?>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <h3>Pilih Titik</h3>
        <div id="map" style="height: 400px"></div>
        <?=textarea('polygon',$polygon,'','style="display:none"')?>
    </div>
    <div class="col-md-12">
        <hr>
    	<div class="form-group">
    		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=site_url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
    	</div>
    </div>
    </div>

    </form>
<?=content_close()?>