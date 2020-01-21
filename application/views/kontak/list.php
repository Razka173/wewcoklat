<section>
<style>
input[type=text],input[type=email], select, textarea {
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}
/* Add a background color and some padding around the form */
.container-kontak {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
@media (max-width: 768px) {
        .container-kontak{
            margin-top: 0px;
            margin-bottom: 0px;
        }
}
</style>
<div class="container container-kontak m-t-100 m-b-150">

    <h2 class="mb-5"><?php echo $title ?></h2>

    <?php 
    // Notifikasi error
    echo validation_errors('<div class="alert alert-warning">','</div>');

    // Form Open
    echo form_open(base_url('kontak'),'class="form-horizontal"');

    if($this->session->flashdata('sukses')){
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('sukses');
        echo '</div>';
    }
    ?>

    <label for="nama">Nama</label>
    <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama kamu..." value="<?php echo set_value('nama') ?>" required>

    <label for="email">Email</label>
    <input class="form-control" type="email" id="email" name="email" placeholder="Email kamu..." value="<?php echo set_value('email') ?>" required>

    <label for="pesan">Pesan</label>
    <textarea class="form-control" id="pesan" name="pesan" placeholder="Tulis sesuatu disini..." style="height:200px; min-height: 50px;" value="<?php echo set_value('pesan')?>" required></textarea>

    <button class="btn btn-success btn-lg" type="submit">
        <i class="fa fa-save"></i> Submit
    </button>

    <button class="btn btn-default btn-lg" type="reset">
        <i class="fa fa-times"></i> Reset
    </button>

    <?php
    // Form Close 
    echo form_close(); 
    ?>
</div>
</section>

