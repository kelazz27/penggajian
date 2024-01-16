<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
	</style>
</head>
<body>
	<center>
		<h1>PT. PT. Solusi Prima Sentosa Asia</h1>
		<h2>Daftar Gaji Pegawai</h2>
	</center>

	<?php
	if((isset($_POST['bulan']) && $_POST['bulan']!='') && (isset($_POST['tahun']) && $_POST['tahun']!='')){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}
	?>
	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun?></td>
		</tr>
	</table>
	<table class="table table-bordered table-triped">
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">NIK</th>
				<th class="text-center">Nama Pegawai</th>
				<th class="text-center">Jenis Kelamin</th>
				<th class="text-center">Jabatan</th>
				<th class="text-center">GajI Pokok</th>
				<th class="text-center">Tj. Transport</th>
				<th class="text-center">Uang Makan</th>
				<th class="text-center">Potongan</th>
				<th class="text-center">Total Gaji</th>
			</tr>
			<?php
			$alpha = 0;
			foreach ($potongan as $p) {
			    $alpha = $p->jml_potongan;
			}
			
			$no = 1;
			foreach ($cetak_gaji as $g) {
			    $potongan = $g->alpha * $alpha;
			    ?>
			    <tr>
			        <td class="text-center"><?php echo $no++ ?></td>
			        <td class="text-center"><?php echo $g->nik ?></td>
			        <td class="text-center"><?php echo $g->nama_pegawai ?></td>
			        <td class="text-center"><?php echo $g->jenis_kelamin ?></td>
			        <td class="text-center"><?php echo $g->nama_jabatan ?></td>
			        <td class="text-center">Rp. <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
			        <td class="text-center">Rp. <?php echo number_format($g->tj_transport, 0, ',', '.') ?></td>
			        <td class="text-center">Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
			        <td class="text-center">Rp. <?php echo number_format($potongan, 0, ',', '.') ?></td>
			        <td class="text-center">Rp. <?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potongan, 0, ',', '.') ?></td>
			    </tr>
			    <?php
			}
			?>
		</table>

		<table width="100%">
			<tr>
				<td></td>
				<td width="200px">
					<p>Tangerang, <?php echo date("d M Y") ?> <br> Finance</p>
					<br>
					<br>
					<p>_____________________</p>
				</td>
			</tr>
		</table>
</body>
</html>

<script type="text/javascript">
	window.print();
</script>