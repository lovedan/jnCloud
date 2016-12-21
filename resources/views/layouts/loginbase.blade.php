<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

<!-- Top menu -->
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Bootstrap Registration Form Template</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top-navbar-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
							<span class="li-text">
								欢迎关注我们：
							</span>
                    <span class="li-social">
								<a href="#"><i class="fa fa-weibo"></i></a>
								<a href="#"><i class="fa fa-tencent-weibo"></i></a>
								<a href="#"><i class="fa fa-weixin"></i></a>
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text">
                    <h1>欢迎使用<strong>江南云</strong> 服务</h1>
                    <div class="description">
                        <p>
                            江南云-提供基于天翼云盘的云存储服务，包括图片，音乐，视频，文件的云存储下载服务。
                            <!--<a href="http://azmind.com"><strong>AZMIND</strong></a>, customize and use it as you like!-->
                        </p>
                    </div>
                    <div class="top-big-link">
                        <a class="btn btn-link-1" href="{{ url('/register') }}">百度授权</a>
                        <a class="btn btn-link-2" href="#">天翼授权</a>
                    </div>
                </div>
                {{--@yield('form')--}}
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/retina-1.1.0.min.js"></script>
<script src="js/scripts.js"></script>
{{--<script src="js/app.js"></script>--}}


<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>