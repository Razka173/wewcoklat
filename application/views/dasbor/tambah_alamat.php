<style>
    .container {
        max-width: 1240px;
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

            <?php
            // Notifikasi
            if($this->session->flashdata('sukses')) {
            echo '<div class="alert alert-warning">';
            echo $this->session->flashdata('sukses');
            echo '</div>';
            }

            // Display error
            echo validation_errors('<div class="alert alert-warning">','</div>');

            // form open
            echo form_open(base_url('alamat/tambah'), 'class="leave-comment"');
            ?>
            <!-- LIST PROVINSI -->
            <div class="form-group required">
                <label for="input-payment-zone" class="control-label">Provinsi</label>
                <select class="form-control border border-dark" id="list_provinsi" name="id_province"></select>
            </div>
            
            <!-- LIST KOTA -->
            <div class="form-group required" style="display:none" id="div_kota">
                <label for="input-payment-city" class="control-label">Kota / Kabupaten</label>
                <select class="form-control border border-dark" id="list_kotakab" name="id_kota"></select>
            </div>

            <div class="form-group">
                <label for="alamat_detail">Alamat Detail</label>
                <input type="text" class="form-control border border-dark" id="alamat_detail" name="alamat_detail" placeholder="contoh: Jalan Rawamangun Muka" value="<?php echo set_value('alamat_detail') ?>" required>
            </div>

            <div class="row form-group">
                <div class="col">
                <label for="rt">RT</label>
                <input type="number" class="form-control border border-dark" id="rt" name="rt" placeholder="contoh: 002" min="1" max="999" value="<?php echo set_value('rt') ?>" required>
                </div>

                <div class="col">
                <label for="rw">RW</label>
                <input type="number" class="form-control border border-dark" id="rw" name="rw" placeholder="contoh: 003" min="1" max="999" value="<?php echo set_value('rw') ?>" required>
                </div>

                <div class="col">
                <label for="kode_pos">Kode Pos</label>
                <input type="number" class="form-control border border-dark" id="kode_pos" name="kode_pos" placeholder="contoh: 14230" max="99999" value="<?php echo set_value('kode_pos') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat_label">Alamat Label</label>
                <select class="form-control border border-dark" name="alamat_label" id="alamat_label" required>
                    <option value="Rumah">Rumah</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Kampus">Kampus</option>
                </select>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="tel" class="form-control border border-dark" id="telepon" name="telepon" placeholder="contoh: 083896179217" value="<?php echo $pelanggan->telepon ?>" required>
            </div>

            <button type="submit" class="btn btn-success m-t-15">Simpan</button>

        <?php echo form_close(); ?>

            <a href="<?php echo base_url('dasbor/alamat') ?>" class="btn btn-secondary m-t-5">Batalkan</a>

        </div>
    </div>
</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
//* select Provinsi */
var base_url = "<?php echo base_url();?>";
$.ajax({
    type: 'post',
    url: base_url + 'alamat/rajaongkir_get_provinsi',
    data: {},
    dataType  : 'html',
    success: function (data) {
        $("#list_provinsi").html(data);
    }
});

$("#list_provinsi").change(function(){
    var id_province = this.value;
    kota(id_province);
    $("#div_kota").show();
});

/* select Kota */
kota = function(id_province){
    $.ajax({
    type: 'post',
    url: base_url + 'alamat/rajaongkir_get_kota',
    data: {id_province:id_province},
    dataType  : 'html',
    success: function (data) {
        $("#list_kotakab").html(data);
    },
    beforeSend: function () { 
    },
    complete: function () {  
    }
});
}

$("#list_kotakab").change(function(){
    var id_kota = this.value;
});

</script>
