`<style>
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
	.tabel-pelanggan th{
		font-size: 12px !important;
		text-align: center;
	}
	.tabel-pelanggan td{
		font-size: 14px;
	}
@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
	.container {
		padding-left: 2px;
		margin-left: 2px;
		margin-right: 2px;
		padding-right: 2px;
	}
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
		<div class="col-sm-6 col-md-4 col-lg-2 p-b-50 menu">
			<div class="leftbar p-r-0 p-r-0-sm">
				<!-- MENU -->
				<?php include('menu.php') ?>
			</div>
		</div>
	
		<!-- KONTEN SEBELAH KANAN -->
		<div class="col-sm-6 col-md-8 col-lg-10 p-b-50 konten">
			<h2><?php echo $title ?></h2>
			<hr>
			<p>Berikut adalah riwayat belanja Anda</p>

			<?php 
			// Kalau ada transaksi, tampilan tabel
			if($header_transaksi) { 
			?>

			<table class="table table-bordered tabel-pelanggan" width="100%">
				<thead>
					<tr class="bg-success">
						<th>NO</th>
						<th>KODE</th>
						<th width="14%">TANGGAL</th>
						<th>TOTAL</th>
						<th width="10%">ITEM</th>
						<th>STATUS BAYAR</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($header_transaksi as $header_transaksi) { ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $header_transaksi->kode_transaksi ?></td>
						<td><?php echo date('d-M-Y',strtotime($header_transaksi->tanggal_transaksi))?></td>
						<td><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
						<td><?php echo $header_transaksi->total_item ?></td>
						<td><?php echo $header_transaksi->status_bayar ?></td>
						<td>
							<div class="btn-group">
								<a href="<?php echo base_url('dasbor/detail/'.$header_transaksi->kode_transaksi) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail</a>
								<a href="<?php echo base_url('dasbor/konfirmasi/'.$header_transaksi->kode_transaksi) ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Konfirmasi Bayar</a>
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
					<i class="fa fa-warning"></i> Belum ada data transaksi
				</p>
			<?php
			} 
			?>
			
		</div>
	</div>
</div>
</section>