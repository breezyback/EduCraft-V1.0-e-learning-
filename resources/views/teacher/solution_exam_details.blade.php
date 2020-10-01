@extends('layouts.hello')

@section('content')

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row p-3 justify-content-center">
                <div class="col p-0 cr_nav" style="width: 20vw;">
                    <a class="btn " href="{{ route('teacher.show_all_tps_solutions') }}">TP Solutions </a>
                </div>

                <div class="col p-0 cr_nav">
                    <a class="btn" href="{{ route('teacher.show_all_exams_solutions') }}">Exams Solutions</a>
                </div>
            </div>
        </div>
        
        <div class="container p-5" style="background-color: #E2F3F5;">
            <div class="row text-center mb-5">
                <div class="col">
                    <h1 style="font: 700 3vw 'Roboto'; color: #0E153A;">{{ $data->ex_name }}</h1>
                </div>
            </div>

            <div class="row text-center ml-5 mr-5 p-4 mb-5 align-items-center" style="background-color: #0E153A; border-radius: 20px; color: white;">
                <div class="col-9">
                    <div class="row align-items-Center mb-3">
                        <div class="col-5 text-left">
                            <span style="font: 500 1.8vw 'Roboto'; color: #CBCBED;">Student name:</span>
                        </div>
                        <div class="col text-left">
                            <span style="font: 500 1.5vw 'Roboto';">{{ $data->us_name }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-5 text-left">
                            <span style="font: 500 1.8vw 'Roboto'; color: #CBCBED;">Passed at:</span>
                        </div>
                        <div class="col text-left">
                            <span style="font: 500 1.5vw 'Roboto';">{{ $data->res_ex_crat }}</span>
                        </div>
                    </div>
                </div>
                <form class="col align-self-center pt-3 pb-3" action="/teacher/solutions/exams/details/{{ $data->resex_id }}" method="POST" style="background-color: #E2F3F5; border-radius: 25px;">
                    @csrf
                    @method('patch')
                    <div class="row mb-3 align-items-center">
                        <div class="col text-center">
                            <label for="mark_up" class="m-0" style="font: 500 1.8vw 'Roboto'; color: #0E153A;">Mark</label>
                        </div>
                        <div class="col text-center">
                            <select name="mark_up" type="text">
                            <option disabled selected></option>
                            <?php
                                $i = 0;
                                while($i <= 20)
                                {
                                    echo "<option value=\"".$i."\">".$i."</option>";
                                    $i += 0.25;
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <input class="btn rounded-pill" type="submit" style="background-color: #0E153A; color: white;">
                        </div>
                    </div>
                </form>
            </div>
            <!-- DEBUT EXERCICE -->
            @foreach ($ex_ids as $key1 => $ex_id)
            <div class="row p-5 mb-5" style="background-color: white; box-shadow: 0px 0px 5px 0px rgb(0, 0, 0, 0.25); border-radius: 40px;;">
                <div class="col">
                    <div class="row mb-5">
                        <div class="col text-center">
                            <h5 style="font: 700 2.2vw 'Roboto';">Exercice {{ $key1 + 1 }}</h5>
                        </div>
                    </div>

                    <?php 
                        $z = 0;
                    ?>
                    <!-- DEBUT QUESTION -->
                    @foreach ($qsts as $key2 => $qst)
                        @if ($qst == $ex_id)

                        <?php 
                            $z += 1;
                        ?>

                        <div class="row p-4 mb-3" style="background-color: #CBCBED; border-radius: 20px;">
                            <div class="col">
                                <div class="row mb-4">
                                    <div class="col text-center">
                                        <span style="font: 600 1.5vw 'Roboto';">Question {{ $z }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col">
                                                <span style="text-decoration: underline; font: 600 1.3vw 'Roboto';">Answer(s):</span>
                                            </div>
                                        </div>
                                        <!-- DEBUT ANSWER -->
                                        @foreach ($datas as $data)
                                            @if ($data->ans_qst_id == $key2)
                                                @if ($data->qst_type == "true/false")
                                                <?php 
                                                    $ans = explode('-', $data->ans_con);
                                                ?>
                                                <div class="row ml-2 mb-3 align-items-center">
                                                    <div class="col-10">
                                                        <span class="mr-2" style="font: 700 1.3vw 'Roboto';">-</span>
                                                        <p class="m-0" style="display: inline; font: 500 1.2vw 'Roboto';">
                                                            {{ $ans[1] }}
                                                        </p>
                                                    </div>
                                                    <div class="col text-center">
                                                        <span class="ml-3" style="font: 700 1.5vw 'Roboto';">({{ $ans[0] }})</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="row ml-2 mb-3">
                                                    <div class="col">
                                                        <span class="mr-2" style="font: 700 1.3vw 'Roboto';">-</span>
                                                        <p style="display: inline; font: 500 1.2vw 'Roboto';">
                                                            {{ $data->ans_con }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        <!-- FIN ANSWER -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <!-- FIN QUESTION -->
                </div>
            </div>
            @endforeach
            <!-- FIN EXERCICE -->
        </div>
    </div>

@endsection