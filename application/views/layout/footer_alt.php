<?php  
// Load data konfigurasi website
$site 				= $this->konfigurasi_model->listing();
$nav_produk_footer 	= $this->konfigurasi_model->nav_produk();
?>
<style type="text/css" media="screen">
	.wew-footer{
		background-color: rgb(129, 58, 0);
	}
	.wew-footer-area{
		margin-bottom: 30;
		padding: 70px 0px;
		background-color: rgb(129, 58, 0);
	}
	.wew-copyright div, i, a{
		color: white;
		font-size: 15px;
	}
	.wew-widget h4, p{
		color: white;
	}
</style>
<!--============================================ FOOTER ===============================================-->
	<footer class="footer wew-footer">
		<div class="footer-area wew-footer-area">
			<div class="container">
				<div class="row section_gap">
					
					<div class="col-lg-4 mb-3">
						<div class="wew-widget">
							<h4 class="footer_title mb-3">Guys...</h5>
							<p>
								Banyak tugas, kegiatan, beribadah dan deadline adalah faktor pewarna dalam timeline hidup kita. Tapi diantara padatnya aktivitas, ada kalanya kita sebagai human general butuh kesunyian, kesendirian, pelukan hangat dari yang terkasih dan penyejuk hati.
							</p>
							<p>
	            				Cobalah coklat dari <strong>WewCoklat</strong>, Karena dekapan tulus hanya dari <strong>Wew</strong>.
							</p>
						</div>
					</div>

					<div class="col-lg-4 mb-3">
						<div class="wew-widget">
							<h4 class="footer_title mb-3">Links</h4>
							<ul class="list text-center text-white">
				            <div class="p-3 mb-3 bg-danger"><li><span class="fa fa-shopping-bag text-light"></span> <a href="https://shopee.co.id/faqihalfarisi17">Buy on Shopee</a></li></div>
				            <div class="p-3 mb-3 bg-primary"><li><span class="fa fa-instagram text-light"></span> <a href="https://instagram.com/wewcoklat">Follow us on Instagram</a></li></div>
				            <div class="p-3 mb-3 bg-success"><li><span class="fa fa-whatsapp text-light"></span> <a href="wa.me/6283870819680">Contact Us on WhatsApp</a></li></div>
							</ul>
						</div>
					</div>

					<div class="col-lg-4 mb-3">
						<div class="wew-widget">
							<h4 class="footer_title mb-3">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>Jl. Malaka RT3/4 Cilangkap, Jakarta Timur</p>
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									+62 828 7081 9680
								</p>
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									wewcokelat@gmail.com <br>
									www.wewcoklat.com
								</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- COPYRIGHT TEMPLATE -->
		<div class="t-center p-l-15 p-r-15 wew-copyright">
			<div class="t-center s-text8 p-t-20 p-b-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>
<!--========================================= END FOOTER ========================================-->

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
		// BUTTON WISHLIST
		// $('.block2-btn-addwishlist').each(function(){
		// 	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		// 	$(this).on('click', function(){
		// 		swal(nameProduct, "", "success");
		// 	});
		// });
	</script>

<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/template/js/main.js"></script>

</body>
</html>