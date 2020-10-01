@extends('layouts.hello')

@section('content')

<style>

    .pr_hov {
        color: #0E153A;
    }

    .pr_hov:hover {
        text-decoration: underline;
        color: #606DB2;
    }
</style>

<div class="container-fluid p-0" style="background-color: #E2F3F5;">
    <div class="container-fluid" style="background-color: #0E153A;">
        <div class="container p-1">
            <div class="row align-items-center p-4">
                <div class="col">
                    <h1 style="color: white; font: 500 3.8vw 'Roboto';">Profile Details</h1>
                </div>
                <div class="col">
                    <img class="position-absolute" src="{{ asset('img/profile/undraw_resume_folder_2_arse 1.svg') }}" alt="" style="width: 30vw; height: 20vw; right: -90px; top:-65px;">
                </div>
            </div>
        </div>         
    </div>

    <div class="container mt-3 mb-3" style="background-color: white;">
        <div class="row pt-4 pb-4 pl-3 pr-3">
            <div class="col-3  justify-content-center">
                <div class="row mb-5">
                    <div class="col text-center">
                        <img src="{{ asset('img/Ellipse 7.png') }}" alt="user_img" style="width: 17vw; height: 17vw;">
                        <!--<a class="position-absolute btn-sm" href="" style=" background-color: #606DB2; right: 50px; top: 170px; color: white; font: 700 2vw 'Roboto'; border-radius: 100%; width: 3vw; height: 3vw; text-decoration: none;">+</a>-->
                    </div>
                </div>

                <div class="row ml-4 mr-4">
                    <div class="col text-center pt-5 pb-5" style="background-color: white; box-shadow: 0px 4px 10px rgb(0, 0, 0, 0.25); border-radius: 15px;">
                        <ul class="p-0 mb-0" style="list-style-type: none; font: 500 1.6vw 'Roboto';">
                            @if (Auth()->guard('web')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_student_profile') }}" style="text-decoration: underline; color: #606DB2;">Profile</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_teacher_profile') }}" style="text-decoration: underline; color: #606DB2;">Profile</a></li>
                            @elseif (Auth()->guard('admin')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_admin_profile') }}" style="text-decoration: underline; color: #606DB2;">Profile</a></li>
                            @endif

                            @if (Auth()->guard('web')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_student_profile_settings') }}">Settings</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_teacher_profile_settings') }}">Settings</a></li>
                            @elseif (Auth()->guard('admin')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_admin_profile_settings') }}">Settings</a></li>
                            @endif

                            @if (Auth()->guard('web')->check())
                                <li class=""><a class="pr_hov" href="{{ route('student.courses') }}">Courses</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col pt-5">
                <div class="row pl-5 pr-5 pt-4">
                    <div class="col">
                        <span style="font: 700 3vw 'Roboto'; color: #0E153A;">{{ $user->name }}</span>
                        <button class="btn rounded-pill position-absolute" data-toggle="modal" data-target="#update_info" style="background-color: #606DB2; width: 4vw; height: 4vw;">
                            <img src="{{ asset('img/profile/edit 1.svg') }}" alt="edit" style="width: 2vw;">
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="update_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="update_info_form" action="" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="modal-body row">
                                            <div class="col">
                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="username">Username</label>
                                                    </div>
                                                    <div class="col">
                                                        <input id="username" name="username" type="text" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="birth_date">Birth date</label>
                                                    </div>
                                                    <div class="col">
                                                        <input id="birth_date" name="birth_date" type="date" value="{{ $user->birth_date }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="bio">Biography</label>
                                                    </div>
                                                    <div class="col">
                                                        <input id="bio" name="bio" type="text" value="{{ $profile->bio }}">
                                                    </div>
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
                        <!-- end modal -->
                        <br>
                        <span style="font: 500 2vw 'Roboto';">
                            @if (Auth()->guard('web')->check())
                                Student
                            @elseif (Auth()->guard('teacher')->check())
                                Teacher
                            @else
                                Admin
                            @endif
                        </span>
                        <br>
                        <br>
                        <span style="font: 500 1.3vw 'Roboto'; color: #0E153A;">Born at</span>
                        <span class="ml-5" style="font: 500 1.3vw 'Roboto'; color: #5F70B5;">{{ $user->birth_date }}</span>
                    </div>
                </div>
                <hr style="background-color: #5F70B5;">
                <div class="row pl-5 pr-5 mb-4">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span style="font: 500 1.3vw 'Roboto';">Citation</span>
                            </div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col text-center p-3 align-self-center" style="background-color: #BFC0E2; border-radius: 25px; box-shadow: 4px 4px 10px rgb(0, 0, 0, 0.20);">
                                <p class="mb-0" style="font: 700 1.3vw 'Roboto';">The purpose of our lives is to be happy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pl-5 pr-5 mb-4">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span style="font: 500 1.3vw 'Roboto';">Biography</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-4" style="border-radius: 15px; box-shadow: 4px 4px 10px rgb(0, 0, 0, 0.20);">
                                <p class="mb-0" style="color: #0E153A; font: 500 1.2vw 'Roboto';">
                                    {{ $profile->bio }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pl-5 pr-5">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span style="font: 500 1.3vw 'Roboto';">Account details</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-4" style="border-radius: 15px; box-shadow: 4px 4px 10px rgb(0, 0, 0, 0.20); color: #0E153A; font: 500 1.2vw 'Roboto';">
                                <span>Created At</span>
                                <span>{{ $user->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection