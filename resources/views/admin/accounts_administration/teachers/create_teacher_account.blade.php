@extends('layouts.hello')

@section('content')

    <style>
    
        .wd {
            width: 20vw;
        }

        .cr_btn {

            background-color: #0E153A; 
            color: white; 
            border-radius: 20px;
        }

        .cr_btn:disabled {

            background-color: grey;
            color: black;
        }

        .err {
            color: red;
        }

        .succ {
            color: green;
        }

    </style>

    <div class="container-fluid">
        <div class="row p-4">
            <div class="col mt-5">
                <img src="{{ asset('img/admin/categories_administration/add1.svg') }}" alt="" style="width: 50vw;">
            </div>

            <form class="col-auto pt-5 pl-5 pr-5 pb-4 position-absolute" action="" method="POST" style="width: 55vw; background-color: rgb(151, 151, 219, 0.5); left: 40vw; backdrop-filter: blur(10px); border-radius: 15px;">
                @csrf
                <div class="row">
                    <div class="col text-center">
                        <h1 style="font: ; color: #FF6584;">Create</h1>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col text-center">
                        <h1 style="font: 700 3.5vw 'Roboto'; color: #0E153A;">TEACHER ACCOUNT</h1>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_n" style="font: 500 1.1vw 'Roboto';">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="text" id="teacher_n" name="teacher_n">
                            </div>
                        </div>
                    </div>

                    <div class="col ml-5 pl-4">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_d" style="font: 500 1.1vw 'Roboto';">Birth Date</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="date" id="teacher_d" name="teacher_d">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_num" style="font: 500 1.1vw 'Roboto';">Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="text" id="teacher_num" name="teacher_num">
                            </div>
                        </div>
                    </div>

                    <div class="col ml-5 pl-4">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_email" style="font: 500 1.1vw 'Roboto';">E-mail Address</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="email" id="teacher_email" name="teacher_email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_pass" style="font: 500 1.1vw 'Roboto';">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="password" id="teacher_pass" name="teacher_pass" oninput="check_length('teacher_pass', 'teacher_pass_msg');">
                                <span class="" id="teacher_pass_msg" style="display: block;"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col ml-5 pl-4">
                        <div class="row">
                            <div class="col">
                                <label class="m-0" for="teacher_cf_pass" style="font: 500 1.1vw 'Roboto';">Confirm Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="wd" type="password" id="teacher_cf_pass" name="teacher_cf_pass" oninput="check_match('teacher_pass', 'teacher_cf_pass', 'teacher_cf_pass_msg');">
                                <span class="" id="teacher_cf_pass_msg" style="display: block;"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-2 text-center">
                        <button id="create" class="btn btn-lg cr_btn" type="submit" disabled style="">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        var x = setInterval(() => {

            var name = document.getElementById('teacher_n');
            var birth = document.getElementById('teacher_d');
            var num = document.getElementById('teacher_num');
            var email = document.getElementById('teacher_email');
            var pass = document.getElementById('teacher_pass');
            var cf_pass = document.getElementById('teacher_cf_pass');
            var span1 = document.getElementById('teacher_pass_msg');
            var span2 = document.getElementById('teacher_cf_pass_msg');

            var created = document.getElementById('create');

            if (name.value != '' && birth.value != '' && num.value != '' && email.value != '' && pass.value != '' && cf_pass.value != '' &&  span1.innerHTML == 'Good' && span2.innerHTML == 'Passwords matching') {
                created.disabled = false;
            }
            else {
                created.disabled = true;
            }

        }, 100);

        function check_length(id, msg) {

            var pass = document.getElementById(id);
            var span = document.getElementById(msg);

            if (pass.value.length < 8) {
                span.classList.remove('succ');
                span.classList.add('err');
                span.innerHTML = "Password must contain at least 8 character"
            }
            else {
                span.classList.remove('err');
                span.classList.add('succ');
                span.innerHTML = "Good";
            }

            check_match('teacher_pass', 'teacher_cf_pass', 'teacher_cf_pass_msg');
        }

        function check_match(id, id_cf, msg) {

            var pass = document.getElementById(id);
            var cf_pass = document.getElementById(id_cf);
            var span = document.getElementById(msg);

            if (cf_pass.value == pass.value) {
                span.classList.remove('err');
                span.classList.add('succ');
                span.innerHTML = "Passwords matching";
            }
            else {
                span.classList.remove('succ');
                span.classList.add('err');
                span.innerHTML = "Passwords not-matching";
            }

        }

    </script>

@endsection