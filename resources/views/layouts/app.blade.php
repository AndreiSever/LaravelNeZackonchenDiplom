<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script type="text/javascript" src="{{ asset('js/jquery.1.10.2.min.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/gnmenu.js') }}"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.js') }}" defer></script>
    
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/paper-collapse.min.js') }}"></script>
    <!-- <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script> -->
    <script src="{{ asset('js/dropzone.js') }}"></script>  
    <script src="{{ asset('js/customtable.js') }}"></script>  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">    
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    
    <!-- Styles -->        
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
    
    <link rel="stylesheet" href="{{ asset('css/paper-collapse.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"/>
    
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            @if(Auth::user())
            <ul id="menu-ul">
                <li><a href="#" class="icon icon-menu" id="btn-menu"></a></li>
            </ul>
            @endif
            
            <div class="container">               
                @if(Auth::user())
                <div id="sideNav">
                    @if(Auth::user()->roles->first()->name=='admin')
                    <ul>          
                        <li><a href=""><span>Хранение документов</span></a></li>
                        <li><a href="{{route('editGroup')}}"><span>Группы</span></a></li>
                        <li><a href="{{route('editTeacher')}}"><span>Преподаватели</span></a></li>
                        <li><a href="{{route('editAdmins')}}"><span>Администраторы</span></a></li>
                        <li><a href="{{route('login')}}"><span>Все директории</span></a></li>									
                    </ul>	
                    @endif
                    @if(Auth::user()->roles->first()->name=='teacher')
                    <ul>          
                        <li><a href="{{route('login')}}"><span>Дисциплины</span></a></li>
                        <li><a href="{{route('login')}}"><span>Входящие сообщения</span></a></li>
                        <li><a href=""><span>Все директории</span></a></li>								
                    </ul>	
                    @endif
                    @if(Auth::user()->roles->first()->name=='student')
                    <ul>          
                        <li><a href="{{route('discipline')}}"><span>Дисциплины</span></a></li>
                        <li><a href="{{route('message')}}"><span>Входящие сообщения</span></a></li>							
                    </ul>	
                    @endif
                </div>
                @endif	              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links route('login') route('register') -->
                        @if (Auth::guest())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">{{ __('Вход') }}</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('registerStudentShow')}}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name.' '.Auth::user()->secondname.' '.Auth::user()->thirdname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!--route('logout')-->    
                                    <a class="dropdown-item" href="{{route('logout')}}" 
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>

                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="py-4">
            @yield('content')
        </div>
    </div>
</body>
<script>

</script>
</html>
