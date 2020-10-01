@extends('layouts.hello')

@section('content')

    <style>
    
        .hov_a:hover {
            border: 1px solid #0E153A;
        }

    </style>

    <div class="container-fluid p-0">

        <div class="container-fluid" style="background-color: #0E153A; color: white;">
            <div class="container p-1" >
                <div class="row align-items-center p-4">
                    <div class="col-7">
                        <h1 style="font: 500 3.8vw 'Roboto';">Solutions Management</h1>
                    </div>
                    <div class="col">
                        <img class="position-absolute" src="{{ asset('img/solutions/tp_solution.svg') }}" alt="" style="width: 30vw; height: 20vw; top: -70px; right: -50px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="background-color: #E2F3F5;">
            <div class="row">
                <div class="col-2 rounded mt-1 pt-3 mb-1" style="background-color: #4E576B; color: white;">
                    <div class="d-flex justify-content-center">
                        <h1 style="font-family: 'Roboto'; border-bottom: white 1px solid;">Menu</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <ul class="nav flex-column">
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                                <a class="nav-link pl-2 menu-item hov active" href="{{ route('teacher.dashboard') }}">Dashboard</a>
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
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('teacher.show_all_exams_solutions') }}"><mark style="background-color: #0E153A; color: white; border-radius: 10px;">Solutions</mark></a>
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
                    <div class="row pl-5 pr-5 pt-4 pb-5 align-items-center">
                        <div class="col p-0 cr_nav" style="width: 20vw;">
                            <a class="btn " href="{{ route('teacher.show_all_tps_solutions') }}" style="background-color: #0E153A; color: white;">TP Solutions </a>
                        </div>

                        <div class="col p-0 cr_nav">
                            <a class="btn" href="{{ route('teacher.show_all_exams_solutions') }}">Exams Solutions</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row pl-4">
                                <div class="col-7">
                                    <h2 style="color: #0E153A; font: 700 2.8vw 'Roboto';">Practical works</h2>
                                </div>
                            </div>
                            <hr style="background-color: #0E153A;">
                            @foreach($tps_names as $tp_name)
                            <div class="row ml-3 mr-3 mt-4 mb-4 pt-4 pb-4 hov_a" style="background-color: white; border-radius: 20px;">
                                <div class="col">
                                    <!--<div class="row text-center pb-2">
                                        <div class="col">
                                            <h3 style="font: 700 2vw 'Roboto'; text-decoration: underlie;"></h3>
                                        </div>
                                    </div>-->
                                    <div class="row pl-3 pr-3 pt-4">
                                        <div class="col" style="border-radius: 20px;">
                                            <div class="row">
                                                <div class="col">
                                                    <h4 style="font: 700 1.5vw 'Roboto';">{{$tp_name}}</h4>
                                                </div>
                                            </div>
                                            
                                            <div class="row pl-4 pr-4 pt-2">
                                                <div class="col p-0">
                                                    <table class="table table-hover">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Mark</th>
                                                                <th scope="col">Status</th>
                                                                <th scope=""></th>
                                                            </tr>
                                                        </thead>
                                                        @foreach($datas as $key => $data)
                                                        @if($data->tps_name == $tp_name)
                                                        <tbody>
                                                            <tr class="table-success">
                                                                <th scope="row">{{ $key + 1 }}</th>
                                                                <td>{{ $data->users_name }}</td>
                                                                <td>{{ $data->created_at }}</td>
                                                                <td>{{ $data->mark }}</td>
                                                                <td>Evaluated</td>
                                                                <td><a class="btn-sm btn-warning rounded-pill" href="/teacher/solutions/tps/details/{{ $data->restp_id }}">Evaluer</a></td>
                                                            </tr>
                                                        </tbody>
                                                        @endif
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection