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
    .no_match {
        color: red;
        border-color: red;
    }
    .match {
        color: green;
        border-color: green;
    }
</style>

<script>

    function check_pass_length(element, text) {

        var input = document.getElementById(element);
        var msg = document.getElementById(text);
        
        if (input.value.length < 8) {
            msg.classList.remove("match");
            msg.classList.add("no_match");
            msg.innerHTML = "Password must be at least 8 characters";

            input.classList.remove("match");
            input.classList.add("no_match");
        } 
        else {
            msg.classList.remove("no_match");
            msg.classList.add("match");
            msg.innerHTML = "Good";

            input.classList.remove("no_match");
            input.classList.add("match");
        }
    }

    function check_pass_match() {

        var confirm_msg = document.getElementById("cf_msg");

        var new_pass = document.getElementById("new_pass");
        var conf_pass = document.getElementById("confirm_pass");

        if (new_pass.value == conf_pass.value) {

            confirm_msg.classList.remove("no_match");
            confirm_msg.classList.add("match");
            confirm_msg.innerHTML = "passwords matching";

            conf_pass.classList.remove("no_match");
            conf_pass.classList.add("match");
        }
        else {
            confirm_msg.classList.remove("match");
            confirm_msg.classList.add("no_match");
            confirm_msg.innerHTML = 'passwords not-matching';

            conf_pass.classList.remove("match");
            conf_pass.classList.add("no_match");
        }
    }

    function check_email_match() {

        var new_email = document.getElementById("new_email");
        var conf_email = document.getElementById("confirm_email");

        var msg = document.getElementById("cf_email");

        if (conf_email.value == new_email.value) {

            msg.classList.remove("no_match");
            msg.classList.add("match");
            msg.innerHTML = "Emails matching";

            conf_email.classList.remove("no_match");
            conf_email.classList.add("match");
        }
        else {
            msg.classList.remove("match");
            msg.classList.add("no_match");
            msg.innerHTML = "Emails not-matching";

            conf_email.classList.remove("match");
            conf_email.classList.add("no_match");
        }
    }

    function check_email_empty() {

        var new_email = document.getElementById("new_email");
        var msg = document.getElementById("ne_length_msg");

        if (new_email.value.length == 0) {

            msg.classList.remove("match");
            msg.classList.add("no_match");
            msg.innerHTML = "Email cannot be empty";

            new_email.classList.remove("match");
            new_email.classList.add("no_match");
        }
        else {

            msg.classList.remove("match");
            msg.classList.remove("no_match");
            msg.innerHTML = "";

            new_email.classList.remove("match");
            new_email.classList.remove("no_match");
        }
    }

    var x = setInterval(() => {
        
        var cur_pass = document.getElementById("cp_length_msg").innerHTML;
        var new_pass = document.getElementById("np_length_msg").innerHTML;
        var conf_pass = document.getElementById("cf_msg").innerHTML;

        if (cur_pass == "Good" && new_pass == "Good" && conf_pass == "passwords matching") {
            document.getElementById("change_pass").disabled = false;
        }

        var new_email = document.getElementById("ne_length_msg").innerHTML;
        var conf_email = document.getElementById("cf_email").innerHTML;

        if (new_email == "" && conf_email == "Emails matching") {
            document.getElementById("change_email").disabled = false;
        }

    }, 500);

</script>

