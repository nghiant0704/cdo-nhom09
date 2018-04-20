<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <?php $this->load->view('front/head');?>
</head>
<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->

        <?php $this->load->view('front/header', $this->data); ?>

        <!-- Content -->
        <?php  $this->load->view($template, $this->data);?>
        <!-- End content -->

        <?php $this->load->view('front/footer')?>

	</div><!-- /.boxed -->

		<!-- Javascript -->

		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/tether.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/waypoints.min.js"></script>
		<!-- <script type="text/javascript" src="javascript/jquery.circlechart.js"></script> -->
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/easing.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/smoothscroll.js"></script>
		<!-- <script type="text/javascript" src="javascript/jquery-ui.js"></script> -->
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/waves.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/jquery.countdown.js"></script>

		<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/main.js"></script>

</body>	
</html>