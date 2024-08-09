<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {!! SEOMeta::generate() !!}

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('image/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('image/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('image/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('image/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('image/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('image/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('image/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('image/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('image/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('image/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('image/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('image/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('image/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('image/favicon//manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="{{asset('css/vendors/bootstrap.css')}}" rel="stylesheet">
    <style>
        .working-process-item:nth-child(odd)::before {
            position: absolute;
            top: 100%;
            right: 94px;
            width: 315px;
            height: 64px;
            background-image: url({{asset('images/shape-for-odd.png')}});
            content: "";
        }
        .working-process-item:nth-child(even)::before {
            position: absolute;
            top: 100%;
            right: 94px;
            width: 315px;
            height: 64px;
            background-image: url({{asset('images/shape-for-even.png')}});
            content: "";
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawsome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawsome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="{{asset('css/main.css')}}?version=1" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.10.3/simple-lightbox.min.css" integrity="sha512-Ne9/ZPNVK3w3pBBX6xE86bNG295dJl4CHttrCp3WmxO+8NQ2Vn8FltNr6UsysA1vm7NE6hfCszbXe3D6FUNFsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <script>
        const BASE_URL = '{{url()->to('/')}}/';
        const CSRF_TOKEN = '{{csrf_token()}}';
        const SITE_LANG = '{{app()->getLocale()}}';
    </script>

    @stack('scrips.head.bottom')
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<!-- Preloader -->

<!-- header part start -->
<div id="header-fixed-height"></div>
<header class="header-area-one" id="sticky-header">
    <nav class="navbar navbar-expand-lg d-none d-lg-block">
        <div class="container-fluid">
            <a class="navbar-brand me-0" href="/">
{{--                <img src="{{asset('images/logo.png')}}" alt="logo">--}}
                <h3>FIRMA WIELOBRANŻOWA <br> DANIEL WAJDA</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                @include('default.nav_item.main', ['name' => 'main'])
                <div class="header-right-info d-flex align-items-center">
                    <div class="social">
                        <ul class="list-unstyled">
                            <li><a href="{{getConstField('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div>
                    <div class="help-number d-flex align-items-center">
                        <div class="icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info">
                            <p>Zadzwoń do nas</p>
                            <h6>
                                <a href="tel:{{str_replace(' ', '', getConstField('phone'))}}">
                                    {{getConstField('phone')}}
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- mobile navbar part start -->
    <div class="mobile-menu-area d-block d-lg-none">
        <div class="mobile-topbar">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
{{--                        <img src="{{asset('images/logo.png')}}" alt="logo">--}}
                        <h3>FIRMA WIELOBRANŻOWA <br> DANIEL WAJDA</h3>
                    </div>
                    <div class="bars">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay"></div>
        <div class="mobile-menu-main">
            <div class="logo">
                <a href="/">
{{--                    <img src="{{asset('images/logo.png')}}" alt="logo">--}}
                    <h3>FIRMA WIELOBRANŻOWA <br> DANIEL WAJDA</h3>
                </a>
            </div>
            <div class="close-mobile-menu"><i class="fas fa-times"></i></div>
            <div class="menu-body">
                <div class="menu-list">
                    @include('default.nav_item.main', ['name' => 'main'])
                </div>
            </div>
            <div class="social-icon">
                <ul class="list-unstyled">
                    <li><a href="{{getConstField('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- mobile navbar part end -->
</header>
<!-- header part end -->

<!-- main area part start -->
<main>
    {{--@include('default._helpers.lang_nav')--}}

    @yield('content')

</main>
<!-- main area part end -->

<!-- scroll top part start -->
<button class="scroll-to-top">
    <i class="fas fa-angle-up"></i>
</button>
<!-- scroll top part end -->

<!-- footer part start -->
<footer class="footer-area-one">
    <div class="footer-area-one-bg">
        <div class="container">
            <div class="footer-top-one">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="/">
{{--                                    <img src="{{asset('images/logo.png')}}" alt="white-logo">--}}
                                    <h3 style="color: #fff">FIRMA WIELOBRANŻOWA <br> DANIEL WAJDA</h3>
                                </a>
                            </div>
                            <div class="footer-content">
                                {!! getConstField('company_description') !!}
                                <div class="social">
                                    <ul class="list-unstyled">
                                        <li><a href="{{getConstField('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="footer-widget">
                            <h4 class="footer-title uppercase">FIRMA WIELOBRANŻOWA DANIEL WAJDA:</h4>
                            <div class="footer-address">
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="fas fa-paper-plane"></i>
                                        </div>
                                        <div class="content" style="display: flex; align-items: center">
                                            <p><a href="{{getConstField('google_map')}}">{{getConstField('company_address')}}, {{getConstField('company_post_code')}} {{getConstField('company_city')}}</a></p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="content" style="display: flex; align-items: center">
                                            <a href="mailto:{{getConstField('email')}}">{{getConstField('email')}}</a>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <div class="content" style="display: flex; align-items: center">
                                            <a href="tel:{{str_replace(' ', '', getConstField('phone'))}}">{{getConstField('phone')}}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="copyright">
                            <p style="text-align: center;"><?php echo date("Y") ?> &copy; Wszelkie prawa zastrzeżone. Strona stworzona przez: <a href="https://palmax.com.pl" style="color: #FF6600">Palmax</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="dot" id="dot"></div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.10.3/simple-lightbox.jquery.min.js" integrity="sha512-iJCzEG+s9LeaFYGzCbDInUbnF03KbE1QV1LM983AW5EHLxrWQTQaZvQfAQgLFgfgoyozb1fhzhe/0jjyZPYbmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="{{asset('js/main.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.odometer.min.js')}}"></script>
<script src="{{asset('js/jquery.appear.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@stack('scripts.body.bottom')
</body>
</html>
