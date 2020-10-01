@extends('layouts.hello')

@section('content')

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row p-3 justify-content-center">
                <div class="col p-0 cr_nav" style="width: 20vw;">
                    <a class="btn " href="{{ route('teacher.show_all_tps_solutions') }}">TP Solutions </a>
                </div>

                <div class="col p-0 cr_nav">
                    <a class="btn" href="{{ route('teacher.create_tps') }}">Exams Solutions</a>
                </div>
            </div>
        </div>
        
        <div class="container p-5" style="background-color: #E2F3F5;">
            <div class="row text-center mb-5">
                <div class="col">
                    <h1 style="font: 700 3vw 'Roboto'; color: #0E153A;">{{ $data->tp_name }}</h1>
                </div>
            </div>

            <div class="row text-center ml-5 mr-5 p-3 mb-5" style="background-color: #FFFFFF; border-radius: 20px;">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <span style="font: 500 1.5vw 'Roboto';">dd/mm/yyyy</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span style="font: 500 2vw 'Roboto';">{{ $data->user_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col align-self-center">
                   <form action="/teacher/solutions/tps/details/{{ $resid }}" method="POST">
                        @csrf
                        @method('patch')
                        <label for="mark_up">Mark</label>
                        <input name="mark_up" type="text" list="marks">
                        <datalist id="marks">
                            <?php
                                $i = 0;
                                while($i <= 20){
                                    echo "<option value=\"".$i."\">".$i."</option>";
                                    $i += 0.25;
                                }
                            ?>
                        </datalist>
                        <input class="btn-sm btn-warning rounded-pill" type="submit">
                    </form>
                </div>
            </div>

            <div class="row text-center" style="height: 70vw;">
                <div class="col">
                    <iframe src="" frameborder="0" width="100%" height="100%" style="border: 2px solid black;"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection