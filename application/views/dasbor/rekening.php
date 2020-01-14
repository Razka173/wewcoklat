<style>
	.dasbor-rekening th{
		font-size: 12px !important;
		text-align: center;
	}
	.dasbor-rekening td{
		font-size: 14px;
		text-align: center;
	}
	.wew-table{
		overflow-x: auto;
	}
</style>
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
			<div class="leftbar p-r-0 p-r-0-sm">
				<!-- MENU PELANGGAN -->
				<?php include('menu.php') ?>
			</div>
		</div>

		<div class="col-sm-6 col-md-9 col-lg-9 p-b-50 wew-table">

				<h2><?php echo $title ?></h2>
				<hr>
			<p>Berikut adalah daftar rekening bank Anda</p>

			<?php 
			// Kalau ada data, tampilan tabel
			if($rekening_pelanggan) { 
			?>

			<table class="table table-bordered dasbor-rekening" width="100%">
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
			}else{ ?>
				<p class="alert alert-success">
					<i class="fa fa-warning"></i> Belum ada data rekening bank
				</p>
			<?php } ?>
		</div>

	</div>
</div>
</section>
