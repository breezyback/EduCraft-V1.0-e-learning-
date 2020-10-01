@extends('layouts.hello')

@section('content')
    <div class="container-fluid">

        <div class="container-fluid">
            <div class="row pt-4 justify-content-center text-center">

                <div class="col p-0 cr_nav">
                    <a class="btn " href="{{ route('teacher.create_courses') }}">Create Course</a>
                </div>

                <div class="col p-0 cr_nav">
                    <a class="btn" href="{{ route('teacher.create_tps') }}">Create Tp</a>
                </div>

                <div class="col p-0 cr_nav">
                    <a class="btn" href="{{ route('teacher.create_exams') }}">Create Exam</a>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <img class="position-relative" src="{{ asset('img/create/undraw_book_lover_mkck 1.svg') }}" alt="" style="width: 50vw; bottom: -10vw;">
                </div>
                <div class="col-6 dimension dimension_2 pl-4 pr-4 pt-5 pb-3 mb-5">
                    <div class="row text-center">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h4 class="m-0" style="color: #FF6584; font: 500 2.2vw 'Roboto';">Create</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h2 style="color: #0E153A; font: 700 3vw 'Roboto';">TRAVAUX <br> PRATIQUES</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class= "row mt-4">
                        <div class="col">
                            <form class="" id="create_tp" action="{{ route('teacher.create_tps') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row p-2 mb-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="cours">Cours</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <select class="shape" name="cours" id="cours" style="width: 20vw;">
                                                    @foreach ($cours as $cour)
                                                        <option value="{{ $cour->name }}">{{ $cour->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-2 mb-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="tp_title">Tp title</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input class="shape" type="text" id="tp_title" name="tp_title" style="width: 30vw;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row p-2 mb-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Ressources</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col pt-4">
                                                <input class="shape" type="file" name="tp" id="tp"">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-5 mb-3 align-items-center justify-content-center">
                                    <div class="col-auto p-2">
                                        <input class="btn btn-primary shape_btn" type="submit" value="CREATE" style="width: 10vw;">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <img class="position-absolute" src="{{ asset('img/create/undraw_happy_music_g6wc 1.svg') }}" alt="" style="bottom: 500px; right: -1vw; width: 20vw;">
                </div>
            </div>
        </div>

    </div>

@endsection