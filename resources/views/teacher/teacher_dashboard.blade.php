@extends('layouts.hello')

@section('content')
    <div class="container-fluid" style="background-color: #0E153A">
        <div class="row" style="padding: 10px;">
            <div class="col-2">
                <img src="{{ asset('img/document.svg') }}" alt="" style="width: 100%; ">
            </div>

            <div class="col-7 position-relative" style="left: 25px; top: 5px;">
                <h1 style="color: white;font-family: 'Roboto'; font-weight: 500; font-size: 62px;">Welcome Teacher !</h1>
                <div class="d-flex justify-content-center">
                    <p class="quotes">
                        “to the world you may be just a teacher, but to your student ...”
                    </p>
                </div>
                <div class="d-flex justify-content-center position-relative" style="top: -20px;">
                    <p class="quotes">
                        “you are a <span class="word" style="color: #5F70B5;">HERO !</span>”
                    </p>
                </div> 
            </div>
            
            <div class="col-3" style=" height: 80%;">
                <img src="{{ asset('img/teach.svg') }}" alt="" style="width: 100%;">
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3 pb-3" style="background-color:#E2F3F5;">
        <div class="container" style="background-color: white; box-shadow: 4px 4px 10px 0px rgb(0, 0, 0, 0.25);">

            <div class="row" style="background-color:white;">

                <div class="col-2 m-1 rounded" style="background-color: #4E576B; color: white;">

                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <h1 style="font-family: 'Roboto'; border-bottom: white 1px solid;">Menu</h1>
                    </div>

                    <div class="d-flex justify-content-center">
                        <ul class="nav flex-column">
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                                <a class="nav-link pl-2 menu-item hov active" href="{{ route('teacher.dashboard') }}"><mark style="background-color: #0E153A; color: white; border-radius: 10px;">Dashboard</mark></a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/profile.svg') }}" alt="Profile">
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('profile.show_teacher_profile') }}">Profile</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/courses.svg') }}" alt="Courses">
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('teacher.show_my_courses') }}">Resources</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/exams.svg') }}" alt="Exams">
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('teacher.show_all_exams_solutions') }}">Solutions</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/setting.svg') }}" alt="Settings">
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('profile.show_teacher_profile_settings') }}">Settings</a>
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
                                    <img class="element_img" src="{{ asset('img/dashboard/course.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $cr_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Courses<br>Number</p>
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
                                            <span class="element_nb">{{ $tp_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Tps<br>Number</p>
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
                                            <span class="element_nb">{{ $ex_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Exams<br>Number</p>
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
                                    <img class="element_img" src="{{ asset('img/dashboard/g2.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $res_ex_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Exams<br>Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pl-2 pr-2 pb-3 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g2.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $res_tp_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Tps<br>Solutions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
                                <div class="col-auto p-0 pl-1">
                                    <!--<img class="element_img" src="{{ asset('img/dashboard/g2.svg') }}" alt="">-->
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