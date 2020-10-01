@extends('layouts.hello')

@section('content')

    <style>
        .close_state {
            background-color: red;
            border-radius: 50px;
            color: white;
            font: 500 0.75vw 'Roboto';
        }
        .open_state {
            background-color: green;
            border-radius: 50px;
            color: white;
            font: 500 0.75vw 'Roboto';
        }
        .btn-start {
            background-color: #0E153A;
            color: white;
            border: 2px solid #0E153A;
        }
        .btn-start:hover {
            background-color: #5F70B4;
            color: white;
        }
        .btn-start:disabled {
            background-color: gray;
            color: #0E153A;
            border: 2px solid gray;
            cursor: not-allowed;
        }
    </style>
    
    <script>

        var op_date = {!! json_encode($examen->open_date) !!};
        var op_hour = {!! json_encode($examen->open_hour) !!};
        var duration = {!! json_encode($examen->duration) !!};

        var date = op_date + " " + op_hour;

        var opening_date = new Date(date).getTime();
        var closing_date = opening_date + (duration * 3600 * 1000);

        const opening = setInterval(function() {

            var time_now = new Date().getTime();
            var distance = time_now - opening_date;
            var element = document.getElementById("start");
            var state = document.getElementById('state');

            if (distance >= 0 && time_now <= closing_date) {
                element.disabled = false;
                state.innerHTML = "OPEN";
                state.classList.remove("close_state");
                state.classList.add("open_state");
            } else {
                element.disabled = true;
                state.innerHTML = "CLOSE";
                state.classList.remove("open_state");
                state.classList.add("close_state");
            } 

        }, 500);

    </script>

    <div class="container-fluid">
        <div class="row p-3" style="background-image: linear-gradient(to right, #A4A4EB, rgb(148, 147, 209, 0.3));">
            <div class="col">
                <div class="row mb-4 align-items-center">
                    <div class="col-6 text-center">
                        <span style="font: 700 2vw 'Roboto'; color: #0E153A;">Course</span>
                    </div>
                    <div class="col">
                        <div class="row p-2" style="background-color: rgb(255, 255, 255, 0.15); border-radius: 25px;">
                            <div class="col text-center">
                                <p class="m-0" style="font: 700 1.6vw 'Roboto'; color: #0E153A;">"{{ $cour_name }}"</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row mb-4">
                            <div class="col text-center">
                                <h4 class="m-0" style="font: 700 4.5vw 'Roboto'">Examen</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center align-items-center">
                                <form action="/student/pass/exams/start/{{ $examen->id }}" style="display: inline;">
                                    <button id="start" class="btn btn-lg btn-start mr-2" disabled>
                                        START
                                    </button>
                                </form>
                                <span class="close_state p-2" id="state">CLOSE</span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center mt-3 p-3" style="background-color: rgb(255, 255, 255, 0.15); border-radius: 10px;">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="" style="font: 700 1.3vw 'Roboto';">Durée:</label>
                            </div>
                            <div class="col">
                                <p class="m-0" style="font: 500 1.3vw 'Roboto';">{{ $examen->duration }} heures</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="" style="font: 700 1.3vw 'Roboto';">Date d'ouverture:</label>
                            </div>
                            <div class="col">
                                <p class="m-0" style="font: 500 1.3vw 'Roboto';">{{ $examen->open_date }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" style="font: 700 1.3vw 'Roboto';">Heure d'ouverture:</label>
                            </div>
                            <div class="col">
                                <p class="m-0" style="font: 500 1.3vw 'Roboto';">{{ $examen->open_hour }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                <img src="{{ asset('img/exam/exams_g4ow 1.svg') }}" alt="" style="width: 20vw;">
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3 pb-3">
        <div class="container p-5" style="background-color: #E2F3F5;">
            <div class="row p-4" style="background-color: white; box-shadow: 4px 4px 10px rgb(0, 0, 0, 0.25); border-radius: 20px;">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col">
                            <h5 style="font: 700 1.6vw 'Roboto';">Régles:</h5>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <p style="font: 500 1.2vw 'Roboto';"><span class="pr-2" style="font: 700 1.5vw 'Roboto';">1. </span>Les étudiants inscrits dans ce cour doivent respecté la date planifier et l’heure d’ouverture d’examen. 
                            Sinon ils seront reportés jusqu’aux prochaines ouvertures.</p>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <p style="font: 500 1.2vw 'Roboto';"><span class="pr-2" style="font: 700 1.5vw 'Roboto';">2. </span>L’étudiant se connecte à internet via un câble Ethernet afin d’éviter de perdre sa connexion.</p>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <p style="font: 500 1.2vw 'Roboto';"><span class="pr-2" style="font: 700 1.5vw 'Roboto';">3. </span>L’étudiant doit être seul dans la pièce où il/elle se trouve pendant son examen.</p>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <p style="font: 500 1.2vw 'Roboto';"><span class="pr-2" style="font: 700 1.5vw 'Roboto';">4. </span>Si l’étudiant est physiquement incapable de passer l’examen dans la date et l’heure définit, 
                            il doit contacter l’administration avec un justificatif dans les 3 jours qui suivent la date d’ouveture d’examen.
                            Un examen à distance peut être programmé.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection