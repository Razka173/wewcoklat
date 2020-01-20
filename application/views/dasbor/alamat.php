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
			<p>Berikut adalah daftar alamat Anda</p>

			<?php
			// Notifikasi
	        if($this->session->flashdata('sukses')) {
	        echo '<div class="alert alert-warning">';
	        echo $this->session->flashdata('sukses');
	        echo '</div>';
	        }

			// Kalau ada data, tampilan tabel
			if($alamat_pelanggan) { 
			?>

			<table class="table table-bordered tabel-data" width="100%">
				<thead>
					<tr class="bg-success">
						<th>NO</th>
						<th>ALAMAT DETAIL</th>
						<th>ALAMAT LABEL</th>
						<th>TELEPON</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($alamat_pelanggan as $alamat_pelanggan) { ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $alamat_pelanggan->alamat_detail ?></td>
						<td><?php echo $alamat_pelanggan->alamat_label?></td>
						<td><?php echo $alamat_pelanggan->telepon?></td>
						<td>
							<div class="btn-group">
								<a href="<?php echo base_url('dasbor/alamat/edit') ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Edit</a>
								<a href="<?php echo base_url('alamat/delete/'.$alamat_pelanggan->id_alamat) ?>" class="btn btn-danger btn-sm"><i class="fa fa-upload"></i> Hapus</a>
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
					<i class="fa fa-warning"></i> Belum ada data alamat
				</p>
			<?php 
			} 
			?>
			<a href="<?php echo base_url('alamat/tambah') ?>">
				<button class="btn btn-success">
					Tambah Data Alamat
				</button>
			</a>

			<a href="<?php echo base_url('dasbor') ?>">
				<button class="btn btn-secondary">
					Kembali ke Dashboard
				</button>
			</a>

			<a href="<?php echo base_url('belanja/checkout') ?>">
				<button class="btn btn-primary">
					Ke halaman Checkout
				</button>
			</a>

		</div>

	</div>
</div>
</section>
