<style>
	.table-shopping-cart {
		overflow-x: auto;
	}
</style>

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
	<?php 
	if($this->session->flashdata('sukses')) {
		echo '<div class="alert alert-warning">';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	}
	if($this->session->flashdata('warning')) {
		echo '<div class="alert alert-warning">';
		echo $this->session->flashdata('warning');
		echo '</div>';
	}
	?>

	<table class="table-shopping-cart m-l-20" style="overflow-x: auto;">
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
  					<i class="fa fa-edit"></i> Edit
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
<!-- END MODAL -->

		<?php 
		// Echo form close
		echo form_close();
		// End loopinng keranjang belanja
		}
		?>
		<tr class="table-row bg-primary text-strong" style="font-weight: bold; color: white;">
			<td colspan="3" class="text-center text-white">Total Belanja</td>
			<td></td>
			<td colspan="1" class="text-center text-white">Rp. <?php echo number_format($this->cart->total(),'0',',','.') ?></td>
			<td></td>
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


	<div class="m-l-50 tabel-form">

		<div class="row form-group">
			<label class="col-lg-3" for="kode_transaksi">Kode Transaksi</label>
	        <input type="text" class="form-control border border-dark col-lg-4" id="kode_transaksi" name="kode_transaksi" value="<?php echo $kode_transaksi ?>" required readonly>
	    </div>

	    <div class="row form-group">
			<label class="col-lg-3" for="nama_pelanggan">Nama Penerima</label>
			<input type="text" class="form-control border border-dark col-lg-4" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
		</div>

		<div class="row form-group">
			<label class="col-lg-3" for="email">Email Penerima</label>
			<input type="email" class="form-control border border-dark col-lg-4" id="email" name="email" placeholder="Email" value="<?php echo $pelanggan->email ?>" required>
		</div>

		<div class="row form-group">
			<label class="col-lg-3" for="telepon">Nomor HP</label>
			<input type="text" class="form-control border border-dark col-lg-4" id="telepon" name="telepon" placeholder="Masukan Nomor HP disini..." value="<?php echo $pelanggan->telepon ?>" required></td>
		</div>

		<div class="row form-group">
			<label class="col-lg-3" for="metode_pengiriman">Metode Pengiriman</label>
			<select id="metode_pengiriman" class="form-control border border-dark col-lg-4" name="metode_pengiriman">
				<option value="">- Pilih Metode Pengiriman -</option>
				<option value="COD">Cash on Delivery (COD)</option>
				<option value="JNE">Antar Kurir</option>
			</select>
		</div>

		<div class="row form-group" style="display: none" id="div_alamat">
			<label class="col-lg-3" for="alamat">Alamat Pengiriman</label>
			<?php
			if($alamat_pelanggan){
			?>
			<select id="alamat" name="alamat" class="form-control border border-dark col-lg-6">
				<option value="">- Pilih Alamat -</option>
				<?php 
					foreach($alamat_pelanggan as $alamat_pelanggan) { 
				?>
				<option value="<?php echo $alamat_pelanggan->id_alamat ?>">
					<?php echo $alamat_pelanggan->alamat_detail ?>
				</option>
				<?php 
					}
				
				?>
			</select>
			<?php 
			} else { ?>
				<a href="<?php echo base_url('dasbor/alamat') ?>" class="btn btn-success">Tambah Alamat</a>
			<?php
				}
			?>
		</div>

		<div class="row form-group" style="display: none" id="div_cod">
			<label class="col-lg-3" for="cod">Tempat Janjian</label>
			<select id="cod" name="cod" class="form-control border border-dark col-lg-6">
				<option value="UNJ">UNJ</option>
				<option value="DEPOK">DEPOK</option>
			</select>
		</div>

		<div class="row m-t-50 m-l-110">
			<button class="btn btn-success btn-lg" type="submit">
				<i class="fa fa-save"></i> Check Out Sekarang
			</button>
			<button class="btn btn-default btn-lg" type="reset">
				<i class="fa fa-times"></i> Reset
			</button>
		</div>

    </div>

	<?php echo form_close(); ?>
</div>
</div>
	

</div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">

$("#metode_pengiriman").change(function(){
    var metode_pengiriman = this.value;
    if(metode_pengiriman=='JNE'){
    	$("#div_alamat").show();
    	$("#div_cod").hide();
    }
    if(metode_pengiriman=='COD'){
    	$("#div_cod").show();
    	$("#div_alamat").hide();
    }
    
});

</script>