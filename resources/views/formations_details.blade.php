@extends('layouts.hello')

@section('content')

    @if (Auth()->guard('teacher')->check())
    <div class="container-fluid">
        {{ session('congrats') }}
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
    @endif

    <div class="container p-5 mb-5 mt-5" style="border-radius: 170px; background: crimson; background: #E2F3F5;">
        <div class="row pb-3 pt-2">
            <div class="col text-center">
                <h5>Categorie "{{ $categ->name }}"</h5>
            </div>
        </div>

        <div class="row pb-5">
            <div class="col">
                <div class="row pb-5">
                    <div class="col text-center">
                        <h1 style="color: #5F70B5; font: 800 2.5vw 'Roboto';">{{ $formation->name }} Formation</h1>
                    </div>
                </div>
                
                <div class="row pl-5 pr-5">
                    <div class="col">
                        <div class="row pb-2">
                            <div class="col">
                                <h4 class="pl-3" style="font: 700 1.5vw 'Roboto'; color: #0E153A;">What is the formation about</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="font: 500 1.3vw 'Roboto';">
                                    {{ $formation->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pl-5 pr-5 pt-5 mb-5">
            <div class="col">
                <div class="row pb-2">
                    <div class="col">
                        <h4 class="pl-3" style="font: 700 1.5vw 'Roboto'; color: #0E153A;">Courses within this formation</h4>
                    </div>
                </div>

                @foreach($cours as $key => $cour)
                <div class="row container pl-5 pr-5 m-2 text-center">
                    <div class="col p-3 align-items-center" style="background-color: #0E153A;; border-radius: 50px;">
                        <a href="/course/{{ $cour->id }}" class="row align-items-center" style="text-decoration: none; color: white;">
                            <div class="col-2 align-items-center">
                                <span for="" style="font: 700 2vw 'Roboto';">0{{ $key + 1 }}</span>
                            </div>
                            
                            <div class="col-8 justify-content-center">
                                <h4>{{ $cour->name }}</h4>
                            </div>

                            @if(Auth::guard('teacher')->check())
                                <div class="col-auto">
                                    <div class="row mb-1">
                                        <div id="form_delete" class="col">
                                            <button id="cr{{ $cour->id }}" class="btn btn-danger rounded-pill"
                                                    onclick="check_cr_creator({{ $check_teacher }}, {{ $cr_ids }}, {{ $cour->id}}, this.id, 'delete'); event.preventDefault();"
                                                    style="width: 5.5vw; height: 2.5vw;"
                                            >
                                                Delete
                                            </button>
                                            <form id="delete-course{{ $cour->id }}" action="/formation/{{ $formation->id }}?crid={{ $cour->id }}" method="POST" style="display: none;">
                                                @csrf
                                                @method("delete")
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button id="up{{ $cour->id }}" class="btn btn-warning rounded-pill" 
                                                onclick="check_cr_creator({{ $check_teacher }}, {{ $cr_ids }}, {{ $cour->id}}, this.id, 'update'); event.preventDefault();"
                                                style="width: 5.5vw; height: 2.5vw;"
                                            >
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </a>
                        <!-- Modal WARNING -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <h1 style="color: black;">You're not the creator of this course !!!!</h1>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <!-- Modal DELETION -->
                        <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <h1 style="color: black;">Are you sure ???</h1>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.getElementById('delete-course' + {{ $cour->id }}).submit();">
                                            Delete
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        
                        <!-- Modal Update -->
                        <div class="modal fade" id="updateCourse" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="update_cr{{ $cour->id }}" action="/teacher/update/courses?crid={{ $cour->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div>
                                                <label for="cr_name{{ $cour->id }}">Title</label>
                                                <input id="cr_name{{ $cour->id }}" name="cr_name{{ $cour->id }}" type="text">
                                                <label for="cr_descr{{ $cour->id }}">Description</label>
                                                <input id="cr_descr{{ $cour->id }}" name="cr_descr{{ $cour->id }}" type="text">
                                            </div>
                                            <div id="list_lesson{{ $cour->id }}">

                                            </div>
                                            <input class="btn btn-primary shape_btn" type="button" onclick="new Add().element('lesson_plus');" value="Add lesson">
                                            <div id = "lesson_plus">
                                            
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="undo_data('lesson_list');">Close</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="document.getElementById('update_cr' + {{ $cour->id }}).submit();">
                                            Update
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection