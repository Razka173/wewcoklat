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
        <div class="col-sm-6 col-md-4 col-lg-2 menu">
            
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
            ?>
            
            <?php
            foreach( $rekening as $rekening ) {
            ?>
                <h2 class="text-center"><?php echo $rekening->nama_bank . " - " ?><strong><?php echo $rekening->nomor_rekening ?></strong></h2>
                <h2 class="text-center"><?php echo 'a/n. ' . $rekening->nama_pemilik ?></h3>
            <?php 
            }
            ?>
            <h2 class="text-center  m-t-50">QR-DANA</h2>
            <div class="row justify-content-center">
                <img src="https://i.imgur.com/RbaEUO1.jpg" alt="QR-DANA" width="450px">
            </div>

            <a href="<?php echo base_url('dasbor') ?>" class="btn btn-secondary m-t-50">Kembali ke halaman Dashboard</a>

        </div>
    </div>
</div>
</section>
