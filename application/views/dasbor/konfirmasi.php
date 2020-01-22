<style>
	.container {
		max-width: 1240px;
	}
	.konten{
		overflow-x: auto;
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
</style>

<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
	<div class="row">

		<!-- KONTEN SEBELAH KIRI -->
		<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
			<div class="leftbar p-r-20 p-r-0-sm menu">
				<!--  -->
				<?php include('menu.php') ?>
			</div>
		</div>

		<div class="col-sm-6 col-md-9 col-lg-9 p-b-50 konten">

			<h2><?php echo $title ?></h2>
			<hr>
			<p>Berikut adalah detail belanja Anda</p>

			<?php 
			// Kalau ada transaksi, tampilan tabel
			if($header_transaksi) { 
			?>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="25%">KODE TRANSAKSI</th>
						<th>: <?php echo $header_transaksi->kode_transaksi ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tanggal</td>
						<td>: <?php echo date('d-m-Y',strtotime($header_transaksi->tanggal_transaksi))?></td>
					</tr>
					<tr>
						<td>Jumlah Total</td>
						<td>: <?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
					</tr>
					<tr>
						<td>Status Bayar</td>
						<td>: <?php echo $header_transaksi->status_bayar ?></td>
					</tr>
					<tr>
						<td>Bukti Bayar</td>
						<td>: <?php if($header_transaksi->bukti_bayar != "") { ?>
							<img src="<?php echo base_url('assets/upload/image/'.$header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
							<?php }else { echo 'Belum ada bukti bayar';} ?>
						</td>
					</tr>
				</tbody>
			</table>

			<?php  
			// Error upload
			if(isset($error)) {
				echo '<p class="alert alert-warning">'.$error.'</p>';
			}

			// Notif error
			echo validation_errors('<p class="alert alert-warning">','</p>');

			// Form open
			echo form_open_multipart(base_url('dasbor/konfirmasi/'.$header_transaksi->kode_transaksi));

			?>
			<div class="form-group">
				<label for="id_rekening" class="control-label">Pembayaran ke rekening</label>
				<!-- SELECT REKENING -->
				<select name="id_rekening" class="form-control" id="id_rekening">
					<?php 
					foreach($rekening as $rekening) { 
					?>
					<option class="form-control border border-dark" value="<?php echo $rekening->id_rekening ?>" <?php if($header_transaksi->id_rekening==$rekening->id_rekening) { echo "selected"; } ?>>
						<?php echo $rekening->nama_bank ?> (NO. Rekening: <?php echo $rekening->nomor_rekening ?> a.n <?php echo $rekening->nama_pemilik ?>)
					</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Tanggal Bayar</label>
				<input type="text" name="tanggal_bayar" class="form-control border border-dark" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['tanggal_bayar'])) { echo set_value('tanggal_bayar'); }elseif($header_transaksi->tanggal_bayar!="") { echo $header_transaksi->tanggal_bayar; }else{ echo date('d-m-Y'); } ?>">
			</div>
			<div class="form-group">
				<label class="control-label">Jumlah Transfer</label>
				<input type="number" name="jumlah_bayar" class="form-control border border-dark" placeholder="Jumlah pembayaran" value="<?php if(isset($_POST['jumlah_bayar'])) { echo set_value('jumlah_bayar'); }elseif($header_transaksi->jumlah_bayar!="") { echo $header_transaksi->jumlah_bayar; }else { echo $header_transaksi->jumlah_transaksi; } ?>">
				
			</div>
			<div class="form-group">
				<label for="id_rekening_pelanggan">Metode Pembayaran</label>
				
				<select name="id_rekening_pelanggan" class="form-control" id="id_rekening_pelanggan">
					<option value="">- Pilih Metode Pembayaran -</option>
					<option value="dana">DANA</option>
					<?php if($rekening_pelanggan) { ?>
					
					<?php foreach($rekening_pelanggan as $rekening_pelanggan) { ?>
					<option class="form-control border border-dark" value="<?php echo $rekening_pelanggan->id_rekening ?>">
						Transfer dari Bank <?php echo $rekening_pelanggan->nama_bank ?> (NO. Rekening: <?php echo $rekening_pelanggan->nomor_rekening ?> a.n <?php echo $rekening_pelanggan->nama_pemilik ?>)
					</option>
					<?php } ?>
				</select>
				<?php } else { ?>
				</select>
				<a href="<?php echo base_url('rekening/tambah') ?>" class="btn btn-success">Tambah Rekening</a>
				<?php } ?>	
			</div>
			<div class="form-group">
				<label class="control-label">Upload Bukti Bayar</label>
				<input type="file" name="bukti_bayar" class="form-control border border-dark" placeholder="Upload Bukti Pembayaran">		
			</div>
			<div class="form-group">
				<div class="btn-group">
					<button class="btn btn-success btn-lg" type="submit" name="submit"><i class="fa fa-upload"></i> Submit</button>
					<button class="btn btn-info btn-lg" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
				</div>
			</div>

			<?php 
			// Form Close
			echo form_close();

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