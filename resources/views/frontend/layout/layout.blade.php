 <!DOCTYPE html>
<html dir="ltr" lang="en-US" @yield('htmlschema') >
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'The Grace Company')</title>
    <meta name="author" content="The Grace Company" />
    <meta name="google-site-verification" content="KCTPTzqd2ZvRyjrpaoReKAdp6b_b5aN1c_dOzG12uLw" />

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/bootstrap.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/style.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/swiper.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/dark.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/font-icons.css') !!}" type="text/css" />
     <link rel="stylesheet" href="{!! asset('/frontend/css/font-awesome.min.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/animate.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/frontend/css/magnific-popup.css') !!}" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{!! asset('/frontend/custom-css/big-table.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/frontend/custom-css/block.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/frontend/custom-css/custom.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/frontend/custom-css/header.css') !!}">



    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
@yield('header_styles')
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="stylesheet" type="text/css" href="{!! asset('/frontend/important.css') !!}">
    <link rel="stylesheet" href="{!! asset('/frontend/css/responsive.css') !!}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

   <script type="text/javascript" src="{!! asset('/frontend/js/jquery.js') !!}"></script>

     <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', '{!! $settings['ga_code']  or 'UA-78414244-1' !!}', 'auto');
          ga('create', 'UA-78414244-2', 'auto', {'name': 'devTracker'});
          ga('require', 'ec');
            ga('require', 'displayfeatures');
            ga('require', 'linkid');
@yield('inline-ga-func')
@yield('inline-ga-pi')
@yield('inline-ga-atc')
@yield('inline-ga-action')
          ga('send', 'pageview');
          ga('devTracker.send', 'pageview');
    </script>
@yield('scripts')
@yield('pp_header_scripts')
</head>
<body class=" @yield('bodytag') stretched" @yield('bodyschema')>
    <div id="wrapper" class="clearfix">
    <!-- Header ============================================= -->
@include('frontend/layout/partials/header/top-bar')
@include('frontend/layout/partials/header/header')
@yield('submenu')
@yield('slider')
@yield('intro')
@yield('page-title')

@yield('sidebar')
        <!-- Content
        ============================================= -->
@yield('content')
        <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark">
            <div class="container">
@include('frontend.layout.partials.footer.footer-widgets')
            </div>
            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">
@include('frontend.layout.partials.footer.copyr')
            </div><!-- #copyrights end -->
        </footer><!-- #footer end -->
    </div><!-- #wrapper end -->
    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
    <!-- External JavaScripts
    ============================================= -->


@include('debug')

@yield('plugins')
  {{-- <script type="text/javascript" src="{!! asset('/frontend/js/plugins.js') !!}"></script> --}}




<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.bootstrap.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.swiper.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.tabs.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.isotope.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.equalheights.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.parallax.js') !!}"></script>




<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.form.js') !!}"></script>


<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.fitvids.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.magnific.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.validation.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.youtube.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.paginate.js') !!}"></script>


<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.chart.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.color.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.cookie.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.countdown.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.countto.js') !!}"></script>

<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.dribbble.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.flexslider.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.flickrfeed.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.infinitescroll.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.instagram.js') !!}"></script>


<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.owlcarousel.js') !!}"></script>

<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.piechart.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.superfish.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.textrotator.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.toastr.js') !!}"></script>
<script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.twitterfeed.js') !!}"></script>


{{-- <script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.important.js') !!}"></script> --}}
<!-- {{-- <script type="text/javascript" src="{!! asset('frontend/js/plugins/jquery.pagetransition.js') !!}"></script> --}} -->




@yield('footer_scripts')
    <!-- Footer Scripts ============================================= -->
    <script type="text/javascript" src="{!! asset('/frontend/js/functions.js') !!}"></script>

@yield('pp_footer_scripts')
@yield('inlinejs')

</body>
</html>
