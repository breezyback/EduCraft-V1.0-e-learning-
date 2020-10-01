@extends('layouts.hello')

@section('content')
    <script>

        function check(id) {

            var inscrit = {!! json_encode($inscrit) !!};
            
            if(inscrit === false)
            {
                var anch = document.getElementById(id);
                anch.setAttribute('data-toggle', 'modal');
                anch.setAttribute('data-target', '#hold');
            }
        }

    </script>

    <div class="container-fluid" style="background-image: linear-gradient(to right, #A4A4EB, rgb(148, 147, 209, 0.3));">
        <div class="row" style="">
            <div class="col-8 pl-5 pt-5">
                <div class="row">
                    <div class="col">
                        <p style="color: #101010; font: lighter 1.5vw 'Roboto';">
                            Category "{{ $categorie->name }}" > Formation "{{ $formation->name }}"
                        </p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <h1 class="pt-2 pb-1" style="color: #0E153A; font: 700 3.5vw 'Roboto';">{{ $cour->name }}</h1>
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col">
                        <p style="color: #282E69; font: 500 1.9vw 'Roboto';">
                            {{ $cour->description }}
                        </p>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="{{ asset('img/cours_details/[000028].jpg') }}" alt="img" style="width: 4vw; height: 4vw; border-radius: 50%;">
                        @foreach ($teacher as $tch)
                        <span style="font: 500 1.5vw 'Roboto';">{{ $tch->name }}</span>
                        @endforeach
                    </div>
                    @unless(Auth()->guard('teacher')->check() or Auth()->guard('admin')->check())
                    <div class="col-5">
                            @if($inscrit == True)
                                <p class="btn deja_inscr"><span class="letter_inscr">Y</span><span class="letter_inscr">o</span><span class="letter_inscr">u</span>
                                <span class="letter_inscr">a</span><span class="letter_inscr">r</span><span class="letter_inscr">e</span>
                                <span class="letter_inscr">a</span><span class="letter_inscr">l</span><span class="letter_inscr">r</span><span class="letter_inscr">e</span><span class="letter_inscr">a</span><span class="letter_inscr">d</span><span class="letter_inscr">y</span>
                                <span class="letter_inscr">r</span><span class="letter_inscr">e</span><span class="letter_inscr">s</span><span class="letter_inscr">g</span><span class="letter_inscr">i</span><span class="letter_inscr">s</span><span class="letter_inscr">t</span><span class="letter_inscr">e</span><span class="letter_inscr">r</span><span class="letter_inscr">e</span><span class="letter_inscr">d</span>
                                </p>
                            @else
                                @if(Auth()->guard()->check())
                                    <a class="btn btn-primary inscr" href="/course/{{ request()->route('id') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('course_subscription').submit();"
                                    >
                                        Subscribe
                                    </a>

                                    <form id="course_subscription" action="/course/{{ request()->route('id') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <a class="btn btn-primary inscr" href="{{ route('login') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('check_login').submit();"
                                    >
                                        Subscribe
                                    </a>

                                    <form id="check_login" action="{{ route('login') }}" method="GET" style="display: none;">
                                        @csrf
                                        <input type="text" name="success" value="login first">
                                        <input type="text" name="id" value="{{ request()->route('id') }}">
                                    </form>
                                @endif
                            @endif
                    </div>
                    @endunless
                    <div class="col">
                        <p>
                            <span style="color: #FF6584; font: 700 1.8vw 'Roboto';">{{ $nb_sub }}</span>
                            <span style="font: 500 1.5vw 'Roboto';">Already Registered</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col align-self-center">
                <img class="" style="width: 26vw; height: 22vw;" src="{{ asset('/img/Cours_details/undraw_road_sign_mfpo 1.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid position-sticky" style="top: 60px; background-color: white; z-index: 1; box-shadow: 0px 4px 4px -4px rgb(67, 83, 167, 0.82);">
        <div class="row p-2">
            <nav class="col">
                <ul class="nav justify-content-center navigate">
                    <li class="nav-item">
                        <a class="nav-link" href="#a_propos">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ens">Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prg">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tp">Tps</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#exm">Exam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#com">Comments</a>
                    </li>
                </ul>
                </hr>
            </nav>
        </div>
    </div>

    <div class="position-fixed" style="left: 30px; bottom: 10px;">
        <div>
            <a href="#top">Scroll TOP</a>
        </div>
    </div>

    <div class="container">
        <div class="row p-5" style="background-color: #E2F3F5;">
            <div class="col">
            <!--#####################################################################################################-->
                <!-- ROW 1 SECTION "a propos" -->
                <div class="row pb-5" id="a_propos">
                    <div class="col">
                        <!-- ROW 1-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title">About this course</h2>
                            </div>
                        </div>
                        <!-- ROW 1-2 "..." -->
                        <div class="row">
                            <div class="col">
                                <p style="color: #53526F; font: 1vw 'Roboto'; line-height: 1.5;">
                                    {{ $cour->description }}
                                </p>
                            </div>
                        </div> 

                    </div>
                </div>
                <!------------------------->
            <!--#####################################################################################################-->
                <!-- ROW 2 SECTION "enseignant" -->
                <div class="row pb-5">
                    <div class="col">
                        <!-- ROW 2-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title" id="ens">Teachers</h2>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 2-2 "..." -->
                        <div class="row text-center justify-content-center">
                            @foreach ($teacher as $tch)
                            <div class="col-auto">
                                <div class="card c">
                                    <img class="card-img-top" src="{{ asset('img/cours_details/[000028].jpg') }}">
                                    <div class="card-body">
                                        <h5 class="card-title ctitle" >{{ $tch->name }}</h5>
                                        <p class="card-text ctext">
                                            Some quick example text to build on the card title
                                            and make up the bulk of the card's content.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-------------------->
                    </div>
                </div>
                <!--------------------------------------->
            <!--#####################################################################################################-->
                <!-- ROW 3 SECTION "programme" -->
                <div class="row pb-5">
                    <div class="col">
                        <!-- ROW 3-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title" id="prg">Course program</h2>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 3-2 "..." -->
                        <div class="row">
                            <div class="col">
                                @foreach($lessons as $key => $lesson)
                                    <div class="row pb-3">
                                        <div class="col lesson">
                                            <a class="text-decoration-none" id="check_ls{{$lesson->id}}" onclick="check(this.id);" href="/storage/{{ $lesson->content }}">
                                            
                                                <div class="row pt-3 pb-3 align-items-center">
                                                    <div class="col-2 text-center">
                                                        <h4 class="lesson_title">LESSON</h4>
                                                        <span class="lesson_nb">{{ $key + 1 }}</span>
                                                    </div>
                                                    <div class="col align-items-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="lesson_name">{{ $lesson->name }}</h3>
                                                            </div>
                                                        </div>
                                                        <!--<div class="row">
                                                            <div class="col">
                                                                <p class="lesson_descr">
                                                                    {{ $lesson->description }}
                                                                </p>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </a>
                                        </div> 
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!------------------->
                    </div>
                </div>
                <!--------------------------------------->
            <!--#####################################################################################################-->
                <!-- WOW MODAL -->
                <div class="modal fade" id="hold" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="exampleModalLabel">WOW</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center">
                                @if(Auth::guard('teacher')->check())
                                    <p>You're not the teacher who created this course</p>
                                @elseif(Auth::guard('admin')->check())
                                    <p>You're an admin</p>
                                @else
                                    <p>Hold on you need to subscribe to this course first !!!</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                @unless(Auth::guard('teacher')->check() or Auth::guard('admin')->check())
                                    @unless(Auth::guard()->check())
                                        <button type="button" class="btn btn-danger"
                                        onclick="location.href = '{{ route('login') }}' ">
                                            login
                                        </button>
                                    @else
                                        <a class="btn btn-danger" href="/course/{{ request()->route('id') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('course_subscription_modal').submit();"
                                        >
                                            Subscribe
                                        </a>

                                        <form id="course_subscription_modal" action="/course/{{ request()->route('id') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endunless
                                @endunless
                            </div>
                        </div>
                    </div>
                </div>
                <!--------------->
            <!--#####################################################################################################-->
                <!-- ROW 4 SECTION "tps" -->
                <div class="row pb-5">
                    <div class="col">
                        <!-- ROW 4-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title" id="tp">Practical works</h2>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 4-2 "..." -->
                        <div class="row">
                            <div class="col">
                            
                                @foreach($tps as $key => $tp)
                                    <hr>
                                    <a class="row align-items-center text-decoration-none" id="check_tp{{ $tp->id }}" onclick="check(this.id);" href="/storage/{{ $tp->content }}">
                                        
                                        <div class="col-2 text-center">
                                            <h4 class="lesson_title" style="color: #606DB2;">WORK</h4>
                                            <span class="lesson_nb" style="font-size: 2vw; color: #606DB2;">{{ $key + 1 }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="lesson_name" style="font-size: 1.4vw;">{{ $tp->name }}</h4>
                                        </div>

                                    </a>
                                @endforeach
                                
                            </div>
                        </div>
                        <!------------------->
                    </div>
                </div>
                <!--------------------------------------->
            <!--#####################################################################################################-->
                <!-- ROW 5 SECTION "examen" -->
                <div class="row pb-5">
                    <div class="col">
                        <!-- ROW 5-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title" id="exm">Exam</h2>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 5-2 "..." -->
                        @if (count($examens) > 0)
                            @foreach($examens as $examens)
                                <div class="row">
                                    <div class="col p-2 examen" style="">
                                        <a class="row align-items-center pl-5 pr-5 p-2 text-decoration-none" id="check_ex{{ $examens->id }}" onclick="check(this.id);" href="/student/pass/exams/{{ $examens->id }}">
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img class="ex_icon" src="{{ asset('img/cours_details/exam (1).svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h4 class="">{{ $examens->name }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img class="ex_icon" src="{{ asset('img/cours_details/clock 1.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h4 class="">{{ $examens->open_hour }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img class="ex_icon" src="{{ asset('img/cours_details/calendar.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h4 class="">{{ $examens->open_date }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p>No Exam</p>
                                </div>
                            </div>
                        @endif
                        <!------------------->
                    </div>
                </div>
                <!--------------------------------------->
            <!--#####################################################################################################-->
                <!-- ROW 6 SECTION "commentaire" -->
                <div class="row pb-5">
                    <div class="col">
                        <!-- ROW 6-1 "..." -->
                        <div class="row">
                            <div class="col">
                                <h2 class="c_title" id="com">Comments</h2>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 6-2 "..." -->
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">

                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 6-3 "..." -->
                        <div class="row">
                            <div class="col">
                                <a href="">See more comments</a>
                            </div>
                        </div>
                        <!------------------->
                        <!-- ROW 6-4 "..." -->
                        <div class="row">
                            <div class="col">
                                <textarea name="" id="" cols="142" rows="10"></textarea>
                            </div>
                        </div>
                        <!------------------->
                    </div>
                </div>
                <!--------------------------------------->
            <!--#####################################################################################################-->
            </div>
        </div>
    </div>
@endsection