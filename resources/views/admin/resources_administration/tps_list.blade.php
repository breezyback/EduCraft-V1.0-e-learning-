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
                    <h1 style="color: #0E153A; font: 700 3.8vw 'Roboto';">Resources Administration</h1>
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
                                <a class="nav-link pl-2 menu-item" href="{{ route('admin.show_courses_list') }}"><mark style="background-color: #5F70B5; color: white; border-radius: 10px;">Resources</mark></a>
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
                            <a class="btn rounded-pill create mr-5" href="{{ route('admin.show_courses_list') }}" style="width: 8vw;">Courses list</a>
                            <a class="btn rounded-pill create mr-5" href="{{ route('admin.show_exams_list') }}" style="width: 8vw;">Exams list</a>
                            <a class="btn rounded-pill create" href="{{ route('admin.show_tps_list') }}" style="width: 8vw; background-color: #0E153A; color: white;">Tps list</a>
                        </div>
                    </div>

                    <hr style="background-color: #5F70B5;">

                    <div class="row mt-4">
                        <div class="col-8 text-center">
                            <h3 style="font: 500 3vw 'Roboto'; color: #0E153A;">Tps List</h3>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Teacher</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Deletes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tps as $key => $tp)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $tp->tp_n }}</td>
                                        <td>{{ $tp->tch_n }}</td>
                                        <td>{{ $tp->tp_cr_at }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $tp->tp_id }}">Delete</button>
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
                    @foreach ($tps as $tp)
                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $tp->tp_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/tps/delete/{{ $tp->tp_id }}" method="POST">
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