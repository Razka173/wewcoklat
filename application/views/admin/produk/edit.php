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
echo form_open_multipart(base_url('admin/produk/edit/'.$produk->id_produk),' class="form-horizontal"');
?>

<div class="form-group form-group row">
	<label class="col-md-2 control-label" for="nama_produk">Nama Produk</label>
	<div class="col-md-5">
		<input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Nama Produk" value="<?php echo $produk->nama_produk ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="kode_produk">Kode Produk</label>
	<div class="col-md-5">
		<input type="text" name="kode_produk" id="kode_produk" class="form-control" placeholder="Kode Produk" value="<?php echo $produk->kode_produk ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="id_kategori">Kategori Produk</label>
	<div class="col-md-5">
		<select name="id_kategori" id="id_kategori" class="form-control">
			<?php foreach($kategori as $kategori) { ?>
			<option value="<?php echo $kategori->id_kategori ?>" <?php if($produk->id_kategori==$kategori->id_kategori) { echo "selected"; } ?>>
				<?php echo $kategori->nama_kategori ?>
			</option>
			<?php } ?>
		</select>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="harga">Harga Produk</label>
	<div class="col-md-5">
		<input type="number" name="harga" id="harga" class="form-control" placeholder="Harga Produk" value="<?php echo $produk->harga ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="stok">Stok Produk</label>
	<div class="col-md-5">
		<input type="number" name="stok" id="stok" class="form-control" placeholder="Stok Produk" value="<?php echo $produk->stok ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="berat">Berat Produk</label>
	<div class="col-md-5">
		<input type="text" name="berat" id="berat" class="form-control" placeholder="Berat Produk" value="<?php echo $produk->berat ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="ukuran">Ukuran Produk</label>
	<div class="col-md-5">
		<input type="text" name="ukuran" id="ukuran" class="form-control" placeholder="Ukuran Produk" value="<?php echo $produk->ukuran ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="keterangan">Keterangan Produk</label>
	<div class="col-md-8">
		<textarea name="keterangan" id="editor" class="form-control" placeholder="Keterangan"><?php echo $produk->keterangan ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="keywords">Keyword (untuk SEO google)</label>
	<div class="col-md-8">
		<textarea name="keywords" id="keywords" class="form-control" placeholder="Keyword (untuk SEO google)"><?php echo $produk->keywords ?></textarea>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="gambar">Upload Gambar Produk</label>
	<div class="col-md-5">
		<input type="file" name="gambar" id="gambar" class="form-control">
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="status_produk">Status Produk</label>
	<div class="col-md-5">
		<select name="status_produk" id="status_produk" class="form-control">
			<option value="Publish">Publikasikan</option>
			<option value="Draft" <?php if($produk->status_produk=="Draft") { echo "selected"; } ?>>Simpan Sebagai Draft</option>
		</select>
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