<?=content_open($title)?>
<a href="<?=site_url($url.'/form/tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>

<hr>
<?=$this->session->flashdata('info')?>

<table class="table table-bordered dt">
	<thead>
		<tr>
			<th width="50px" class="text-center">No</th>
			<th>Tanggal</th>
			<th>Lokasi</th>
			<th>Nama Kecamatan</th>
			<th>Keterangan</th>
			<th>Lat</th>
			<th>Lng</th>
			<th>Kategori</th>
			<th width="200px">Aksi</th>
		</tr>
	</thead>
	
</table>
<?=content_close()?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Upload CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" action="<?=site_url($url.'/importcsv')?>" enctype="multipart/form-data">
      <div class="modal-body">
	    	<div class="form-group">
	    		<label>File CSV</label>
	    		<div class="row">
		    		<div class="col-md-12">
	    				<?=input_file('csv','')?>
	    			</div>
	    		</div>
	    	</div>
      </div>
      <div class="modal-footer">
		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalZip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Upload ZIP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" action="<?=site_url($url.'/importzip')?>" enctype="multipart/form-data">
      <div class="modal-body">
	    	<div class="form-group">
	    		<label>File ZIP</label>
	    		<div class="row">
		    		<div class="col-md-12">
	    				<?=input_file('zip','')?>
	    			</div>
	    		</div>
	    	</div>
      </div>
      <div class="modal-footer">
		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>