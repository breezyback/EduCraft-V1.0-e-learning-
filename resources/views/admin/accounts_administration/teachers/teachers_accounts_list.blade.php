@extends('layouts.hello')

@section('content')

    <style>
        .create {
            background-color: #5F70B5;
            color: white;
        }
        .create:hover {
            background-color: #0E153A;
            color: white;
        }
    </style>

    <div class="container-fluid" style="background-color: #BFC0E2;">
        <div class="container p-1">
            <div class="row align-items-center pl-4 pr-4 pt-5 pb-5">
                <div class="col-auto">
                    <h1 style="color: #0E153A; font: 700 3.8vw 'Roboto';">Accounts Administration</h1>
                </div>
                <div class="col">
                    <img class="position-absolute" src="{{ asset('img/admin/categories_administration/bundle1.svg') }}" alt="" style="top: -50px; right: 0px; width: 25vw;">
                </div>
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

                    <div class="d-flex justify-content-center" style="position: sticky; top: 20px;">
                        <ul class="nav flex-column">
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/dashboard.svg') }}" alt="Dashboard">
                                <a class="nav-link pl-2 menu-item active text" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_admins_list') }}"><mark style="background-color: #5F70B5; color: white; border-radius: 10px;">Accounts</mark></a>
                            </li>
                            <li class="nav-item d-flex align-items-baseline">
                                <img class="logo" src="{{ asset('img/dashboard/setting.svg') }}" alt="Settings">
                                <a class="nav-link pl-2 menu-item" href="{{ route('profile.show_admin_profile_settings') }}">Settings</a>
                            </li>   
                        </ul>
                    </div>

                    <div class="mt-2">
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
                            <a class="btn rounded-pill create mr-5" href="{{ route('admin.show_admins_list') }}">Admins List</a>
                            <a class="btn rounded-pill create mr-5" href="{{ route('admin.show_students_list') }}">Students List</a>
                            <a class="btn rounded-pill" href="{{ route('admin.show_teachers_list') }}" style="background-color: #0E153A; color: white;">Teachers List</a>
                        </div>
                    </div>

                    <hr style="background-color: #5F70B5;">

                    <div class="row mt-4 align-items-center">
                        <div class="col-8 text-center">
                            <h3 style="font: 500 3vw 'Roboto'; color: #0E153A;">Teachers List</h3>
                        </div>
                        
                        <div class="col text-left">
                            <a class="btn btn-primary btn-lg" href="{{ route('admin.show_create_teacher_account') }}" style="width: 100%;">Add Teacher</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Birth date</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updates</th>
                                        <th scope="col">Deletes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $key => $teacher)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ $teacher->birth_date }}</td>
                                        <td>{{ $teacher->num }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#updateModal{{ $teacher->id }}">Update</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $teacher->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @foreach ($teachers as $teacher)
                    <!-- Modal Update -->
                    <div class="modal fade" id="updateModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="up{{ $teacher->id }}" action="/admin/teachers/update/{{ $teacher->id }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="teacher_n{{ $teacher->id }}">Teacher Name</label>
                                            </div>

                                            <div class="col">
                                                <input name="teacher_n{{ $teacher->id }}" type="text" value="{{ $teacher->name }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4">
                                                <label for="teacher_d{{ $teacher->id }}">Teacher Birth Date</label>
                                            </div>

                                            <div class="col">
                                                <input name="teacher_d{{ $teacher->id }}" type="date" value="{{ $teacher->birth_date }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4">
                                                <label for="teacher_num{{ $teacher->id }}">Teacher Number</label>
                                            </div>

                                            <div class="col">
                                                <input name="teacher_num{{ $teacher->id }}" type="text" value="{{ $teacher->num }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4">
                                                <label for="teacher_email{{ $teacher->id }}">Teacher Email</label>
                                            </div>

                                            <div class="col">
                                                <input name="teacher_email{{ $teacher->id }}" type="email" value="{{ $teacher->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Update -->

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="del{{ $teacher->id }}" action="/admin/teachers/delete/{{ $teacher->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Are you sure want to delete this formation?</p>
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
@endsection