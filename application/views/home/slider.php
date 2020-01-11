<!-- Slide1 -->
<section class="slide1">
<style type="text/css" media="screen">
	@media (max-width: 768px){
		.wew-slider h2{
			font-size: 20px !important;
		}
	}
	.wew-slider{
		background-size: cover;
		background-color: rgba(129, 58, 0, 1); 
		background-blend-mode: multiply;
	}
	.wew-slider-tombol{
		border-color: white; 
		color: white; 
		border: 3px solid white;
	}
</style>
	<div class="wrap-slick1">
		<div class="slick1">

			<div class="item-slick1 item1-slick1 wew-slider" style="background-image: url(<?php echo base_url('assets/upload/image/'.$site->slider_primary_gambar) ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
						<?php echo $site->slider_primary_header ?>
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
						<?php echo $site->slider_primary_deskripsi ?>
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
						<!-- Button -->
						<a href="<?php echo base_url('produk') ?>" class="flex-c-m size2 bo-rad-23 s-text2 hov1 trans-0-4 wew-slider-tombol">
							Shop Now
						</a>
					</div>
				</div>
			</div>
			
			<div class="item-slick1 item2-slick1 wew-slider" style="background-image: url(<?php echo base_url('assets/upload/image/'.$site->slider_secondary_gambar) ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
						<?php echo $site->slider_secondary_header ?>
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
						<?php echo $site->slider_secondary_deskripsi ?>
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
						<!-- Button -->
						<a href="<?php echo base_url('produk') ?>" class="flex-c-m size2 bo-rad-23 s-text2 hov1 trans-0-4 wew-slider-tombol">
							Shop Now
						</a>
					</div>
				</div>
			</div>
			
			<div class="item-slick1 item3-slick1 wew-slider" style="background-image: url(<?php echo base_url('assets/upload/image/'.$site->slider_other_gambar) ?>);">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
						<?php echo $site->slider_other_header ?>
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
						<?php echo $site->slider_other_deskripsi ?>
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
						<!-- Button -->
						<a href="<?php echo base_url('produk') ?>" class="flex-c-m size2 bo-rad-23 s-text2 hov1 trans-0-4 wew-slider-tombol">
							Shop Now
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>