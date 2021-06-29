<?=content_open($title)?>
<a href="<?=site_url($url.'/form/tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
<hr>
<?=$this->session->flashdata('info')?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center" width="50px">No</th>
			<th>Kode</th>
			<th>Nama Kecamatan</th>
			<th>GeoJSON</th>
			<th>Warna</th>
			<th width="200px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			foreach ($datatable->result() as $row) {
				?>
					<tr>
						<td class="text-center"><?=$no?></td>
						<td><?=$row->kd_kecamatan?></td>
						<td><?=$row->nm_kecamatan?></td>
						<td><a href="<?=assets('unggah/geojson/'.$row->geojson_kecamatan)?>" target="_BLANK"><?=$row->geojson_kecamatan?></a></td>
						<td style="background: <?=$row->warna_kecamatan?>"></td>
						<td class="text-center">
							<div class="btn-group">
								<a href="<?=site_url($url.'/form/ubah/'.$row->id_kecamatan)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
								<a href="<?=site_url($url.'/hapus/'.$row->id_kecamatan)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
							</div>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
<?=content_close()?>