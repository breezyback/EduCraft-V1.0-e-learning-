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

        <div class="dimension ml-4 pl-4 pr-4 pt-5 pb-3 mb-5">
            <div class="row text-center">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0" style="color: #FF6584; font: 500 2.2vw 'Roboto';">Create</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h2 style="color: #0E153A; font: 700 3vw 'Roboto';">COURSE</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class= "row mt-4">
                <div class="col">
                    <form class="" id="create_course" onsubmit="new Add().url('/teacher/create/courses', this.id);" action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row p-2 mb-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="m-0" for="formation">Formation</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <select class="shape" name="formation" id="formation" style="width: 20vw;">
                                            @foreach($formations as $formation)
                                                <option value="{{ $formation->name }}">{{ $formation->name }}</option>
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
                                        <label class="m-0" for="cr_title">Course title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="shape" type="text" id="cr_title" name="cr_title" style="width: 30vw;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2 mb-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="m-0" for="descr">Description</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <textarea class="shape" name="descr" id="descr" style="width: 35vw; height: 12vw;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2 mb-2">
                            <div class="col" id="parent">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Ressources</label>
                                    </div>
                                    <div class="col">
                                        <input class="btn btn-primary position-fixed shape_btn" type="button" onclick="new Add().element('parent');" value="Add lesson" style="right: 3vw; top: 38vw;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 pt-5 pl-5 text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h4>LESSON</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h3>1</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col pt-4">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="title">Title</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <input class="shape" type="text" name="title" id="title" style="width: 30vw;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col pl-4">
                                                <input class="shape" type="file" name="lesson" id="lesson">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-5 mb-3 align-items-center justify-content-center">
                            <div class="col-auto p-2">
                                <input class="btn btn-primary shape_btn" type="submit" value="CREATE" style="width: 10vw;">
                            </div>
                            <!--<div class="col-auto">
                                <input class="btn btn-primary" type="reset" value="RESET" style="border-radius: 20px;">
                            </div>-->
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-5 p-0">
                    <img class="position-fixed img_back" src="{{ asset('img/create/undraw_instant_support_elxh 1.svg') }}" alt="">
                </div>
                <div class="col-7 p-0">
                    <img class="p-0 position-absolute img_book" src="{{ asset('img/create/undraw_Bibliophile_hwqc 1.svg') }}" alt="">
                </div>
            </div>
        </div>

    </div>

@endsection