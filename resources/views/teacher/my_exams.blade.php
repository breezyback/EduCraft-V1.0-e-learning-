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
                        <h1 style="font: 500 3.8vw 'Roboto';">Resources Management</h1>
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
                                <a class="nav-link pl-2 menu-item hov" href="{{ route('teacher.show_my_courses') }}"><mark style="background-color: #0E153A; color: white; border-radius: 10px;">Resources</mark></a>
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

                <div class="col p-4">

                    <div class="row pt-3 pb-3">
                        <div class="col-8 text-center">
                            <a class="btn rounded-pill create mr-5" href="{{ route('teacher.show_my_courses') }}">My Courses</a>
                            <a class="btn rounded-pill create mr-5" href="{{ route('teacher.show_my_tps') }}">My Tps</a>
                            <a class="btn rounded-pill" href="{{ route('teacher.show_my_exams') }}" style="background-color: #0E153A; color: white;">My Exams</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <hr style="background-color: #5F70B5;">
                        </div>
                    </div>

                    <div class="row mt-4 align-items-center">
                        <div class="col-8 text-center">
                            <h3 style="font: 500 3vw 'Roboto'; color: #0E153A;">My Exams</h3>
                        </div>
                        
                        <div class="col text-left">
                            <a class="btn btn-primary btn-lg create" href="{{ route('teacher.create_exams') }}" style="width: 100%;">Create Exam</a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Open Date</th>
                                        <th scope="col">Open Hour</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updates</th>
                                        <th scope="col">Deletes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $key => $exam)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ $exam->duration }}</td>
                                        <td>{{ $exam->open_date }}</td>
                                        <td>{{ $exam->open_hour }}</td>
                                        <td>{{ $exam->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#updateModal{{ $exam->id }}">Update</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $exam->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @foreach ($exams as $exam)
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Tp</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="del{{ $exam->id }}" action="/teacher/exams/list/{{ $exam->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <p>Are you sure want to delete this tp?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Delete -->
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection