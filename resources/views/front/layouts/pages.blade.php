
<!DOCTYPE html>
<html lang="lang">

<head>
<title>أكاديمية  الراتب للتفوق واﻹبداع</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content=""
	/>
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
    <!-- Bootstrap-Core-Css -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all">
    <!--//booststrap end-->
    <!-- font-awesome icons -->
    <link href="{{asset('front/css/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css" media="all">
    <!-- //font-awesome icons -->
    <link href="{{asset('front/css/blast.min.css')}}" rel="stylesheet" />
	  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style10.css')}}" />
    <!--stylesheets-->
	  <link href="{{asset('front/css/style-rtl.css')}}" rel='stylesheet' type='text/css' media="all">
	<link rel="stylesheet" href="{{asset('front/css/bootstrap.css')}}">
	<!-- Testimonials-Css -->
	<link href="{{asset('front/css/mislider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('front/css/mislider-custom.css')}}" rel="stylesheet" type="text/css" />
	<!-- Style-Css -->
	<link rel="stylesheet" href="{{asset('front/css/style.css')}}" type="text/css" media="all" />
	<!-- Font-Awesome-Icons-Css -->
	<link rel="stylesheet" href="{{asset('front/css/fontawesome-all.css')}}">
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	 rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //Web-Fonts -->

</head>


@include('front.layouts.header')
<!-- ////////////////////////////////////////////////////////////////////////////-->

@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('front.layouts.footer')



	<!-- Js files -->
	<!-- JavaScript -->

	<script src="{{asset('front/jspages/jquery-2.2.3.min.js')}}"></script>
	<!-- Default-JavaScript-File -->
	<script src="{{asset('front/jspages/bootstrap.js')}}"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- banner slider -->
	<script src="{{asset('front/jspages/slider.js')}}"></script>
	<!-- //banner slider -->
    <script src="{{asset('front/js/blast.min.js')}}"></script>

	<!-- testimonial-plugin -->
	<script src="{{asset('front/jspages/mislider.js')}}"></script>
	<script>
		jQuery(function ($) {
			var slider = $('.mis-stage').miSlider({
				//  The height of the stage in px. Options: false or positive integer. false = height is calculated using maximum slide heights. Default: false
				stageHeight: 320,
				//  Number of slides visible at one time. Options: false or positive integer. false = Fit as many as possible.  Default: 1
				slidesOnStage: false,
				//  The location of the current slide on the stage. Options: 'left', 'right', 'center'. Defualt: 'left'
				slidePosition: 'center',
				//  The slide to start on. Options: 'beg', 'mid', 'end' or slide number starting at 1 - '1','2','3', etc. Defualt: 'beg'
				slideStart: 'mid',
				//  The relative percentage scaling factor of the current slide - other slides are scaled down. Options: positive number 100 or higher. 100 = No scaling. Defualt: 100
				slideScaling: 150,
				//  The vertical offset of the slide center as a percentage of slide height. Options:  positive or negative number. Neg value = up. Pos value = down. 0 = No offset. Default: 0
				offsetV: -5,
				//  Center slide contents vertically - Boolean. Default: false
				centerV: true,
				//  Opacity of the prev and next button navigation when not transitioning. Options: Number between 0 and 1. 0 (transparent) - 1 (opaque). Default: .5
				navButtonsOpacity: 1,
			});
		});
	</script>
	<!-- //testimonial-plugin -->

	<!-- numscroller-js-file -->
	<script src="{{asset('front/jspages/numscroller-1.0.js')}}"></script>
	<!-- //numscroller-js-file -->

	<!-- smooth scrolling -->
	<script src="{{asset('front/jspages/SmoothScroll.min.js')}}"></script>
	<!-- //smooth scrolling -->

	<!-- move-top -->
	<script src="{{asset('front/jspages/move-top.js')}}"></script>
	<!-- easing -->
	<script src="{{asset('front/jspages/easing.js')}}"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="{{asset('front/jspages/edulearn.js')}}"></script>

	<!-- //Js files -->

</body>

</html>