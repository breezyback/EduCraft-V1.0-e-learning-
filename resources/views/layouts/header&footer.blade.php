<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Educraft</title>
        <link rel="shortcut icon" href="img/favicon.ico">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rochester&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <link href="css/dashboard.css" rel="stylesheet" type="text/css">
        <link href="css/welcome.css" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script src="js/app.js"></script>
        
        <style>
            /*@font-face {
                font-family: "Rochester-Regular";
                src: url(fonts/Rochester/Rochester-Regular.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Bold";
                src: url(fonts/Roboto/Roboto-Bold.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Medium";
                src: url(fonts/Roboto/Roboto-Medium.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Light";
                src: url(fonts/Roboto/Roboto-Light.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Regular";
                src: url(fonts/Roboto/Roboto-Regulat.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Black";
                src: url(fonts/Roboto/Roboto-Black.ttf) format("truetype");
            }
            @font-face {
                font-family: "Roboto-Thin";
                src: url(fonts/Roboto/Roboto-Thin.ttf) format("truetype");
            }*/
            .bttc {
                background-color: rgb(67, 83, 167, 0.82);
                color: white;
                border-radius: 8px;
                padding: 8px;
                margin: auto 2px;
                text-align: center;
            }
            .p {
                position: relative;
            }
            .p h1 a:hover {
                text-decoration: none;
            }
            .p h1 a {
                font-family: 'Roboto';
                font-weight: 500;
                color: #0E153A;
                text-shadow: 0px 4px 4px rgb(0, 0, 0, 0.25);
            }
            .grid-container {
                display: grid;
                grid-template-columns: auto auto auto auto auto auto auto auto auto auto auto auto;
                grid-column-gap: 50px;
                text-align: center;
                width: 100%;
                position: sticky;
                top: 0;
                z-index: 1;
                box-shadow: 0px 0px 4px rgb(67, 83, 167, 0.82);
            }
            .grid-item {
                margin-top: 5px;
            }
            .item1 {
                grid-column-start: 4;
                margin-top: 10px;

            }
            .item2 {
                grid-column-start: 6;
                grid-column-end: 7;
            }
            .item3 {
                grid-column-start: 9;
                margin-top: 10px;
            }
            .item1 div a {
                color: #282E69;
            }
            .item1 form input {
                border-radius: 15px;
                background-color: rgb(255, 218, 218, 0.23);
                border-color: #616EB6;
                color: #616EB6;
            }
            .item1 form button {
                margin-left: -5px;
                border-radius: 15px;
                background-color: #0E153A;
                border-color: #0E153A;

            }
            /*.fullheight {
                min-height: 100vh;

            }
            .grid-container2 {
                display: grid;
                grid-template-columns: 10% 10% 10% 10% 10% 10% 10% 10% 10% 10%;
                grid-template-rows: 20% 20% 20% 20% 20%;

                height: 100vh;
            }
            .grid-item2 {
                grid-column-start: 1;
                grid-column-end: 5;
                grid-row-start: 2;
                grid-row-end: ;
                position: relative;
                top: 30px;
            }
            .item2-1 {
                font-size: 3.5em;
                color: #282E69;
                font-family: ;
                font-weight: bold;
                margin-bottom: 30px;
            }
            .item2-2 {
                font-size: 1.5em;
                position: relative;
                left: -10px;
            }
            .item2-3 {
                width: 150px;
                font-size: 1.5em;
            }
            .grid-item3 {
                grid-column-start: 5;
                grid-column-end: 11;
                grid-row-start: 1;
                grid-row-end: 6;
            }
            .item3-1 {
                margin-top: 30px;
                width: 100%;
                height: 100%;
            }
            .grid-item4 {
                grid-column-start: 3;
                grid-row-start: 5;
            }
            .grid-item-img {
                grid-column-start: 1;
                grid-column-end: 6;
                grid-row-start: 1;
                grid-row-end: 6;
            }
            .all {
                background-image: linear-gradient(#C7C7EC, rgb(148, 147, 209, 0));
            }
            .grid-it {
                grid-column-start: 6;
                grid-column-end: 11;
                grid-row-start: 2;
                grid-row-end: ;
                position: relative;
                top: 30px;
            }*/
            /*footer {
                min-height: 25vh;
                background-color: #0E153A;
            }*/
            /*.word {
                color: #0E153A;
                font-weight: 700;
                font-family: 'Roboto';
                font-size: 20px;
            }
            .logo {
                width: 20px;
                height: 20px;
            }
            .menu-item {
                font-weight:;
                font-size: 18px;
                color: white;
            }
            .quotes {
                color: white;
                font-family: 'Rochester';
                font-size: 30px;
            }
            .hov:hover {
                color: #0E153A;
            }*/
        </style>
    </head>
    <body>
        <header class="grid-container" style="background-color: #E2F3F5;">
            <div class="grid-item item1">
                <div class="dropdown show d-inline-block my-auto">
                    <a class="btn  dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Catégories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <form class="form-inline d-inline-block" action="/" method="GET">
                    <input class="form-control mr-sm-2 design" type="search" placeholder="Search" aria-label="Search">
                    <!--<button class="btn btn-primary my-2 my-sm-0 btn-sm" type="submit">Search</button>-->
                </form>
            </div>
            <div class="p grid-item item2">
                <h1><a href="{{ url('/') }}">EduCraft</a></h1>
            </div>

            <nav class="grid-item item3">
                <a class="btn bttc btn-sm" href="{{ url('/about') }}">About</a>
                <a class="btn bttc btn-sm" href="{{ route('register') }}">Register</a>
                <a class="btn bttc btn-sm" href="{{ route('login') }}">Login</a>
            </nav>
        </header>

            @yield('content')

        <footer>
            <p>this is the FOOTER</p>
        </footer>
    </body>
</html>
