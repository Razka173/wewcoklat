<style>
	.container {
		max-width: 1240px;
	}
	.konten{
		overflow-x: auto;
	}
	table { 
	  width: 100%; 
	  border-collapse: collapse; 
	  font-size: 14px;
	}
	tr:nth-of-type(odd) { 
	  background: #eee; 
	}
	th { 
	  background: #333; 
	  color: white; 
	  font-weight: bold; 
	}
	td, th { 
	  padding: 6px; 
	  border: 1px solid #ccc; 
	  text-align: left; 
	}
	.tabel-dasbor th{
		font-size: 12px !important;
		text-align: center;
	}
	.tabel-dasbor td{
		font-size: 14px;
		text-align: center;
	}
@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
	.container {
		padding-left: 2px;
		margin-left: 2px;
	}
	.menu {
		/*background-color: lightblue;*/
		margin: -50px 0px -25px 50px;
		padding: 0px;
	}
	.tabel-dasbor th {
		font-size: 12px !important;
		text-align: left;
	}
	.tabel-dasbor td {
		font-size: 14px;
		text-align: left;
	}
	.td-action {
		display: block;
		margin-top: 5px;
		font-size: 13px;
	}
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	thead tr { 
		/* semi display none */
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	tr { 
		border: 1px solid #ccc; 
	}
	td { 
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
		margin-left: 40%;
		font-size: 12px;
	}
	td:before { 
		position: absolute;
		left: 5px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		margin-left: -66%;
		font-size: 12px;
	}
	td:nth-of-type(1):before { content: "NO"; }
	td:nth-of-type(2):before { content: "KODE"; }
	td:nth-of-type(3):before { content: "TANGGAL"; }
	td:nth-of-type(4):before { content: "TOTAL TAGIHAN"; }
	td:nth-of-type(5):before { content: "ITEM"; }
	td:nth-of-type(6):before { content: "STATUS BAYAR"; }
	td:nth-of-type(7):before { content: "STATUS PESANAN"; }
	td:nth-of-type(8):before { content: "ACTION"; }
}
</style>

<!-- ISI -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container m-l-30">
	<div class="row">

		<!-- KONTEN SEBELAH KIRI -->
		<div class="col-sm-6 col-md-4 col-lg-2 p-b-50 menu">
			<div class="leftbar p-r-0 p-r-0-sm">
				<!-- MENU -->
				<?php include('menu.php') ?>
			</div>
		</div>

		<!-- KONTEN SEBELAH KANAN -->
		<div class="col-sm-12 col-md-12 col-lg-10 p-b-50 konten">
				<div class="alert alert-success">
					<h1>Selamat datang <strong><?php echo $this->session->userdata('nama_pelanggan'); ?></strong></h1>
				</div>

				<?php 
				// NOTIFIKASI
	            if($this->session->flashdata('sukses')) {
	            echo '<div class="alert alert-warning">';
	            echo $this->session->flashdata('sukses');
	            echo '</div>';
	            }

	            // VERIFIKASI EMAIL
				if ($pelanggan->status_pelanggan=='Pending') { ?>
				<div class="alert alert-warning">
					<?php echo ("Email anda belum terverifikasi. Harap verifikasi email anda!") ?>
					<a href="<?php echo base_url('registrasi/kirim') ?>" class="btn btn-warning">Kirim Ulang Verifikasi</a>
				</div>
				<?php } ?>

				<!-- STATUS PELANGGAN -->
				<?php if ($pelanggan->status_pelanggan!='Pending') { ?>
				<div class="alert alert-success">
					Status pelanggan: <?php echo $pelanggan->status_pelanggan ?>
				</div>
				<?php } ?>

				<?php 
				// Kalau ada transaksi, tampilan tabel
				if($header_transaksi) { 
				?>

				<table class="table table-bordered tabel-dasbor" width="100%">
					<thead>
						<tr class="bg-success">
							<th>NO</th>
							<th>KODE</th>
							<th>TANGGAL</th>
							<th>TOTAL TAGIHAN</th>
							<th>ITEM</th>
							<th>STATUS BAYAR</th>
							<th>STATUS PESANAN</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($header_transaksi as $header_transaksi) { ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $header_transaksi->kode_transaksi ?></td>
							<td><?php echo date('d-m-Y',strtotime($header_transaksi->tanggal_transaksi))?></td>
							<td><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
							<td><?php echo $header_transaksi->total_item ?></td>
							<td><?php echo $header_transaksi->status_bayar ?></td>
							<td><?php echo $header_transaksi->status_pesanan ?></td>
							<td>
								<div class="btn-group td-action">
									<a href="<?php echo base_url('dasbor/detail/'.$header_transaksi->kode_transaksi) ?>" class="btn btn-success btn-sm td-action"><i class="fa fa-eye"></i> Detail</a>
									<a href="<?php echo base_url('dasbor/bayar/'.$header_transaksi->kode_transaksi) ?>" class="btn btn-danger btn-sm td-action"><i class="fa fa-money"></i> <strong>Bayar</strong></a>
									<a href="<?php echo base_url('dasbor/konfirmasi/'.$header_transaksi->kode_transaksi) ?>" class="btn btn-info btn-sm td-action"><i class="fa fa-upload"></i> Konfirmasi Bayar</a>

								</div>
							</td>
						</tr>
						<?php $i++; } ?>
					</tbody>
				</table>

				<a href="<?php echo base_url('dasbor/info') ?>">
					<button class="btn btn-info">
						Informasi Pembayaran
					</button>
				</a>

				<?php 
				// Kalau ga ada tampilkan notifikasi
				}else{ ?>

					<p class="alert alert-success">
						<i class="fa fa-warning"></i> Belum ada data transaksi
					</p>

				<?php } ?>
		</div>
	</div>
</div>
</section>