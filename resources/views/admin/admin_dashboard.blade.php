@extends('layouts.hello')

@section('content')
    <div class="container-fluid" style="background-color: #BFC0E2;">
        <div class="row" style="padding: 10px;">
            <div class="col-2 ml-3 mr-4">
                <img src="{{ asset('img/admin/dashboard/control11.svg') }}" alt="" style="width: 18vw;">
            </div>

            <div class="col-6 mt-3 position-relative" style="left: 25px; top: 5px;">
                <div class="row mb-3">
                    <div class="col">
                        <h1 style="color: #0E153A; font: 500 4.5vw 'Roboto';">Welcome Admin !</h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col text-center">
                        <p style="font: 500 1.8vw 'Roboto';">
                            <span style="font: 500 2vw 'Roboto'; color: #E56880;">“ THANK YOU</span> for keeping, the office up and running with your hard work <span style="font: 500 2vw 'Roboto';">”</span>
                        </p>
                    </div>
                    
                </div>
            </div>
            
            <div class="col mr-3 text-right" style="">
                <img src="{{ asset('img/admin/dashboard/dashboard1.svg') }}" alt="" style="width: 20vw;">
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3 pb-3" style="background-color: #E2F3F5;">
        <div class="container" style="background-color: white; box-shadow: 4px 4px 10px 0px rgb(0, 0, 0, 0.25);">
            <div class="row">

                <div class="col-2 m-1 rounded" style="background-color: #0E153A; color: white;">

                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <h1 style="font-family: 'Roboto'; border-bottom: white 1px solid;">Menu</h1>
                    </div>

                    <div class="d-flex justify-content-center">
                        <ul class="nav flex-column">
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                                <a class="nav-link pl-2 menu-item active text" href="{{ route('admin.dashboard') }}"><mark style="background-color: #5F70B5; color: white; border-radius: 10px;">Dashboard</mark></a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/profile.svg') }}" alt="Profile">
                                <a class="nav-link pl-2 menu-item" href="{{ route('profile.show_admin_profile') }}">Profile</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/courses.svg') }}" alt="Courses">
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_categories_list') }}">Categories</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/exams.svg') }}" alt="Exams">
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_formations_list') }}">Formations</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/exams.svg') }}" alt="Exams">
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_courses_list') }}">Resources</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/tps.svg') }}" alt="TP">
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_admins_list') }}">Accounts</a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/setting.svg') }}" alt="Settings">
                                <a class="nav-link pl-2 menu-item" href="{{ route('profile.show_admin_profile_settings') }}">Settings</a>
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
                                            <span class="element_nb">{{ $std_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Students<br>Number</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pl-2 pr-2 pb-3 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/teacher.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $tch_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Teachers<br>Number</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/administrator.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $adm_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Admin<br>Number</p>
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
                                    <img class="element_img" src="{{ asset('img/dashboard/category.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $categ_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Categories<br>Number</p>
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
                                            <span class="element_nb">{{ $form_nb }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title">Formations<br>Number</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/course.svg') }}" alt="">
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb">{{ $cour_nb }}</span>
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

                    </div>

                    <div class="row pt-4 pb-4 justify-content-center">

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 mr-5 element_col">
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

                        <div class="col-3 pt-3 pl-2 pr-2 pb-3 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <img class="element_img" src="{{ asset('img/dashboard/g1.svg') }}" alt="">
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

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
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
                                            <span class="element_nb">{{ $res_tps_nb }}</span>
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

                        <div class="col-3 pt-3 pl-2 pr-2 pb-3 mr-5 element_col">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto p-0 pl-1">
                                    <!--<img class="element_img" src="{{ asset('img/dashboard/g1.svg') }}" alt="">-->
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb"></span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pt-3 pb-3 pl-2 pr-2 element_col">
                            <div class="row justify-content-center align-items-center" style="">
                                <div class="col-auto p-0 pl-1">
                                    <!--<img class="element_img" src="" alt="">-->
                                </div>
                                <div class="col-auto text-center">
                                    <div class="row">
                                        <div class="col">
                                            <span class="element_nb"></span>
                                        </div>
                                    </div>
                                    <div class="row align-self-center">
                                        <div class="col">
                                            <p class="element_title"></p>
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