<div class="container-fluid p-0" style="background-color: #E2F3F5;">
    <div class="container-fluid" style="background-color: #0E153A;">
        <div class="container p-1">
            <div class="row align-items-center p-4">
                <div class="col">
                    <h1 style="color: white; font: 500 3.8vw 'Roboto';">Profile Settings</h1>
                </div>
                <div class="col">
                    <img class="position-absolute" src="{{ asset('img/profile/Group 9.svg') }}" alt="" style="width: 25vw; height: 20vw; right: 30px; top:-65px;">
                </div>
            </div>
        </div>         
    </div>

    <div class="container mt-3 mb-3" style="background-color: white;">
        <div class="row pt-4 pb-4 pl-3 pr-3">
            <div class="col-3  justify-content-center">
                <div class="row mb-5">
                    <div class="col text-center">
                        <img src="{{ asset('img/Ellipse 7.png') }}" alt="user_img" style="width: 12vw; height: 12vw;">
                    </div>
                </div>

                <div class="row ml-4 mr-4">
                    <div class="col text-center pt-5 pb-5" style="background-color: white; box-shadow: 0px 4px 10px rgb(0, 0, 0, 0.25); border-radius: 15px;">
                        <ul class="p-0 mb-0" style="list-style-type: none; font: 500 1.6vw 'Roboto';">
                            @if (Auth()->guard('web')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_student_profile') }}">Profile</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_teacher_profile') }}">Profile</a></li>
                            @else
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_admin_profile') }}">Profile</a></li>
                            @endif

                            @if (Auth()->guard('web')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_student_profile_settings') }}" style="text-decoration: underline; color: #606DB2;">Settings</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_teacher_profile_settings') }}" style="text-decoration: underline; color: #606DB2;">Settings</a></li>
                            @else
                                <li class="pb-4"><a class="pr_hov" href="{{ route('profile.show_admin_profile_settings') }}" style="text-decoration: underline; color: #606DB2;">Settings</a></li>
                            @endif

                            @if (Auth()->guard('web')->check())
                                <li class=""><a class="pr_hov" href="{{ route('student.courses') }}">Courses</a></li>
                            @elseif (Auth()->guard('teacher')->check())
                                
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col pt-5 mr-5">
                <div class="row pl-5 pr-5 pt-4 mb-5">
                    <div class="col">
                        <span style="font: 700 3vw 'Roboto'; color: #0E153A;">{{ $user->name}}</span>
                        <br>
                    </div>
                </div>

                <hr>

                <div class="row mb-5">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span>Change password</span>
                            </div>
                        </div>
                        <div class="row p-4" style="border-radius: 20px; box-shadow: 0px 4px 10px rgb(0, 0, 0, 0.20);">
                            <form id="" class="col" action="" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="current_pass">Current password</label>
                                    </div>
                                    <div class="col">
                                        <input id="current_pass" name="current_pass" type="password" oninput="check_pass_length('current_pass', 'cp_length_msg');" style="">
                                        <span id="cp_length_msg" style="display: block;"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="new_pass">New password</label>
                                    </div>
                                    <div class="col">
                                        <input id="new_pass" name="new_pass" type="password" oninput="check_pass_length('new_pass', 'np_length_msg');">
                                        <span id="np_length_msg" style="display: block;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="confirm_pass">Confirm password</label>
                                    </div>
                                    <div class="col">
                                        <input id="confirm_pass" name="confirm_pass" type="password" oninput="check_pass_match();">
                                        <span id="cf_msg" style="display: block;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button id="change_pass" name="change_pass" class="btn btn-sm" type="submit" disabled style="background-color: #0E153A; color: white;">Change password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span>Change email</span>
                            </div>
                        </div>
                        <div class="row p-4" style="border-radius: 20px; box-shadow: 0px 4px 10px rgb(0, 0, 0, 0.20);">
                            <form id="" class="col" action="" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="current_email">Current email</label>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="new_email">New email</label>
                                    </div>
                                    <div class="col">
                                        <input id="new_email" name="new_email" type="email" oninput="check_email_empty();">
                                        <span id="ne_length_msg" style="display: block;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="confirm_email">Confirm email</label>
                                    </div>
                                    <div class="col">
                                        <input id="confirm_email" name="confirm_email" type="email" oninput="check_email_match()">
                                        <span id="cf_email" style="display: block;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button id="change_email" name="change_email" class="btn btn-sm" type="submit" disabled style="background-color: #0E153A; color: white;">Change email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <span>Delete your account</span>
                            </div>
                        </div>
                        <div class="row p-4" style="border-radius: 20px; box-shadow: 0px 4px 10px rgb(0, 0, 0, 0.20);">
                            <div class="col">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="mb-0">Are you sure you want to delete your account?</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7 mr-5">
                                        <p class="mb-0"><span>Please note:</span> If you delete your account, you won't be able to reactivate it later.</p>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn-lg btn-danger" data-toggle="modal" data-target="#delete_profile">Delete account</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="delete_profile_form" action="" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body row">
                                                            <div class="col">  
                                                                <p>Are you sure you want to delete your account?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
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