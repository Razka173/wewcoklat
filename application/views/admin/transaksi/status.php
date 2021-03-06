<?php
// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open(base_url('admin/transaksi/status/'.$header_transaksi->kode_transaksi),' class="form-horizontal"');
?>

<?php  
if($header_transaksi->bukti_bayar == ""){
	echo "Belum ada bukti bayar";
}
else{
?>
	<img class="ml-5 mb-3 col-md-6" id="myImg" src="<?php echo base_url('assets/upload/image/'.$header_transaksi->bukti_bayar) ?>" alt="." style="width:100%; max-width:300px">
<?php
}
?>
<!-- BUKTI BAYAR -->

<!-- The Modal -->
<div id="myModal" class="modal">
	<!-- The Close Button -->
	<span class="close">&times;</span>
	<!-- Modal Content (The Image) -->
	<img class="modal-content" id="img01">
	<!-- Modal Caption (Image Text) -->
	<div id="caption"></div>
</div>

<div class="form-inline mt-3">
	<label class="col-md-2 control-label" for="status_bayar">Status Bayar</label>
	<div class="col-md-5">
		<select name="status_bayar" id="status_bayar" class="form-control">
			<option value="Konfirmasi">Konfirmasi</option>
			<option value="Sudah Bayar" <?php if($header_transaksi->status_bayar=="Sudah Bayar") { echo "selected"; }?>>Sudah Bayar</option>
			<option value="Belum Bayar" <?php if($header_transaksi->status_bayar=="Belum Bayar") { echo "selected"; }?>>Belum Bayar</option>
			<option value="Bukti Tidak Valid" <?php if($header_transaksi->status_bayar=="Bukti Tidak Valid") { echo "selected"; }?>>Bukti Bayar Tidak Valid</option>
		</select>
	</div>
</div>

<div class="form-inline mt-3">
	<label class="col-md-2 control-label" for="status_pesanan">Status Pesanan</label>
	<div class="col-md-5">
		<select name="status_pesanan" id="status_pesanan" class="form-control">
			<option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
			<option value="Dalam Pengiriman" <?php if($header_transaksi->status_pesanan=="Dalam Pengiriman") { echo "selected"; }?>>Dalam Pengiriman</option>
			<option value="Terkirim" <?php if($header_transaksi->status_pesanan=="Terkirim") { echo "selected"; }?>>Terkirim</option>
			<option value="Dibatalkan" <?php if($header_transaksi->status_pesanan=="Dibatalkan") { echo "selected"; }?>>Dibatalkan</option>
		</select>
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

<style>
/* Style the Image Used to Trigger the Modal */
#myImg {
	border-radius: 5px;
	cursor: pointer;
	transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	padding-top: 100px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
	margin: auto;
	display: block;
	width: 80%;
	max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
	margin: auto;
	display: block;
	width: 80%;
	max-width: 700px;
	text-align: center;
	color: #ccc;
	padding: 10px 0;
	height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
	animation-name: zoom;
	animation-duration: 0.6s;
}

@keyframes zoom {
	from {transform:scale(0)}
	to {transform:scale(1)}
}

/* The Close Button */
.close {
	position: absolute;
	top: 15px;
	right: 35px;
	color: #f1f1f1;
	font-size: 40px;
	font-weight: bold;
	transition: 0.3s;
}

.close:hover,
.close:focus {
	color: #bbb;
	text-decoration: none;
	cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
	width: 100%;
}
} 
</style>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
	modal.style.display = "block";
	modalImg.src = this.src;
	captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}
</script> 