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
                            <a class="btn rounded-pill mr-5" href="{{ route('admin.show_admins_list') }}" style="background-color: #0E153A; color: white;">Admins List</a>
                            <a class="btn rounded-pill create mr-5" href="{{ route('admin.show_students_list') }}">Students List</a>
                            <a class="btn rounded-pill create" href="{{ route('admin.show_teachers_list') }}">Teachers List</a>
                        </div>
                    </div>

                    <hr style="background-color: #5F70B5;">

                    <div class="row mt-4 align-items-center">
                        <div class="col-8 text-center">
                            <h3 style="font: 500 3vw 'Roboto'; color: #0E153A;">Admins List</h3>
                        </div>

                        <div class="col text-left">
                            <a class="btn btn-primary btn-lg" href="{{ route('admin.show_create_admin_account') }}" style="width: 100%;">Add Admin</a>
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
                                        <th scope="col">Email</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Updates</th>
                                        <th scope="col">Deletes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $adm)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $adm->name }}</td>
                                        <td>{{ $adm->birth_date }}</td>
                                        <td>{{ $adm->email }}</td>
                                        <td>{{ $adm->created_at }}</td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm mr-2" data-toggle="modal" data-target="#resetModal{{ $adm->id }}">Reset</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#updateModal{{ $adm->id }}">Update</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $adm->id }}">Delete</button>
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
                    @foreach ($admins as $adm)
                    <!-- Modal Reset -->
                    <div class="modal fade" id="resetModal{{ $adm->id }}" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="resetModalLabel">Reset Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="up{{ $adm->id }}" action="/admin/admins/reset/password/{{ $adm->id }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-4">
                                                <label for="adm_pass{{ $adm->id }}">New password</label>
                                            </div>

                                            <div class="col">
                                                <input id="adm_pass{{ $adm->id }}" name="adm_pass{{ $adm->id }}" type="password" oninput="check_length('reset{{ $adm->id }}', 'adm_pass{{ $adm->id }}', 'adm_cf{{ $adm->id }}', 'adm_pass_msg{{ $adm->id }}', 'adm_cf_msg{{ $adm->id }}');">
                                                <span class="" id="adm_pass_msg{{ $adm->id }}" style="display: block;"></span>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="adm_cf{{ $adm->id }}">Confirm password</label>
                                            </div>

                                            <div class="col">
                                                <input id="adm_cf{{ $adm->id }}" name="adm_n{{ $adm->id }}" type="password" oninput="check_matches('reset{{ $adm->id }}', 'adm_pass{{ $adm->id }}', 'adm_cf{{ $adm->id }}', 'adm_pass_msg{{ $adm->id }}', 'adm_cf_msg{{ $adm->id }}');">
                                                <span class="" id="adm_cf_msg{{ $adm->id }}" style="display: block;"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button id="reset{{ $adm->id }}" type="submit" class="btn btn-danger" disabled>Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Reset -->

                    <!-- Modal Update -->
                    <div class="modal fade" id="updateModal{{ $adm->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="up{{ $adm->id }}" action="/admin/admins/update/{{ $adm->id }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="adm_n{{ $adm->id }}">Admin Name</label>
                                            </div>

                                            <div class="col">
                                                <input name="adm_n{{ $adm->id }}" type="text" value="{{ $adm->name }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4">
                                                <label for="adm_d{{ $adm->id }}">Admin Birth Date</label>
                                            </div>

                                            <div class="col">
                                                <input name="adm_d{{ $adm->id }}" type="date" value="{{ $adm->birth_date }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-4">
                                                <label for="adm_email{{ $adm->id }}">Admin Email</label>
                                            </div>

                                            <div class="col">
                                                <input name="adm_email{{ $adm->id }}" type="email" value="{{ $adm->email }}">
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
                    <div class="modal fade" id="deleteModal{{ $adm->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="del{{ $adm->id }}" action="/admin/admins/delete/{{ $adm->id }}" method="POST">
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

    <script>
    
        function check_length(btn, id1, id2, msg1, msg2) {

            var input = document.getElementById(id1);
            var span = document.getElementById(msg1);

            if (input.value.length < 8) {
                span.classList.remove('succ');
                span.classList.add('err');
                span.innerHTML = "Password must be at least 8 characters";
            }
            else {
                span.classList.remove('err');
                span.classList.add('succ');
                span.innerHTML = "Good";
            }

            check_matches(id1, id2, msg2);

            check(btn, msg1, msg2);
        }

        function check_matches(btn, id1, id2, msg1, msg2) {

            var input1 = document.getElementById(id1);
            var input2 = document.getElementById(id2);
            var span = document.getElementById(msg2);

            if (input1.value == input2.value) {
                /*span.classList.remove('err');
                span.classList.add('succ');*/
                span.innerHTML = "Passwords matching";
            }
            else {
                /*span.classList.remove('succ');
                span.classList.add('err');*/
                span.innerHTML = "Passwords not-matching";
            }

            check(btn, msg1, msg2);
        }

        function check(btn, msg1, msg2) {

            var span1 = document.getElementById(msg1);
            var span2 = document.getElementById(msg2);
            var reset = document.getElementById(btn);

            var x = setInterval(() => {
            
                if (span1.innerHTML == 'Good' && span2.innerHTML == 'Passwords matching') {
                    reset.disabled = false;
                }
            
            }, 100);

        }
        

    </script>
@endsection