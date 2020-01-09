<?php 
// Notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	// echo '</div>';
}
?>

<?php
// Error upload
if(isset($error)) {
	echo '<p class="alert alert-warning">';
	echo $error;
	echo '</p>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/konfigurasi'),' class="form-horizontal"');
?>

<div class="form-group form-group row">
	<label class="col-md-3 control-label" for="namaweb">Nama Website</label>
	<div class="col-md-5">
		<input type="text" name="namaweb" id="namaweb" class="form-control" placeholder="Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="tagline">Tagline/Moto</label>
	<div class="col-md-9">
		<input type="text" name="tagline" id="tagline" class="form-control" placeholder="Tagline/Moto" value="<?php echo $konfigurasi->tagline ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="email">Email</label>
	<div class="col-md-9">
		<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $konfigurasi->email ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="website">Website</label>
	<div class="col-md-9">
		<input type="text" name="website" id="website" class="form-control" placeholder="Website" value="<?php echo $konfigurasi->website ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="facebook">Alamat Facebook</label>
	<div class="col-md-9">
		<input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook" value="<?php echo $konfigurasi->facebook ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="instagram">Alamat Instagram</label>
	<div class="col-md-9">
		<input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram" value="<?php echo $konfigurasi->instagram ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="telepon">Telepon/HP</label>
	<div class="col-md-9">
		<input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo $konfigurasi->telepon ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="alamat">Alamat</label>
	<div class="col-md-9">
		<textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat kantor"><?php echo $konfigurasi->alamat ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="keywords">Keyword (untuk SEO google)</label>
	<div class="col-md-9">
		<textarea name="keywords" id="keywords" class="form-control" placeholder="Keyword (untuk SEO google)"><?php echo $konfigurasi->keywords ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="metatext">Kode Metatext</label>
	<div class="col-md-9">
		<textarea name="metatext" id="metatext" class="form-control" placeholder="Metatext"><?php echo $konfigurasi->metatext ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="deskripsi">Deskripsi Website</label>
	<div class="col-md-9">
		<textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi Website"><?php echo $konfigurasi->deskripsi ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label" for="rekening_pembayaran">Rekening Pembayaran</label>
	<div class="col-md-9">
		<textarea name="rekening_pembayaran" id="rekening_pembayaran" class="form-control" placeholder="Rekening Pembayaran"><?php echo $konfigurasi->rekening_pembayaran ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-5">
		<button class="btn btn-success btn-lg" name="submit" type="submit">
			<i class="fa fa-save"></i> Simpan
		</button>
		<button class="btn btn-info btn-lg" name="reset" type="reset">
			<i class="fa fa-times"></i> Reset
		</button>
	</div>
</div>

<?php echo form_close(); ?>