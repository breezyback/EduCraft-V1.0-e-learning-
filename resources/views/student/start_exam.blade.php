@extends('layouts.hello')

@section('content')

    <style>
        .timer {
            background-color: #0E153A; 
            border-radius: 15px; 
            color: white;
        }
        .timer_number {
            font: 500 3vw 'Roboto';
            letter-spacing: 4px;
        }
        .timer_label {
            font: 700 1.2vw 'Roboto';
        }   
    </style>

    <script>

        var passed_exam = {!! json_encode($passed_exam) !!};
        
        var op_date = {!! json_encode($examen->open_date) !!};
        var op_hour = {!! json_encode($examen->open_hour) !!};
        var duration = {!! json_encode($examen->duration) !!};

        var op_time = new Date(op_date + " " + op_hour).getTime();
        var cl_time = op_time + (duration * 3600 * 1000);
        
        var x = setInterval(function() {

            var time_now = new Date().getTime();
            
            var distance = cl_time - time_now;

            var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            if (~~(h / 10) == 0) {
                h = "0" + h;
            }
            var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            if (~~(m / 10) == 0) {
                m = "0" + m;
            }
            var s = Math.floor((distance % (1000 * 60)) / 1000);
            if (~~(s / 10) == 0) {
                s = "0" + s;
            }

            document.getElementById("hours").innerHTML = h;
            document.getElementById("minutes").innerHTML = m;
            document.getElementById("seconds").innerHTML = s;

            if (distance <= 0) {
                clearInterval(x);
                document.getElementById("pass_exam_form").submit();
            }
            
        }, 1000);

    </script>

    <div class="container-fluid">
        <div class="row p-3 pr-5 pl-5 align-items-center" style="background-image: linear-gradient(to right, #A4A4EB, rgb(148, 147, 209, 0.3));">
            <div class="col text-center ml-5 mr-5 pl-5 pr-5">
                <div class="row mb-4 p-2 mr-5 ml-5" style="background-color: rgb(255, 255, 255, 0.15); border-radius: 25px;">
                    <div class="col">
                        <span style="font: 700 2vw 'Roboto'; color: #0E153A;">Course</span>
                    </div>
                    <div class="col">
                        <p class="m-0" style="font: 700 1.6vw 'Roboto'; color: #122067;">"{{ $cour->name }}"</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <h4 class="m-0" style="font: 700 4.5vw 'Roboto'; color: #0E153A;">Examen</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 pb-4 pl-4 pr-4">
        <div class="row p-3 align-items-center position-stick" style="z-index: 1; top: 35px; background-color: #FFFFFF; border-radius: 50px; box-shadow: 0px 0px 10px 2px rgb(0, 0, 0, 0.25);">
            <div class="col text-center">
                <div class="row align-items-center">
                    <div class="col-auto ml-4">
                        <label class="m-0" for=""  style="font: 600 1.8vw 'Roboto';">Date:</label>
                    </div>

                    <div class="col pr-3 pl-3 pt-2 pb-2 ml-3 timer">
                        <span class="timer_number">{{ $examen->open_date }}</span>
                    </div>

                    <div class="col">
                        <img class="position-absolute" src="{{ asset('img/exam/Group 40.svg') }}" alt="Graduation" style="width: 15vw; top: -7vw; right: 8vw;">
                    </div>

                    <div class="col-auto p-0">
                        <label class="m-0" for="" style="font: 600 1.8vw 'Roboto';">Reste:</label>
                    </div>

                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-3 mr-2 text-center">
                                <div class="row mb-2">
                                    <div class="col pr-3 pl-3 pt-2 pb-2 timer">
                                        <span id="hours" class="timer_number" style="">0{{ $examen->duration }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="m-0 timer_label" for="hours">Hours</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-3 mr-2">
                                <div class="row mb-2">
                                    <div class="col pr-3 pl-3 pt-2 pb-2 timer">
                                        <span id="minutes" class="timer_number">00</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="m-0 timer_label" for="minutes">Minutes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="row mb-2">
                                    <div class="col pr-3 pl-3 pt-2 pb-2 timer">
                                        <span id="seconds" class="timer_number">00</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="m-0 timer_label" for="seconds">Seconds</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pr-5 pl-5 pt-4 pb-4 mt-4" style="background-color: #E2F3F5;">
            <form id="pass_exam_form" action="/student/pass/exams/start/{{ $examen->id }}" method="POST">
                @csrf
                <!-- DEBUT EXERCICE -->
                @foreach ($exercice_ids as $key1 => $exercice_id)
                    <div id="ex{{ $exercice_id }}" class="row pt-5 pb-5 pr-4 pl-4 mb-5" style="background-color: #FFFFFF; border-radius: 15px; box-shadow: 0px 4px 10px 0px rgb(0, 0, 0, 0.25);">
                        <div class="col">
                            <div class="row mb-5">
                                <div class="col text-center">
                                    <h5 class="m-0" style="font: 700 2vw 'Roboto'; color: #0E153A; text-shadow: 0px 4px 10px rgb(0, 0, 0, 0.25);">Exercice 0{{ $key1 + 1 }}</h5>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col text-center">
                                    <p class="m-0" style="font: 500 1.2vw 'Roboto';">Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>

                            <?php 
                                $qst_count = 0;
                                $k = 0;
                            ?>
                            <!-- DEBUT QUESTION -->
                            @foreach ($qsts as $key2 => $qst)
                                @if ($qst->exercice_id == $exercice_id)
                                
                                <?php
                                    $qst_count += 1;

                                    $k += 1;
                                    $nb = $k;
                                    if ((int)($k / 10) == 0 ) {
                                        $nb = "0".$k;
                                    }
                                ?>

                                <div class="row p-5 mb-3" style="background-color: rgb(151, 151, 219, 0.5); border-radius: 25px;">
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <h5 class="m-0" style="font: 600 1.5vw 'Roboto';">Question {{ $nb }}: <span class="ml-3">({{ $qst->qst_type }})</span></h5>
                                                    </div>
                                                </div>
                                                <div class="row pl-3">
                                                    <div class="col">
                                                        <p class="m-0" style="font: 500 1.2vw 'Roboto';">
                                                            {{ $qst->content }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <?php 
                                                            $type;
                                                            switch ($qst->ans_type) {
                                                                case "one":
                                                                    $type = "(one choice)";
                                                                break;
                                                                case "multi":
                                                                    $type = "(multiple choices)";
                                                                break;
                                                                default:
                                                                    $type = "";
                                                                break;
                                                            }
                                                        ?>
                                                        <h5 class="m-0" style="font: 600 1.5vw 'Roboto';">Réponse: <span class="ml-3">{{ $type }}</span></h5>
                                                    </div>
                                                </div>

                                                <?php
                                                    $ch_count = 0;
                                                ?>
                                                <!-- DEBUT CHOICE -->
                                                @foreach ($datas as $key3 => $data2)
                                                    @if ($data2->question_id == $qst->id)
                                                        
                                                        @if ($data2->qst_type == "qst libre")
                                                            <div class="row mt-2">
                                                                <div class="col ml-3">
                                                                    <textarea name="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count }}" id="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count }}" cols="121" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        @elseif ($data2->qst_type == "qcm")
                                                            <?php 
                                                                $ch_count += 1;
                                                            ?>
                                                            @if ($data2->ans_type == "one")
                                                            <div class="row mt-2 align-items-center">
                                                                <div class="col-1 text-center">
                                                                    <input type="radio" id="ex{{ $key1 }}_qst{{ $qst_count }}_ch0" name="ex{{ $key1 }}_qst{{ $qst_count }}_ch0" value="{{ $data2->ch_con }}" style="width: 1.5vw; height: 1.5vw;">
                                                                </div>
                                                                <div class="col pb-2">
                                                                    <p class="m-0" style="font: 500 1.2vw 'Roboto';"> {{ $data2->ch_con }} </p>
                                                                </div>
                                                            </div>
                                                            @elseif ($data2->ans_type == "multi")
                                                            <div class="row mt-2 align-items-center">
                                                                <div class="col-1 text-center">
                                                                    <input type="checkbox" id="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count }}" name="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count }}" value="{{ $data2->ch_con }}" style="width: 1.5vw; height: 1.5vw;">
                                                                </div>
                                                                <div class="col pb-2">
                                                                    <p class="m-0" style="font: 500 1.2vw 'Roboto';"> {{ $data2->ch_con }} </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @elseif ($data2->qst_type == "true/false")
                                                        <?php 
                                                            $ch_count += 1;
                                                        ?>
                                                        <div class="row mt-2 pb-2 align-items-center">
                                                                <div class="col-1 ml-3 mr-4">
                                                                    <select name="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count-1 }}" id="ex{{ $key1 }}_qst{{ $qst_count }}_ch{{ $ch_count-1 }}">
                                                                        <option disabled selected value></option>
                                                                        <option value="vrai-{{ $data2->ch_con }}">Vrai</option>
                                                                        <option value="faux-{{ $data2->ch_con }}">Faux</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="m-0" style="font: 500 1.2vw 'Roboto';"> {{ $data2->ch_con }} </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <input type="hidden" name="qstid_ex{{ $key1 }}_qst{{ $qst_count }}" value="{{ $qst->id }}">
                                                @endforeach
                                                <!-- END CHOICE -->
                                                <input type="hidden" name="nbch_ex{{ $key1 }}_qst{{ $qst_count }}" value="{{ $ch_count }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <input type="hidden" name="nbqst_ex{{ $key1 }}" value="{{ $qst_count }}">
                            <!-- END QUESTION -->
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="nb_ex" value="{{ count($exercice_ids) }}">
                <!-- END EXERCICE -->
                <div class="row">
                    <div class="col text-center">
                        <button id="fin" class="btn btn-lg" type="submit" style="background-color: #0E153A; color: white;">Finish</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        if (passed_exam == true) {    
            location.replace("/student/dashboard");
            /*var finish = document.getElementById("fin");
            finish.disabled = true;*/
        }
    </script>


@endsection