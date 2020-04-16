<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'หน้าหลัก') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--link href="{{ asset('css/eiei.css') }}" rel="stylesheet"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        h1, h2, h3, h4, h5, h6, nav, .nav, .menu, button, .button, .btn, .price, ._heading, .wp-block-pullquote blockquote, blockquote, label, legend, a, .card-header, th {
            font-family: "Prompt", "Open Sans script=all rev=1" !important;
            font-weight: 700 !important;
            
        }

    </style>
        
</head>
<body>
    <div id="">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-image: linear-gradient(270deg, #2af598 0%, #009efd 100%);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/img/logo-berthongpol.png')}}" width="60" height="60" class="mr-2" alt="">
                    {{ config('app.name', 'หน้าหลัก') }}
                </a>
                <a class="navbar-brand" href="#">
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->                        
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.berthongpol.com">หน้าหลัก<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/number') }}">ค้นหาเบอร์<span class="sr-only">(current)</span></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/forecast') }}">ทำนายเบอร์<span class="sr-only">(current)</span></a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.berthongpol.com/knowledge">บทความ<span class="sr-only">(current)</span></a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">ติดต่อเรา<span class="sr-only">(current)</span></a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('สมัครสมาชิก') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @switch(Auth::user()->role)
                                        @case("guest")
                                            <i class="fa fa-user mr-2"></i> 
                                            <span title="{{Auth::user()->name}} ({{Auth::user()->role}})">{{Auth::user()->name}} </sapn>
                                            @break
                                        @case("admin")
                                            <i class="fa fa-archive mr-2"></i> 
                                            <span title="{{Auth::user()->name}} ({{Auth::user()->role}})">{{Auth::user()->name}} </sapn>
                                            @break
                                    @endswitch  
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ url('/address') }}" >
                                        <i class="fa fa-address-card mr-2"></i> ตั้งค่าที่อยู่
                                    </a>
                                    @if(Auth::user()->role == "admin")
                                    <a class="dropdown-item" href="{{ url('/bank') }}" >
                                        <i class="fa fa-bank mr-2"></i> ตั้งค่าธนาคาร (for Admin)
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ url('/order') }}" >
                                        <i class="fa fa-shopping-cart mr-2"></i> การสั่งซื้อ
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/payment') }}" >
                                        <i class="fa fa-credit-card mr-2"></i> ประวัติการสั่งซื้อ
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out mr-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
