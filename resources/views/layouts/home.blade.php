<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Hozana Game') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('static/e95a5d022b2306f4c811.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/keen-slider@latest/keen-slider.min.css"/>
</head>
<style>
    @media screen and (max-width: 600px) {
        /* For mobile phones: */
        #cardAnimation-whiteCard0 {
            display: none;
        }

        #cardAnimation-whiteCard1 {
            top: -60px ! important;
            left: 180px ! important;
        }
    }

    p {
        font-size: 18px ! important;
    }

</style>
<body>
<div>
    <a name="maincontent" class="db pf top left z10 skip-to-content button--black-white button--small"
       href="#maincontent">Skip to main content</a>
    <div class="pf fill z2 theme--night hide--lg ofy--scroll" id="menu-dropdown" style="transform: translateY(0%) translateZ(0px); display: none;">
        <div class="header__ribbon"></div>
        <div class="p3 pt4 p8--md pt6--md">
            <div class="mb3">
                <h3 class="fw--800 fs--24 fs--32--md mb2">
                    <a href="/games">Nos Jeux</a>
                </h3>
                <ul>
                    <li class="fw--800 fs--48 fs--40--md mt1 ls--small">
                        <a class="link--underline--hover--lg" title="Hozana Quiz" href="/game/quiz" style="font-size: 40px;">Hozana Quiz</a>
                    </li>
                    <li class="fw--800 fs--48 fs--40--md mt1 ls--small">
                        <a class="link--underline--hover--lg" title="Hozana Mime" href="/game/mime" style="font-size: 40px;">Hozana Mime</a>
                    </li>
                    <li class="fw--800 fs--48 fs--40--md mt1 ls--small">
                        <a class="link--underline--hover--lg" title="Hozana Worship" href="/game/worship" style="font-size: 40px;">Hozana Worship</a>
                    </li>
                </ul>
            </div>
            <div class="mb3">
                <h3 class="fw--800 fs--24 fs--32--md mb2">
                    <a href="/about">À Propos</a>
                </h3>
            </div>
            <ul class="df fdr mt4">
                <li class="mr1"><a _key="9ecfbf80c073" class="fs--12 fw--800" title="Facebook" target="_blank"
                                   rel="noopener noreferrer" href="#"><img
                            src="{{asset('images/icon-facebook-invert.svg')}}" class="db link--opacity" alt="facebook logo"></a>
                </li>
                <li class="mr1"><a _key="0be763c4f580" class="fs--12 fw--800" title="Instagram" target="_blank"
                                   rel="noopener noreferrer" href="#"><img
                            src="{{asset('images/icon-instagram-invert.svg')}}" class="db link--opacity" alt="instagram logo"></a>
                </li>
                <li class="mr1"><a _key="7c7591d4c173" class="fs--12 fw--800" title="Twitter" target="_blank"
                                   rel="noopener noreferrer" href="#"><img
                            src="{{asset('images/icon-twitter-invert.svg')}}" class="db link--opacity" alt="twitter logo"></a></li>
            </ul>
        </div>
    </div>
    <header class="pf top left right z4 theme--night header__dropdown-fill" style="transform: none;">
        <div class="push-up">
            <div class="header__ribbon df fdc jcc aic bg--black">
                <div class="x">
                    <div class="pl1 pr1 pl3--md pr3--md">
                        <div class="df fdr jcb aic">
                            <button class="db hide--md ml1 icon--takeover-button">
                                <svg class="icon--takeover db" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <rect class="icon--takeover--first" y="3" width="22" height="2"
                                          fill="currentColor"></rect>
                                    <rect class="icon--takeover--middle" y="10" width="22" height="2"
                                          fill="currentColor"></rect>
                                    <rect class="icon--takeover--last" y="17" width="22" height="2"
                                          fill="currentColor"></rect>
                                </svg>
                            </button>
                            <a class="link--opacity db" href="/">
                                <img class="db header__logo" src="{{asset('images/logo-hozana-game.svg')}}"
                                     alt="Hozana Game logo" style="width: 100px"></a>
                            </a>
                            <div class="df fdr aic">
                                <button class="db mr4 show--lg" aria-expanded="false">
                                    <div class="x df fdr jcb aic">
                                        <div title="Shop" class="fw--800 fs--28">
                                            <a href="/games">Nos jeux</a>
                                        </div>
                                    </div>
                                </button>
                                <button class="db mr4 show--lg" aria-expanded="false">
                                    <div class="x df fdr jcb aic">
                                        <div title="About" class="fw--800 fs--28">
                                            <a href="/about">À Propos</a>
                                        </div>
                                    </div>
                                </button>
                                <button class="db show--md hide--lg ml2">
                                    <svg class="icon--takeover db" width="22" height="22" viewBox="0 0 22 22"
                                         fill="none">
                                        <rect class="icon--takeover--first" y="3" width="22" height="2"
                                              fill="currentColor"></rect>
                                        <rect class="icon--takeover--middle" y="10" width="22" height="2"
                                              fill="currentColor"></rect>
                                        <rect class="icon--takeover--last" y="17" width="22" height="2"
                                              fill="currentColor"></rect>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pr">
            <div class="pa top left right"></div>
        </div>
        <div class="pr push-up hide--lg">
            <div class="pa top left right">
                <hr>
            </div>
        </div>
        <hr class="show--lg">
    </header>
    <div class="header__ribbon"></div>
    <div id="mainContent">
        @yield('content')
    </div>
</div>
</body>
<script type="text/javascript" src="{{ asset('static/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/anime.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/keen-slider@latest/keen-slider.js"></script>
<script>
    $(document).ready(function () {
        $('.accordeon--button').click(function () {
            let svgChild = $(this).children('svg');
            if ($(svgChild[0]).hasClass('active')) {
                $(svgChild[0]).removeClass('active');
                $(this).attr("aria-expanded", "false");
                $(this).closest("div").children('.of--hidden').animate({height: '0'}, 300);
            } else {
                $(svgChild[0]).addClass('active');
                $(this).attr("aria-expanded", "true");
                let sizeHeight = '122px'
                if ($(this).closest("div").children('.of--hidden').attr('sizeHeight') === 'full') {
                    sizeHeight = '280px'
                }
                if ($(this).closest("div").children('.of--hidden').attr('sizeHeight') === 'medium') {
                    sizeHeight = '200px'
                }
                $(this).closest("div").children('.of--hidden').animate({height: sizeHeight}, 300);
            }
            if ($(svgChild[1]).hasClass('active')) {
                $(svgChild[1]).removeClass('active');
            } else {
                $(svgChild[1]).addClass('active');
            }
        });

        $('.icon--takeover-button').click(function() {
            if($(this).hasClass('isOpen')) {
                $(this).removeClass('isOpen');
                $('#menu-dropdown').fadeOut();
            } else {
                $(this).addClass('isOpen');
                $('#menu-dropdown').fadeIn();
            }

        });
    });
</script>
</html>
