@extends('layouts.hello')

@section('content')
    <div class="container-fluid" style="background-color: rgb(67, 83, 167, 0.82);">
        <div class="row" style="padding: 10px;">
            <div class="col-sm-7">
                <h1 class="p-4 m-0" style="color: white; font-family: 'Roboto'; font-size: 4.6vw;">Registered Courses List</h1>
            </div>
            <div class="col-auto">
                <img class="position-absolute" style="width: 26vw;" src="{{ asset('/img/Cours_Inscrits2.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" style="background-color: #E2F3F5;">
            
            <div class="col-2 p-1">
                <div class="rounded" style="width: 100%; height: 31.5vw; background-color: #0E153A; color: white; top: 64px; position: sticky;">
                <div class="d-flex justify-content-center p-3">
                    <h1 style="font-family: 'Roboto'; border-bottom: white 1px solid;">Menu</h1>
                </div>
                <div class="d-flex justify-content-center" style="">
                    <ul class="nav flex-column">
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                            <a class="nav-link pl-2 menu-item" href="{{ route('student.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/profile.svg') }}" alt="Profile">
                            <a class="nav-link pl-2 menu-item" href="{{ route('profile.show_student_profile') }}">Profile</a>
                        </li>
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/courses.svg') }}" alt="Courses">
                            <a class="nav-link pl-2 menu-item active" href="{{ route('student.courses') }}">Courses</a>
                        </li>
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/exams.svg') }}" alt="Exams">
                            <a class="nav-link pl-2 menu-item" href="{{ route('student.show_exams_todo') }}">Exams</a>
                        </li>
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/tps.svg') }}" alt="TP">
                            <a class="nav-link pl-2 menu-item" href="{{ route('student.show_tps_todo') }}">TP</a>
                        </li>
                        <li class="nav-item d-flex align-items-baseline">
                            <img class="logo" src="{{ asset('img/dashboard/setting.svg') }}" alt="Settings">
                            <a class="nav-link pl-2 menu-item" href="{{ route('profile.show_student_profile_settings') }}">Settings</a>
                        </li>   
                    </ul>
                </div>
                <div>
                    <a class="nav-link position-relative" href="{{ route('logout') }}" 
                        style="left: 120px;"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <img class="logo" src="{{ asset('img/dashboard/logout.svg') }}" alt="Logout"></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
                </div>
                </div>
            </div>

            <div class="col" style="max-width: 100%;">

                <div class="row pb-3 p-5">
                    <div class="col-auto text-center" style=";">
                        <h2 class="display-4" style="font-family: Roboto; color: #0E153A">My Courses</h2>
                    </div>
                </div>

                <hr class="m-0">
                
                <div class="row p-5 justify-content-center m-0" style="max-width: 100%;">
                    
                    @foreach ($cours as $cour)
                    
                        <div class="col-auto mb-4">
                            <div class="card" style="width: 15rem;">
                                <img src="{{ asset('img/php.jpg') }}" class="card-img-top" alt="...">
                                <div class="position-absolute" style="right: 5px; top: 5px;">
                                    <!--<a class="btn btn-danger p-1" href="{{ route('student.courses') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form{{$cour->id}}').submit();">
                                        <img class="m-1" src="{{ asset('img/trash.svg') }}" alt="" style="width: 15px; height: 15px;">
                                    </a>-->

                                    <!-- Button trigger modal -->
                                    <button class="btn btn-danger p-1" style="border-radius: 50%;" data-toggle="modal" data-target="#delete_qst{{$cour->id}}">
                                        <img class="m-1" src="{{ asset('img/trash.svg') }}" alt="trash" style="width: 15px; height: 15px;">
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete_qst{{$cour->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>-->
                                                </div>
                                                <div class="modal-body justify-content-center">
                                                    <p>Are you sure you want to unsubscribe from this course ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a type="button" class="btn btn-danger"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('delete-form{{$cour->id}}').submit();" style="color: white;">
                                                        Unsubscribe 
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="delete-form{{$cour->id}}" action="/student/courses/{{ $cour->id }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cour->name }}</h5>
                                    <p class="card-text">{{ $cour->description }}</p>
                                    <a href="/student/courses/details/{{ $cour->id }}" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                </div>

            </div>

        </div>
    </div>
@endsection