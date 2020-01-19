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
            echo form_open(base_url('rekening/tambah'), 'class="leave-comment"');
            ?>

            <div class="form-group">
                <label for="nama_bank">Nama Bank</label>
                <input type="text" class="form-control border border-dark" id="nama_bank" name="nama_bank" placeholder="contoh: BNI" value="<?php echo set_value('nama_bank') ?>" required>
            </div>

            <div class="form-group">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input type="text" class="form-control border border-dark" id="nomor_rekening" name="nomor_rekening" placeholder="contoh: 6578492845" value="<?php echo set_value('nomor_rekening') ?>" required>
            </div>

            <div class="form-group">
                <label for="nama_pemilik">Nama pemilik</label>
                <input type="text" class="form-control border border-dark" id="nama_pemilik" name="nama_pemilik" placeholder="contoh: John Due" value="<?php echo set_value('nama_pemilik') ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Simpan</button>

        <?php echo form_close(); ?>

            <a href="<?php echo base_url('dasbor/rekening') ?>" class="btn btn-secondary m-t-5">Batalkan</a>
            
        </div>
    </div>
</div>
</section>