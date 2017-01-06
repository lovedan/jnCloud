<!DOCTYPE html>
<html lang="zh">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
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
<div id='wx_logo' style='margin:0 auto;display:none;'>
    <img src='{{ URL::asset('asset/images/logo.png') }}'/>
</div>
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
                <div class="col-sm-7 text">
                    <h1>欢迎使用<strong>江南云</strong> 服务</h1>
                    <div class="description text-left">
                        <p class="col-centered">
                            江南云-提供基于百度云，天翼云(正在开发中Y(^_^)Y)的云存储服务，包括图片，音乐，视频，文件的云存储下载服务。
                        </p>
                        <p class="col-centered">
                        <li>提供百度云，天翼云本身不支持的迅雷等工具直接下载的功能。</li>
                        <li>采用用户本地存储TOKEN的方式进行授权，充分保证用户的个人隐私</li>
                        <li>提供图片，音视频等流媒体的直接外链功能，从此站长再也不用费心找图床。</li>
                        </p>
                    </div>
                    <div class="top-big-link">
                        <a class="btn btn-link-1" id="baidu">百度授权</a>
                        {{--href="{{ url('/register') }}" target="_blank"--}}
                        <a class="btn btn-link-2" href="#">天翼授权</a>
                    </div>
                </div>
                @yield('form')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="display: inline-block; width: auto;">
            {{--style="display: inline-block; width: auto;"--}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">获取授权码</h4>

                </div>
                <div class="modal-body">
                    <div class="te">
                        <iframe border=0 frameborder=0 width=700 height=350 marginheight=0 marginwidth=0 scrolling=yes
                                src="https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=uFBSHEwWE6DD94SQx9z77vgG&redirect_uri=oob">
                        </iframe>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{--style="display: inline-block; width: auto;"--}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>

                </div>
                <div class="modal-body">
                    <div class="te">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>


<!-- Javascript -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script src="js/scripts.js"></script>
{{--<script src="js/app.js"></script>--}}


<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>