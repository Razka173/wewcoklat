<style>
	.container {
		max-width: 1300px;
	}
	.konten{
		overflow-x: auto;
	}
	.tabel-rekening th{
		font-size: 12px !important;
		text-align: center;
	}
	.tabel-rekening td{
		font-size: 14px;
		text-align: center;
	}
@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
/*	.container {
		padding-left: 2px;
		margin-left: 2px;
		margin-right: 2px;
		padding-right: 2px;
	}*/
	.menu {
		/*background-color: lightblue;*/
		margin: -50px 0px -25px 50px;
		padding: 0px;
	}
}
</style>

<!-- ISI -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container m-l-30">
	<div class="row">

		<!-- KONTEN SEBELAH KIRI -->
		<div class="col-sm-6 col-md-3 col-lg-2 p-b-50 menu">
			<div class="leftbar p-r-0 p-r-0-sm">
				<!-- MENU PELANGGAN -->
				<?php include('menu.php') ?>
			</div>
		</div>
		
		<!-- KONTEN SEBELAH KANAN -->
		<div class="col-sm-6 col-md-9 col-lg-10 p-b-50 konten">

			<h2><?php echo $title ?></h2>
			<hr>
			<p>Berikut adalah daftar rekening bank Anda</p>

			<?php
			// Notifikasi
	        if($this->session->flashdata('sukses')) {
	        echo '<div class="alert alert-warning">';
	        echo $this->session->flashdata('sukses');
	        echo '</div>';
	        }

			// Kalau ada data, tampilan tabel
			if($rekening_pelanggan) { 
			?>

			<table class="table table-bordered tabel-rekening" width="100%">
				<thead>
					<tr class="bg-success">
						<th>NO</th>
						<th>NAMA BANK</th>
						<th>NOMOR REKENING</th>
						<th>NAMA PEMILIK</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($rekening_pelanggan as $rekening_pelanggan) { ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $rekening_pelanggan->nama_bank ?></td>
						<td><?php echo $rekening_pelanggan->nomor_rekening?></td>
						<td><?php echo $rekening_pelanggan->nama_pemilik?></td>
						<td>
							<div class="btn-group">
								<a href="<?php echo base_url('dasbor/rekening/edit') ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Edit</a>
								<a href="<?php echo base_url('rekening/delete/'.$rekening_pelanggan->id_rekening) ?>" class="btn btn-danger btn-sm"><i class="fa fa-upload"></i> Hapus</a>
							</div>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>

			<?php 
			// Kalau ga ada tampilkan notifikasi
			}else { 
			?>
				<p class="alert alert-success">
					<i class="fa fa-warning"></i> Belum ada data rekening bank
				</p>
			<?php 
			} 
			?>
			<a href="<?php echo base_url('rekening/tambah') ?>">
				<button class="btn btn-success">
					Tambah Data Rekening Bank
				</button>
			</a>

			<a href="<?php echo base_url('dasbor') ?>">
				<button class="btn btn-secondary">
					Kembali ke Dashboard
				</button>
			</a>

		</div>

	</div>
</div>
</section>
