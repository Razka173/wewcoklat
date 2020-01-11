<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
<!-- Cart item -->
<div class="container-table-cart pos-relative">
<div class="wrap-table-shopping-cart bgwhite" style="max-width: 100%; overflow-x: hidden;">

	<h1><?php echo $title ?></h1>
	<hr>
	<div class="clearfix"></div>
	<br><br>

	<!-- NOTIFIKASI SUKSES -->
	<?php if($this->session->flashdata('sukses')) {
		echo '<div class="alert alert-warning">';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	}
	?>

	<table class="table-shopping-cart m-l-20">
		<tr class="table-head">
			<th class="text-center">GAMBAR</th>
			<th class="text-center">PRODUK</th>
			<th class="text-center">HARGA</th>
			<th class="text-center">JUMLAH</th>
			<th class="text-center">SUB TOTAL</th>
			<th class="text-center">ACTION</th>
		</tr>

		<?php
		// Looping data keranjang belanja
		foreach($keranjang as $keranjang) { 
			// Ambil data produk
			$id_produk 	= $keranjang['id'];
			$produk 	= $this->produk_model->detail($id_produk);

			// Form update keranjang
			echo form_open(base_url('belanja/update_cart/'.$keranjang['rowid']));	
		?>

		<tr class="table-row">
			<td class="text-center">
				<div class="text-center">
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" alt="<?php echo $keranjang['name'] ?>" style="width:90px;">
				</div>
			</td>
			<td class="text-center"><?php echo $keranjang['name'] ?></td>
			<td class="text-center">Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></td>
			<td class="text-center"><?php echo $keranjang['qty'] ?></td>
			<td class="text-center">Rp. 
				<?php $sub_total = $keranjang['price'] * $keranjang['qty'];
				echo number_format($sub_total,'0',',','.');
				 ?>
			</td>
			<td class="text-center">
  				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?php echo $keranjang['rowid']?>">
  					<i class="fa fa-trash"></i> Edit
				</button>

				<a href="<?php echo base_url('belanja/hapus/'.$keranjang['rowid']) ?>" class="btn btn-warning btn-sm">
					<i class="fa fa-trash-o"></i> Hapus
				</a>
			</td>
		</tr>

<!-- Edit Modal -->
<!-- Modal -->
<div class="modal fade" id="editModal<?php echo $keranjang['rowid']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<!-- Modal Header  -->
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Jumlah Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Konten -->
      <div class="modal-body mx-3">
      		<p><?php echo $keranjang['name'] ?></p>
      		<br>
      		<div class="row justify-content-center">
		      	<button class="btn-num-product-down color2 flex-c-m size7 bg8 eff2">
					<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
				</button>
				<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?php echo $keranjang['qty'] ?>">
				<button class="btn-num-product-up color2 flex-c-m size7 bg8 eff2">
					<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
				</button>
			</div>
      </div>
      <!-- MODAL FOOTER -->
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-success" type="submit" name="update">Save</button>
      </div>
    </div>
  </div>
</div>

		<?php 
		// Echo form close
		echo form_close();
		// End loopinng keranjang belanja
		}
		?>
		<tr class="table-row bg-info text-strong" style="font-weight: bold; color: white !important;">
			<td colspan="4" class="column-1">Total Belanja</td>
			<td colspan="2" class="column-2">Rp. <?php echo number_format($this->cart->total(),'0',',','.') ?></td>
		</tr>
		
	</table>
		<br>
	<?php 
	echo form_open(base_url('belanja/checkout')); 
	$kode_transaksi = date('dmY').strtoupper(random_string('alnum',8));
	?>
	<input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
	<input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total(); ?>">
	<input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
	<table class="table">
			<thead>
				<tr>
					<th width="25%">Kode Transaksi</th>
					<th><input type="text" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" readonly required></th>
				</tr>
				<tr>
					<th width="25%">Nama Penerima</th>
					<th><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Email Penerima</td>
					<td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" required></td>
				</tr>
				<tr>
					<td>Nomor HP</td>
					<td><input type="text" name="telepon" class="form-control" placeholder="Masukan Nomor HP disini..." value="<?php echo $pelanggan->telepon ?>" required></td>
				</tr>
				<tr>
					<td>Alamat Pengiriman</td>
					<td><textarea name="alamat" class="form-control" placeholder="Masukan Alamat disini..."><?php echo $pelanggan->alamat ?></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button class="btn btn-success btn-lg" type="submit">
							<i class="fa fa-save"></i> Check Out Sekarang
						</button>
						<button class="btn btn-default btn-lg" type="reset">
							<i class="fa fa-times"></i> Reset
						</button>
					</td>
				</tr>
			</tbody>
		</table>

	<?php echo form_close(); ?>
</div>
</div>


</div>
</section>