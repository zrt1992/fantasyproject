<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>


    <link rel="shortcut icon" href="../img/gamithon-fevi.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    @yield('meta-keywords')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('facbook-og-tags')
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
     {!! Html::style('assets-new/css/google-fonts.css', array('async' => 'async')) !!}
    {!! Html::style('assets-new/css/google-fonts1.css') !!}
    {!! Html::style('assets-new/vendor/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('bootstrap-modal-extend/css/bootstrap-modal.css') !!}

    {!! Html::style('assets-new/css/bootstrap-tour.css') !!}
    {!! Html::style('assets-new/css/jquery.mCustomScrollbar.css') !!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Raleway') !!}
    {!! Html::style('assets-new/vendor/font-awesome/css/font-awesome.min.css') !!}

    {!! Html::style('js/toaster/jquery.toast.css') !!}
    {!! Html::style('js/colorbox-master/example1/colorbox.css') !!}
    {!! Html::style('assets-new/vendor/basic-table/basictable.css') !!}
    {!! Html::style('assets-new/vendor/magnific-popup/magnific-popup.css') !!}
    {!! Html::style('assets/css/slicknav.css', array('async' => 'async')) !!}
    {!! Html::style('assets-new/css/creative.css') !!}
    {!! Html::style('assets-new/css/style.css') !!}
    {!! Html::style('assets-new/css/fixtures.css') !!}

    @yield('css')
    <style>
        .slick_nav li {
            list-style: none;
            overflow: hidden;
            padding: 0;
            margin: 0 0 0 0;

        }

        .p0 {
            padding-left: 0;

        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-98453424-1', 'auto');
        ga('send', 'pageview');
    </script>
    <style>
        li.new-arrival > a::after {
            content: "New !!!";
            background-color: #cc0000;
            padding: 0 3px;
            color: #fff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            font-size: 10px;
            position: absolute;
            top: -6px;
            right: 14px;
            width: 50px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>

<body>
@yield('facebook-share-div-code')
@yield('FbJsSdk')
<nav class="bg-primary navbar navbar-default navbar-fixed-top">
    <!--Menu-->

    <div class="container-fluid">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header main-top-menu">
                <a class="navbar-brand logo-site page-scroll" href="/">
                    <img src="{{URL::to('assets-new/img/gamithon-logo2.png')}}" style="width: 250px;"/>
                </a>
                <div class="text-left" id="signhide" style="padding-left: 10px;">
                    @if(Auth::check())

                        <a href="{{route('userdashboard')}}" style="color: #ffffff;"> <i style="color: #F9970E"
                                                                                         class="fa fa-tachometer sign-in-icon"
                                                                                         aria-hidden="true"></i>
                            My Account</a>
                    @endif
                    @if(!Auth::check())

                        <a href="{{route('login')}}" style="color: #ffffff;"> <i class="fa fa-sign-in sign-in-icon"
                                                                                 aria-hidden="true"></i>
                            Sign In</a>
                    @endif
                    @if(Auth::check())

                        <a onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" href="javacript:void(0)"
                           style="color: #ffffff;">
                            <i class="fa fa-sign-out sign-in-icon" aria-hidden="true"></i>
                            Logout
                        </a>

                    @endif
                </div>

                <div id="top-menu-res" class="jquerySlickNavContainer"></div>
                <div class="clear clearfix"></div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->


            <div class="collapse navbar-collapse logo-menu-container" id="bs-example-navbar-collapse-1">


                <div class="row">

                    <ul class="nav navbar-nav navbar-left nav-main-menu nav-main-menu-top" style="top:0;right: 0;">
                        @if(Auth::check())
                            <li class="menupadding">
                                <a href="{{route('userdashboard')}}"> <i style="color: #F9970E"
                                                                         class="fa fa-tachometer sign-in-icon"
                                                                         aria-hidden="true"></i>
                                    My Account</a>
                            </li>
                        @endif
                        @if(!Auth::check())
                            <li class="menupadding">
                                <a href="{{route('login')}}"> <i class="fa fa-sign-in sign-in-icon"
                                                                 aria-hidden="true"></i>
                                    Sign In</a>
                            </li>
                        @endif
                        @if(Auth::check())
                            <li class="menupadding">
                                <a onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" href="javacript:void(0)">
                                    <i class="fa fa-sign-out sign-in-icon" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!--Bottom-->
                    <ul class="nav navbar-nav navbar-right nav-main-menu main-navigation-menu">
                        <li>
                            <a class="page-scroll" href="/">Home</a>
                        </li>

                        <li>
                            <a class="page-scroll" href="{{route('howPlay')}}">
                                How to play
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{route('dashboardhome')}}">
                                Leader Boards
                            </a>
                        </li>


                        <li class="has-menu">
                            <a class="page-scroll" href="{{route('showNews')}}">
                                News
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a class="page-scroll" href="{{route('Forums')}}">
                                        Forums
                                    </a>

                                </li>
                                <li>

                                    <a class="page-scroll" href="{{route('showBlog')}}">
                                        Blogs

                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--<li>--}}
                        {{--<a href="{{route('leaderboard')}}">--}}
                        {{--LeaderBoard--}}
                        {{--</a>--}}
                        {{--</li>--}}

                        <li>
                            <a class="page-scroll" href="{{route('usertournamenthome')}}">
                                Create Team
                            </a>
                        </li>


                        @if(Auth::check())
                            <li>
                                <a href="{{route('teamHome')}}" class="page-scroll">
                                    My Team
                                </a>
                            </li>

                        @endif
                        <li class="new-arrival has-menu">
                            <a href="{{route('challenges')}}" class="page-scroll">
                                Challenge a player
                            </a>
                            @if(Auth::check())
                                <ul class="sub-menu">
                                    <li>
                                        <a class="page-scroll" href="{{route('listChalllenges')}}">
                                            My Challenge
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    <!--                            <li>
                                                            <a class="page-scroll" href="{{route('UserDashboard')}}">DashBoard</a>
                                                        </li>-->
                        {{--<li>--}}
                        {{--<a href="{{URL::to('/#portfolio')}}" class="page-scroll">--}}
                        {{--Gallery--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        <li>
                            <a class="page-scroll" href="{{route('contactPage')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->


        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<!---->
@yield('content')


<footer>
    <div class="clear clearfix"></div>

    <form id="logout-form" action="{{Url::to('/logout')}}" method="POST" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="logout" style="display: none;">
    </form>

    <section class="footer">
        <div class="container">
            <div class="row" id="final-footer">
                <div class="col-sm-12 col-md-3 text-left">
                    Copyright © 2017 Gamithon Fantasy.<br>All Rights Reserved
                </div>
                <div class="col-sm-12 col-md-5 text-center">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="page-scroll" href="{{route('aboutus')}}">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{route('TermsCon')}}">
                                Terms & Conditions
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{route('PrivacyPolicy')}}">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{route('contactPage')}}">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-4 text-right">
                    <a href="https://www.facebook.com/gamithonfantasy/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle text-info fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                    </a>
                    <a href="https://twitter.com/Gamithon" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle text-info fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</footer>
<!---->

<!-- jQuery -->
{!! Html::script('assets-new/vendor/jquery/jquery.min.js') !!}

{!! Html::script('assets-new/vendor/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('bootstrap-modal-extend/js/bootstrap-modalmanager.js') !!}
{!! Html::script('bootstrap-modal-extend/js/bootstrap-modal.js') !!}

{!! Html::script('assets-new/vendor/basic-table/jquery.basictable.min.js') !!}
{!! Html::script('assets/js/jquery.slicknav.min.js') !!}
<!-- Plugin JavaScript -->

{!! Html::script('assets-new/js/jquery-easing.js') !!}
{!! Html::script('assets-new/js/scrollreveal.min.js') !!}
{!! Html::script('assets-new/js/bootstrap-tour.js') !!}
{!! Html::script('assets-new/js/jquery.magnific-popup.min.js') !!}
{!! Html::script('assets-new/js/creative.js') !!}
{{--{!! Html::script('assets-new/js/jquery.mCustomScrollbar.min.js') !!}--}}
{{--{!! Html::script('assets-new/js/jquery.mCustomScrollbar.concat.min.js') !!}--}}


<script>
    $(document).ready(function () {
        $('.itemsz').matchHeight();
//        $(window).on('load', function(){
//            $('.content').mCustomScrollbar();
//        });
        $('#bs-example-navbar-collapse-1').slicknav({
            appendTo: '#top-menu-res',
            label: 'Main Menu'
        });
        jQuery(".colorbox").colorbox({
            iframe: true,
            innerWidth: '90%', innerHeight: '70%',
            opacity: 0.3,
            speed: '700'
        });
//        $('.content').mCustomScrollbar({
//            theme:"light-thin",
//            axis:"x"
//        });
    });
</script>
{!! Html::script('assets-new/js/jquery.matchHeight-min.js') !!}
{!! Html::script('assets-new/js/jquery.backstretch.min.js') !!}
{!! Html::script('js/colorbox-master/jquery.colorbox-min.js') !!}
{!! Html::script('js/toaster/jquery.toast.js') !!}
@yield('js')
@yield('addteamjs')
<script>
    $(document).ready(function () {
        $('#memberPopup').modal('show');
    });
</script>
<script>
    function sendEmailtoUser() {
        $("#useremailform").slideToggle();
    }
    $("#senduseremailform").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{route('sendUserEmail')}}',
            data: {
                user_email: $('#userrefferalemail').val(),
                _token: '{{csrf_token()}}'
            },
            beforeSend: function () {
                $("#btnSendRefrelEmail").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                $("#btnSendRefrelEmail").attr('disabled', true);
            },
            success: function (data) {
                if (data.success == true) {
                    setTimeout(function () {
                        $("#useremailform").slideUp();
                        $("#btnSendRefrelEmail").html('Send');
                        $("#referelMsg").slideUp();
                    }, 3000);
                    $("#referelMsg").slideDown();
                    $("#referelMsg").addClass('alert-success');
                    $("#referelMsg").html('Referel has been sent!');
                    $('#userrefferalemail').val('');
                } else {
                    $("#referelMsg").addClass('alert-danger');
                    $("#referelMsg").html('Referel has not been sent!');
                }
                $("#btnSendRefrelEmail").attr('disabled', false);
            }
        });
    });
</script>

</body>
</html>