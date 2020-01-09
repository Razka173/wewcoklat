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
echo form_open_multipart(base_url('admin/konfigurasi/slider_primary'),' class="form-horizontal"');
?>

<div class="form-group form-group row">
	<label class="col-md-3 control-label" for="slider_primary_header">Judul Slider</label>
	<div class="col-md-7">
		<input type="text" name="slider_primary_header" id="slider_primary_header" class="form-control" placeholder="Judul Slider" value="<?php echo $konfigurasi->slider_primary_header ?>" required>
	</div>
</div>
<hr>

<div class="form-group form-group row">
	<label class="col-md-3 control-label" for="slider_primary_deskripsi">Deskripsi Slider</label>
	<div class="col-md-7">
		<input type="text" name="slider_primary_deskripsi" id="slider_primary_deskripsi" class="form-control" placeholder="Deskripsi Slider" value="<?php echo $konfigurasi->slider_primary_deskripsi ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-3 control-label">Upload Slider Baru</label>
	<div class="col-md-7">
		<input type="file" name="slider_primary_gambar" id="slider_primary_gambar" class="form-control" placeholder="Upload Slider Baru">
		Slider Lama: <br>
		<img src="<?php echo base_url('assets/upload/image/'.$konfigurasi->slider_primary_gambar)?>" class="img img-responsive img-thumbnail" width="200">
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