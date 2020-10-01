@extends('layouts.hello')

@section('content')
    <div class="container-fluid" style="background-color: rgb(67, 83, 167, 0.82);">
        <div class="row" style="padding: 10px;">
            <div class="col-2">
                <img src="{{ asset('img/st_left.svg') }}" alt="" style="width: 100%; ">
            </div>

            <div class="col-5 mt-4 position-relative" style="left: 25px; top: 5px;">
                <h1 style="color: white;font-family: 'Roboto'; font-weight: 500; font-size: 62px;">Welcome Student !</h1>
                <div class="d-flex justify-content-center">
                    <p style="display:block; color: white; font-family: 'Rochester'; font-size: 30px;">
                        “work <span class="word">HARD</span>, dream <span class="word">BIG</span>, never <span class="word">GIVE UP</span>”
                    </p>
                </div>
            </div>
            
            <div class="col-5" style="">
                <img src="{{ asset('img/st_right.svg') }}" alt="" style="width: 100%;">
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3 pb-3">
        <div class="container"  style="background-color: white; box-shadow: 4px 4px 10px 0px rgb(0, 0, 0, 0.25);">

            <div class="row" style="background-color: #E2F3F5;">

                <div class="col-2 m-1 rounded" style="background-color: #0E153A; color: white;">

                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <h1 style="font-family: 'Roboto'; border-bottom: white 1px solid;">Menu</h1>
                    </div>

                    <div class="d-flex justify-content-center">
                        <ul class="nav flex-column">
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                                <a class="nav-link pl-2 menu-item active" href="{{ route('student.dashboard') }}"><mark style="background-color: #6371B5; color: white; border-radius: 10px;">Dashboard</mark></a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/profile.svg') }}" alt="Profile">
                                <a class="nav-link pl-2 menu-item" href="/profile/student">Profile</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/courses.svg') }}" alt="Courses">
                                <a class="nav-link pl-2 menu-item" href="{{ route('student.courses') }}">Courses</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/exams.svg') }}" alt="Exams">
                                <a class="nav-link pl-2 menu-item" href="{{ route('student.show_exams_todo') }}">Exams</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/tps.svg') }}" alt="TP">
                                <a class="nav-link pl-2 menu-item" href="{{ route('student.show_exams_todo') }}">TP</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/setting.svg') }}" alt="Settings">
                                <a class="nav-link pl-2 menu-item" href="/profile/settings/student">Settings</a>
                            </li>   
                        </ul>
                    </div>

                    <div>
                        <a class="nav-link position-relative" href="{{ route('logout') }}" 
                            style="left: 120px;"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        >
                            <img class="logo" src="{{ asset('img/dashboard/logout.svg') }}" alt="Logout">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>
                    </div>
                </div>

                <div class="col">
                    <div class="row pt-4 pb-4 justify-content-center">

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g0.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $cr }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Registered<br>Courses</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pl-2 pr-2 pb-3 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g1.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $tp }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Tps<br>Solved</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g2.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $ex }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Exams<br>Solved</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4 pb-4 justify-content-center">

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g3.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">0</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Qst<br>Asked</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <!--<img class="element_img" src="{{ asset('img/dashboard/') }}" alt="">-->
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb"></span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title"><br></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <!--<img class="element_img" src="{{ asset('img/dashboard/') }}" alt="">-->
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb"></span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title"><br></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection