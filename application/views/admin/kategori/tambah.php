<?php
// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open(base_url('admin/kategori/tambah'),' class="form-horizontal"');
?>

<div class="form-inline">
	<label class="col-md-2 control-label" for="nama_kategori">Nama Kategori</label>
	<div class="col-md-5">
		<input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama kategori" value="<?php echo set_value('nama') ?>" required>
	</div>
</div>

<hr>

<div class="form-inline">
	<label class="col-md-2 control-label" for="urutan">Urutan</label>
	<div class="col-md-5">
		<input type="number" name="urutan" id="urutan" class="form-control" placeholder="Urutan kategori" value="<?php echo set_value('urutan') ?>" required>
	</div>
</div>

<hr>

<div class="form-inline">
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