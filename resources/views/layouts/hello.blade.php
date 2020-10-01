<!DOCTYPE html>
<html id="top" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth; max-width: 100%;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Educraft</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

        <!-- Fonts -->
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" type="text/css">
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
        <!--<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">-->
        <!--<link href="https://fonts.googleapis.com/css2?family=Rochester&display=swap" rel="stylesheet">-->

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/cour_details.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/create.css') }}" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/Add.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>

        <style>
            .element {
                background-color: white;
                border-radius: 10px;
            }
            .element:hover {
                background-color: #BFC0E2;
            }
        </style>

    </head>
    <body style="max-width: 100%; overflow-x: hidden;">

        <script>

            function show_hint(str) {
                if (str != '') {
                    var url = "/search/course?str=" + str;
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(request.responseText);
                            var sc = document.getElementById("search");
                            var br = document.getElementById("br");
                            if (sc != null && br != null) {
                                undo_search('search');
                                undo_search('br');
                            }
                            var parent_tag = document.getElementById("dropdown_menu");
                            for (var i = 0; i < data.result.length; i++) {
                                var list_search = document.createElement("div");
                                list_search.setAttribute("id", "search");
                                list_search.classList.add("dropdown_item");
                                list_search.classList.add("ml-2");

                                var tag = document.createElement("a");
                                tag.classList.add("dropdown_item");
                                tag.setAttribute("href", "/course/" + data.result[i].id);
                                tag.setAttribute("style", "text-decoration: none; color: #0E153A; font: 500 1.2vw 'Roboto';");

                                var text = document.createTextNode(data.result[i].name);

                                var brk = document.createElement("br");
                                brk.setAttribute("id", "br");

                                tag.appendChild(text);
                                list_search.appendChild(tag);
                                parent_tag.appendChild(list_search);
                                parent_tag.appendChild(brk);
                            }
                            $('.dropdown-toggle').dropdown('toggle');
                        }
                    };
                    request.open("GET", url);
                    request.send();
                    
                } else if (str === '') {
                    $('.form-control').dropdown('toggle');
                    var sc = document.getElementById("search");
                    var br = document.getElementById("br");
                    if (sc != null && br != null) {
                        undo_search('search');
                        undo_search('br');
                    }
                }
            }

            function undo_search(tag_id) {
                var tag = document.getElementById(tag_id);
                tag.remove();
            }

        </script>

        <header class="container-fluid">
            <div class="row align-items-center">
                <div class="col-1">
                </div>

                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="d-inline-block">
                        <a class="categ dropdown-toggle btn-sm mr-1 rounded-pill text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Catégories
                        </a>
                        <div class="dropdown-menu pt-0 mt-0 pb-0" aria-labelledby="dropdownMenuLink">
                        <?php
                            $i = 0;
                            foreach($categories1 as $categorie1) {
                                echo "<hr class='mt-0 mb-0' style='background-color: #0E153A;'>\n<h5 class='display-5 pl-2 pr-2 pt-2 pb-2 mb-0' style='background-color: #0E153A; color: white;'><span>Category: $categorie1->name</h5><hr class='mt-0 mb-0' style='background-color: #0E153A;'>";
                                echo "<div class='pt-2 pl-1 pr-1 pb-1' style=\"background-color: #E2F3F5; color: #0E153A;\">";
                                echo "<span class='pl-1' style=\"font: 700 1.3vw 'Roboto';\">Formations</span>";
                                while($i < $formations1) {

                                    foreach($formations1[$i] as $key => $formation1) {
                                        $key += 1;
                                        echo "<a class='dropdown-item mb-1 element' href='/formation/$formation1->id'>$key/ $formation1->name</a>";
                                    }

                                    $i++;
                                    break;
                                }
                                echo "</div>";
                            }
                        ?>
                        </div>
                    </div>  
                    <div class="d-inline-block">
                        <form class="form-inline" action="/" method="GET">
                            <div id="my" class="dropdown">
                                <input id="dropdownMenuSearch" class="form-control mr-sm-2 rounded-pill dropdown-toggle" data-toggle="dropdown" type="search" placeholder="Search Course" aria-label="Search" onkeyup="show_hint(this.value, this.id);" onclick="" style="width: 18vw;">
                                <div id="dropdown_menu" class="dropdown-menu" aria-labelledby="dropdownMenuSearch">
                                </div>
                            </div>
                    </form>
                    </div>
                            
                </div>

                <div class="col-4 mt-2 d-flex justify-content-center">
                    <h1><a href="{{ url('/') }}" class="text-decoration-none title">EduCraft</a></h1>
                </div>

                
                @if((Auth::guard('admin')->check()) or (Auth::guard('teacher')->check()) or (Auth::guard()->check()))
                <div class="col text-right pr-0">
                    @if(Auth::guard()->check())
                        <div class="d-inline-block">
                            <a class="btn btn-set rounded-pill" href="{{ route('student.dashboard') }}">
                                <img src="{{ asset('img/home0.svg') }}" alt="Home" style="width: 1.5vw;">
                            </a>
                        </div>
                    @elseif(Auth::guard('teacher')->check())
                        <div class="d-inline-block">
                            <a class="btn btn-set rounded-pill" href="{{ route('teacher.dashboard') }}">
                                <img src="{{ asset('img/home0.svg') }}" alt="Home" style="width: 1.5vw;">
                            </a>
                        </div>
                    @elseif(Auth::guard('admin')->check())
                        <div class="d-inline-block">
                            <a class="btn btn-set rounded-pill" href="{{ route('admin.dashboard') }}">
                                <img src="{{ asset('img/home0.svg') }}" alt="Home" style="width: 1.5vw;">
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col d-flex justify-content-center">
                    <a class="btn btn-set rounded-pill" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @else
                <div class="col d-flex justify-content-center">
                    <a class="btn btn-set rounded-pill" href="{{ url('/about') }}">About</a>
                    <a class="btn btn-set ml-1 rounded-pill" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-set ml-1 rounded-pill" href="{{ route('register') }}">Register</a>
                </div>
                @endif
                
                <div class="col-1">
                </div>
            </div>
        </header>

            @yield('content')
        
        <footer class="container-fluid">
            <div class="container pt-4 pb-3" style="color: white;">
                <div class="row mb-4">
                    <div class="col-9">
                        <h1 class="mb-4" style="font: 700 3vw 'Roboto';">EduCraft</h2>
                        <p class="ml-3" style="font: 500 1.2vw 'Roboto';">Created By <span class="ml-4" style="font: 900 1.6vw 'Roboto';">Imad Eddine KETTAF</span></p>
                    </div>
                    <div class="col-2 pt-3">
                        <div class="row mb-4">
                            <div class="col">
                                <p class="m-0" style="font: 700 2vw 'Roboto';">CONTACT</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="mailto:imedkettaf@gmail.com" style="color: white;">imedkettaf@gmail.com</a>
                            </div>
                        </div>
                        <hr style="background-color: white;">
                        <div class="row">
                            <div class="col">
                                <p class="m-0">City 326 logts Bt E3</p>
                                <p class="m-0">n° 254.</p>
                                <p class="m-0">Setif, Algeria</p>
                                <p class="m-0">19000.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="background-color: white;">
                <div class="row text-center">
                    <div class="col">
                        <h5 class="m-0">Copyright &#169 EduCraft 2020. All rights reserved</h3>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>