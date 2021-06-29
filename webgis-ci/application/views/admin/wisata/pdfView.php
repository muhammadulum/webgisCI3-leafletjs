<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<style type="text/css">
		.table{
			width: 100%;
			border-spacing: 0
		}
		.table tr:first-child th,
		.table tr:first-child td{
			border-top: 1px solid #000
		}
		.table tr th:first-child,
		.table tr td:first-child{
			border-left: 1px solid #000
		}
		.table tr th,
		.table tr td{
			border-right: 1px solid #000;
			border-bottom: 1px solid #000;
			padding:4px;
			vertical-align: top
		}
		.text-center{
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>Wisata Report</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="50px" class="text-center">No</th>
				<th>Lokasi</th>
				<th>Nama Kecamatan</th>
				<th>Keterangan</th>
				<th>Lat</th>
				<th>Lng</th>
				<th>Tanggal</th>
				<th>Kategori</th>
			</tr>
		</thead>
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
							<td><?=$row->nm_kategori_Wisata?></td>
						</tr>
					<?php
					$no++;
				}

			?>
		</tbody>
	</table>

</body>
</html>