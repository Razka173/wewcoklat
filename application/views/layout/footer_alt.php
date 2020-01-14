<?php  
// Load data konfigurasi website
$site 				= $this->konfigurasi_model->listing();
$nav_produk_footer 	= $this->konfigurasi_model->nav_produk();
?>
<style type="text/css" media="screen">
	.wew-footer{
		background-color: rgb(77, 34, 0);
	}
	.wew-footer-area{
		margin-bottom: 30;
		padding: 70px 0px;
		background-color: rgb(129, 58, 0);
	}
	.wew-widget i, .wew-widget a{
		color: white;
		font-size: 14px;
	}
	.wew-widget h4, .wew-widget p{
		color: white;
	}
	.wew-widget a{
		border-radius: 30px;
	}
	.wew-copyright div, .wew-copyright a{
		color: white;
		font-size: 15px
	}
	.wew-instagram{
		background-color: rgb(122, 46, 234);
	}
	.wew-instagram:hover{
		background-color: rgb(106, 22, 233);
	}
</style>
<!--============================================ FOOTER ===============================================-->
	<footer class="footer wew-footer">
		<div class="footer-area wew-footer-area">
			<div class="container">
				<div class="row section_gap">
					
					<div class="col-lg-6 mb-3">
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

					<div class="col-lg-3 mb-3">
						<div class="wew-widget">
							<h4 class="footer_title mb-3">Links</h4>
							<a class="p-3 mb-3 btn btn-danger col-lg-12" href="https://shopee.co.id/faqihalfarisi17" target="_blank">
								<i class="fa fa-shopping-bag"></i> Buy on Shopee
							</a>
							<a class="p-3 mb-3 btn col-lg-12 wew-instagram" href="https://instagram.com/wewcoklat" target="_blank">
								<i class="fa fa-instagram"></i> Follow us on Instagram
							</a>
							<a class="p-3 mb-3 btn btn-success col-lg-12" href="https://wa.me/6283870819680" target="_blank">
								<i class="fa fa-whatsapp"></i> Contact us on WhatsApp
							</a>	
						</div>
					</div>

					<div class="col-lg-3 mb-3">
						<div class="wew-widget">
							<h4 class="footer_title mb-3">Contact Us</h4>
							<!-- HEAD OFFICE -->
							<div class="ml-40 row mb-3">
								<div class="col-md-2">
									<span class="btn btn-warning rounded-circle"><i class="fa fa-location-arrow"></i></span>
								</div>
								<div class="col-md-10">
									<p><strong>Head Office</strong></p>
									<p>Malaka RT3/4 Cilangkap, Jakarta Timur</p>
								</div>
							</div>
							<!-- PHONE NUMBER -->
							<div class="ml-40 row mb-3">
								<div class="col-md-2">
									<span class="btn btn-warning rounded-circle"><i class="fa fa-phone"></i></span>
								</div>
								<div class="col-md-10">
									<p><strong>Phone Number</strong></p>
									<p>+62 828 7081 9680</p>
								</div>
							</div>
							<!-- EMAIL -->
							<div class="ml-40 row mb-1">
								<div class="col-md-2">
									<span class="btn btn-warning rounded-circle"><i class="fa fa-envelope"></i></span>
								</div>
								<div class="col-md-10">
									<p><strong>Email</strong></p>
									<p>wewcokelat@gmail.com <br>
									www.wewcoklat.com</p>
								</div>
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