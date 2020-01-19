    <div class="form-group required">
        <label for="input-payment-zone" class="control-label">Provinsi</label>
        <select class="form-control" id="list_provinsi"></select>
    </div>
    <div class="form-group required" style="display:none" id="div_kota">
        <label for="input-payment-city" class="control-label">Kota / Kabupaten</label>
        <select class="form-control" id="list_kotakab"></select>
    </div>

    <label for="input-payment-postcode" class="control-label"><b>Kurir Pengiriman</b></label>
    <select class="form-control" id="list_kurir" style="margin-bottom: 2px">
        <option value="0">- Pilih Kurir Pengiriman -</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
        <option value="pos">POS Indonesia</option>
    </select>

    <ul class="list-group list-group-flush">
        <div id="list_kurir_div"></div>
    </ul>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
//* select Provinsi */
var base_url    = "<?php echo base_url();?>";
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

$("#list_kurir").change(function(){
    var id_kurir        = this.value;
    var id_kota         = $("#list_kotakab").val();
    cost(id_kurir,id_kota);
    $("#div_kurir").show();
});

cost = function(id_kurir,id_kota){
    $.ajax({
    type: 'post',
    url: base_url + 'alamat/rajaongkir_get_cost',
    data: {kurir_pengiriman:id_kurir,kota_tujuan:id_kota},
    dataType  : 'html',
    success: function (data) {
        $("#list_kurir_div").html(data);
    }
});
}
</script>
