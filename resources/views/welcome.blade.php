<!DOCTYPE html>
<html>
	<head>
		@include('layouts.header-css')
	</head>
	<body>

		<!-- site preloader start -->
		<div class="page-loader"></div>
		<!-- site preloader end -->

		<div class="pageWrapper">

			<!-- Header start -->
			<div class="top-bar gry-bg">
				@include('layouts.header-top')
			</div>
			<header class="top-head minimal no-border">
				@include('layouts.header')
		    </header>
		    <!-- Header start -->

		    <!-- Content start -->
	    	<div class="pageContent">

				@include('layouts.content')

		    </div>
	    	<!-- Content start -->

	    	<!-- Footer start -->
		    <footer id="footWrapper">

				@include('layouts.footer')

			</footer>
			<!-- Footer end -->

		</div>

		@include('layouts.footer-js')

	</body>
</html>