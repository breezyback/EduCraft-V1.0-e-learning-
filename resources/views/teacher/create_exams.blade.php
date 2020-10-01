@extends('layouts.hello')

@section('content')

    <style>
    
        .modal {
            overflow-y: auto;
        }

    </style>
    
    <script>

        function show_exercise() {

            var nb_ex = document.getElementById('nb_ex').value;

            var parent_del = document.getElementById("addition_parent");
            parent_del.remove();

            var grand_parent = document.getElementById("grand_parent");

            var parent = document.createElement("div");
            parent.setAttribute("id", "addition_parent");
            parent.classList.add("col");
            parent.classList.add("p-4");
            parent.classList.add("mr-4");
            parent.classList.add("ml-4");

            for (var i = 0; i < nb_ex; i++) {

                var div1 = document.createElement("div");
                div1.classList.add("addition_child");
                div1.classList.add("row");
                div1.classList.add("mt-2");
                div1.classList.add("pt-3");
                div1.classList.add("pb-3");
                div1.classList.add("align-items-center");
                div1.setAttribute("id", "addition_child");
                div1.setAttribute("style", "background-color: #0E153A; color: white; border-radius: 50px;");

                var col1 = document.createElement("div");
                col1.classList.add("col");
                col1.classList.add("text-center");

                var col2 = document.createElement("div");
                col2.classList.add("col-4");

                var col3 = document.createElement("div");
                col3.classList.add("col");

                var h4 = document.createElement("h4");
                h4.classList.add("m-0");

                var h4_text = document.createTextNode("Exercise " + (i+1));
                h4.appendChild(h4_text);

                var label = document.createElement("label");

                var label_text = document.createTextNode("Number of question ");
                label.appendChild(label_text);
                label.classList.add("m-0");

                var input = document.createElement("input");
                input.setAttribute("id", "ex" + (i+1));
                input.setAttribute("name", "ex" + (i+1));
                input.setAttribute("type", "number");
                input.setAttribute("value", "1");
                input.setAttribute("min", "1");
                input.setAttribute("max", "10");
                input.setAttribute("onkeydown", "return false");

                col1.appendChild(h4);
                col2.appendChild(label);
                col3.appendChild(input);

                div1.appendChild(col1);
                div1.appendChild(col2);
                div1.appendChild(col3);

                parent.appendChild(div1);
                grand_parent.appendChild(parent);

            }
            var next = document.getElementById("next");
            next.disabled = false;
        }

        function create_question() {

            var nb_ex = document.getElementById("nb_ex").value;
            
            var div_parent = document.getElementById("modal-parent");

            var div_child = document.createElement("div");
            div_child.setAttribute("id", "modal-child");

            for (var i = 1; i <= nb_ex; i++) {
                var ex = document.getElementById("ex" + i).value;

                for (var j = 1; j <= ex; j++) {
                    var modal = document.createElement("div");
                    modal.classList.add("modal");
                    modal.classList.add("fade");
                    modal.setAttribute("id", "question" + j + "_ex" + i);
                    modal.setAttribute("tabindex", "-1");
                    modal.setAttribute("role", "dialog");
                    modal.setAttribute("aria-labelledby", "ModalLabel" + j + "_ex" + i);
                    modal.setAttribute("aria-hidden", "true");
                    modal.setAttribute("data-keyboard", "false");
                    modal.setAttribute("data-backdrop", "static");

                    var modal_dialog = document.createElement("div");
                    modal_dialog.classList.add("modal-dialog");
                    modal_dialog.classList.add("modal-dialog-centered");
                    modal_dialog.classList.add("modal-lg");
                    modal_dialog.setAttribute("role", "document");

                    var modal_content = document.createElement("div");
                    modal_content.classList.add("modal-content");

                    var modal_header = document.createElement("div");
                    modal_header.classList.add("modal-header");

                    var h5 = document.createElement("h5");
                    h5.classList.add("modal-title");
                    h5.setAttribute("id", "ModalLabel" + j + "ex" + i);
                    h5.setAttribute("style", "font: 700 2vw 'Roboto'; color: #0E153A;");

                    var title = document.createTextNode("Exercise 0" + i);

                    h5.appendChild(title);

                    var button = document.createElement("div");
                    button.classList.add("close");
                    button.setAttribute("type", "button");
                    button.setAttribute("data-dismiss", "modal");
                    button.setAttribute("aria-label", "Close");
                    button.setAttribute("onclick", "reset()");

                    var span = document.createElement("span");
                    span.setAttribute("aria-hidden", "true");
                    

                    var times = document.createTextNode("x");

                    span.appendChild(times);
                    button.appendChild(span);

                    modal_header.appendChild(h5);
                    modal_header.appendChild(button);

                    var modal_body = document.createElement("div");
                    modal_body.classList.add("modal-body");
                    modal_body.setAttribute("id", "modal_body" + j + "_ex" + i);
                    modal_body.setAttribute("style", "background-color: rgb(14, 21, 58, 0.15);");

                    var container = document.createElement("div");
                    container.classList.add("container");
                    container.setAttribute("id", "modal_body_container" + j + "_ex" + i);

                    var row1 = document.createElement("div");
                    row1.classList.add("row");
                    row1.classList.add("align-items-center");
                    row1.classList.add("p-2")
                    row1.setAttribute("id", "type" + j + "_ex" + i);
                    row1.setAttribute("style", "background-color: #CBCBEC; border-radius: 25px;");

                    var col1 = document.createElement("div");
                    col1.classList.add("col");
                    col1.classList.add("text-center");

                    var label = document.createElement("label");
                    label.classList.add("m-0");
                    label.setAttribute("style", "font: 500 1.2vw 'Roboto';");
                    
                    var label_text = document.createTextNode("Question type: ");

                    label.appendChild(label_text);

                    col1.appendChild(label);

                    var col2 = document.createElement("div");
                    col2.classList.add("col");

                    var select = document.createElement("select");
                    select.setAttribute("name", "qst_type" + j + "_ex" + i);
                    select.setAttribute("id", "qst_type" + j + "_ex" + i);

                    var option1 = document.createElement("option");
                    option1.setAttribute("value", "qcm");

                    var opt1_text = document.createTextNode("Qcm");

                    option1.appendChild(opt1_text);

                    var option2 = document.createElement("option");
                    option2.setAttribute("value", "qst libre");

                    var opt2_text = document.createTextNode("Qst Libre");

                    option2.appendChild(opt2_text);

                    var option3 = document.createElement("option");
                    option3.setAttribute("value", "true/false");

                    var opt3_text = document.createTextNode("True/False");

                    option3.appendChild(opt3_text);

                    select.appendChild(option1);
                    select.appendChild(option2);
                    select.appendChild(option3);

                    col2.appendChild(select);

                    

                    var col3 = document.createElement("div");
                    col3.classList.add("col");
                    col3.classList.add("text-center");

                    var confirm = document.createElement("input");
                    confirm.classList.add("btn");
                    confirm.classList.add("btn-sm");
                    confirm.classList.add("rounded-pill");
                    confirm.setAttribute("type", "button");
                    confirm.setAttribute("value", "Confirm");
                    confirm.setAttribute("onclick", "show_question(" + j + "," + i + ")");
                    confirm.setAttribute("style", "background-color: #0E153A; color: white;");

                    col3.appendChild(confirm);

                    row1.appendChild(col1);
                    row1.appendChild(col2);
                    row1.appendChild(col3);

                    container.appendChild(row1);

                    modal_body.appendChild(container);

                    var modal_footer = document.createElement("div");
                    modal_footer.classList.add("modal-footer");

                    var next = document.createElement("button");
                    next.classList.add("btn");
                    next.setAttribute("id", "next" + j + "_ex" + i);
                    
                    var text;

                    if (j == ex && i == nb_ex) {
                        next.setAttribute("type", "submit");
                        next.classList.add("btn-lg");
                        next.classList.add("btn-primary");
                        next.classList.add("text-center");

                        text = document.createTextNode("Create");
                    } else if (j == ex)  {
                        next.setAttribute("data-target", "#question1_ex" + (i+1));
                        next.classList.add("btn-warning");
                        next.classList.add("btn-lg");
                        next.classList.add("p-2");
                        next.setAttribute("type", "button");
                        next.setAttribute("data-dismiss", "modal");
                        next.setAttribute("aria-label", "Close");
                        next.setAttribute("data-toggle", "modal");
                        //next.setAttribute("style", "background-color: rgb(255,237,74);");

                        text = document.createTextNode("Next");
                    } else {
                        next.setAttribute("data-target", "#question" + (j+1) + "_ex" + i);
                        next.classList.add("btn-warning");
                        next.classList.add("btn-lg");
                        next.classList.add("p-2");
                        next.setAttribute("type", "button");
                        next.setAttribute("data-dismiss", "modal");
                        next.setAttribute("aria-label", "Close");
                        next.setAttribute("data-toggle", "modal");
                        //next.setAttribute("style", "background-color: red;");

                        text = document.createTextNode("Next");
                    }
                    next.setAttribute("disabled", "");

                         

                    next.appendChild(text);
                    modal_footer.appendChild(next);         

                    modal_content.appendChild(modal_header);
                    modal_content.appendChild(modal_body);
                    modal_content.appendChild(modal_footer);

                    modal_dialog.appendChild(modal_content);

                    modal.appendChild(modal_dialog);

                    div_child.appendChild(modal);
                }

            }
            div_parent.appendChild(div_child);
        }

        function show_question(j, i) {

            var qst_type = document.getElementById("qst_type" + j + "_ex" + i).value;
            //var modal_body = document.getElementById("modal_body" + j + "_ex" + i);
            var modal_body_container = document.getElementById("modal_body_container" + j + "_ex" + i);

            var type = document.getElementById("type" + j + "_ex" + i);
            type.style.display = "none";

            if (qst_type == "qcm") {

                var row2 = document.createElement("div");
                row2.classList.add("row");
                row2.classList.add("align-items-center");
                row2.classList.add("p-4")
                row2.setAttribute("id", "qcm_details" + j + "_ex" + i);
                row2.setAttribute("style", "background-color: #CBCBEC; border-radius: 25px;");

                var col1 = document.createElement("div");
                col1.classList.add("col");

                /************************************************************************************* */

                var row2_1 = document.createElement("div");
                row2_1.classList.add("row");
                row2_1.classList.add("align-items-center");
                row2_1.classList.add("mb-2");

                var col1_1 = document.createElement("div");
                col1_1.classList.add("col");

                var label = document.createElement("label");
                label.classList.add("m-0");
                label.setAttribute("style", "font: 500 1.2vw 'Roboto';");
                
                var label_text = document.createTextNode("Number of Answers: ");

                label.appendChild(label_text);

                col1_1.appendChild(label);

                var col1_2 = document.createElement("div");
                col1_2.classList.add("col");

                var input_nb_ans = document.createElement("input");
                input_nb_ans.setAttribute("id", "nb_ans" + j + "_ex" + i);
                input_nb_ans.setAttribute("name", "nb_ans" + j + "_ex" + i);
                input_nb_ans.setAttribute("type", "number");
                input_nb_ans.setAttribute("value", "2");
                input_nb_ans.setAttribute("min", "2");
                input_nb_ans.setAttribute("max", "10");
                input_nb_ans.setAttribute("onkeydown", "return false");

                col1_2.appendChild(input_nb_ans);
                
                row2_1.appendChild(col1_1);
                row2_1.appendChild(col1_2);
                /********************************************************************************* */
                var row2_2 = document.createElement("div");
                row2_2.classList.add("row");
                row2_2.classList.add("align-items-center");
                row2_2.classList.add("mb-4");

                var col1_3 = document.createElement("div");
                col1_3.classList.add("col-3");

                var label2 = document.createElement("label");
                label2.classList.add("m-0");
                label2.setAttribute("style", "font: 500 1.2vw 'Roboto';");

                var label2_text = document.createTextNode("Type of Answers:");

                label2.appendChild(label2_text);

                col1_3.appendChild(label2);

                var col1_4 = document.createElement("div");
                col1_4.classList.add("col");
                col1_4.classList.add("text-center");

                var label3 = document.createElement("label");
                label3.classList.add("m-0");

                var label3_text = document.createTextNode("One choice");

                label3.appendChild(label3_text);

                col1_4.appendChild(label3);

                var col1_5 = document.createElement("div");
                col1_5.classList.add("col");

                var radio1 = document.createElement("input");
                radio1.setAttribute("type", "radio");
                radio1.setAttribute("id", "one");
                radio1.setAttribute("name", "answers_type" + j + "_ex" + i);
                radio1.setAttribute("value", "one");
                radio1.setAttribute("checked", "");

                col1_5.appendChild(radio1);

                var col1_6 = document.createElement("div");
                col1_6.classList.add("col");
                col1_6.classList.add("text-center");

                var label4 = document.createElement("label");
                label4.classList.add("m-0");

                var label4_text = document.createTextNode("Multiple choice");

                label4.appendChild(label4_text);

                col1_6.appendChild(label4);

                var col1_7 = document.createElement("div");
                col1_7.classList.add("col");

                var radio2 = document.createElement("input");
                radio2.setAttribute("type", "radio");
                radio2.setAttribute("id", "multi");
                radio2.setAttribute("name", "answers_type" + j + "_ex" + i);
                radio2.setAttribute("value", "multi");

                col1_7.appendChild(radio2);

                row2_2.appendChild(col1_3);
                row2_2.appendChild(col1_4);
                row2_2.appendChild(col1_5);
                row2_2.appendChild(col1_6);
                row2_2.appendChild(col1_7);
                /***************************************************************** */

                var row2_3 = document.createElement("div");
                row2_3.classList.add("row");

                var col1_8 = document.createElement("div");
                col1_8.classList.add("col");
                col1_8.classList.add("text-center");

                var confirm = document.createElement("input");
                confirm.classList.add("btn");
                confirm.classList.add("btn-sm");
                confirm.classList.add("rounded-pill");
                confirm.setAttribute("type", "button");
                confirm.setAttribute("value", "Confirm");
                confirm.setAttribute("onclick", "qcm(" + j + "," + i + ")");
                confirm.setAttribute("style", "background-color: #0E153A; color: white;");

                col1_8.appendChild(confirm);

                row2_3.appendChild(col1_8);
                /***************************************************************** */

                col1.appendChild(row2_1);
                col1.appendChild(row2_2);
                col1.appendChild(row2_3);

                row2.appendChild(col1);

                modal_body_container.appendChild(row2);

            } else if (qst_type == "true/false") {

                var row2 = document.createElement("div");
                row2.classList.add("row");
                row2.classList.add("align-items-center");
                row2.classList.add("p-4")
                row2.setAttribute("id", "true/false_details" + j + "_ex" + i);
                row2.setAttribute("style", "background-color: #CBCBEC; border-radius: 25px;");

                var col1 = document.createElement("div");
                col1.classList.add("col");

                /************************************************************************************* */

                var row2_1 = document.createElement("div");
                row2_1.classList.add("row");
                row2_1.classList.add("align-items-center");
                row2_1.classList.add("mb-2");

                var col1_1 = document.createElement("div");
                col1_1.classList.add("col");

                var label = document.createElement("label");
                label.classList.add("m-0");
                label.setAttribute("style", "font: 500 1.2vw 'Roboto';");
                
                var label_text = document.createTextNode("Number of statements: ");

                label.appendChild(label_text);

                col1_1.appendChild(label);

                var col1_2 = document.createElement("div");
                col1_2.classList.add("col");

                var input_nb_ans = document.createElement("input");
                input_nb_ans.setAttribute("id", "nb_ans" + j + "_ex" + i);
                input_nb_ans.setAttribute("name", "nb_ans" + j + "_ex" + i);
                input_nb_ans.setAttribute("type", "number");
                input_nb_ans.setAttribute("value", "1");
                input_nb_ans.setAttribute("min", "1");
                input_nb_ans.setAttribute("max", "20");
                input_nb_ans.setAttribute("onkeydown", "return false");

                col1_2.appendChild(input_nb_ans);
                
                row2_1.appendChild(col1_1);
                row2_1.appendChild(col1_2);

                var row2_3 = document.createElement("div");
                row2_3.classList.add("row");
                row2_3.classList.add("mt-4");

                var col1_8 = document.createElement("div");
                col1_8.classList.add("col");
                col1_8.classList.add("text-center");

                var confirm = document.createElement("input");
                confirm.classList.add("btn");
                confirm.classList.add("btn-sm");
                confirm.classList.add("rounded-pill");
                confirm.setAttribute("type", "button");
                confirm.setAttribute("value", "Confirm");
                confirm.setAttribute("onclick", "true_false(" + j + "," + i + ")");
                confirm.setAttribute("style", "background-color: #0E153A; color: white;");

                col1_8.appendChild(confirm);

                row2_3.appendChild(col1_8);

                col1.appendChild(row2_1);
                col1.appendChild(row2_3);

                row2.appendChild(col1);

                modal_body_container.appendChild(row2);
            } else {

                var next = document.getElementById("next" + j + "_ex" + i);
                next.disabled = false;
                this.qst(j, i);
            }

        }

        function qcm(j, i) {
            var next = document.getElementById("next" + j + "_ex" + i);
            next.disabled = false;

            var row_delete = document.getElementById("qcm_details" + j + "_ex" + i);
            row_delete.style.display = "none";
            this.qst(j, i);

            var modal_body_container = document.getElementById("modal_body_container" + j + "_ex" + i);
            var nb_ans = document.getElementById("nb_ans" + j + "_ex" + i).value;

            for (var k = 1; k <= nb_ans; k++) {
                
                var row = document.createElement("div");
                row.classList.add("row");

                var col = document.createElement("div");
                col.classList.add("col");

                var row1 = document.createElement("div");
                row1.classList.add("row");

                var col1 = document.createElement("div");
                col1.classList.add("col");

                var label = document.createElement("label");
                label.classList.add("m-0");

                var label_text = document.createTextNode("Answer " + k);

                label.appendChild(label_text);

                col1.appendChild(label);

                row1.appendChild(col1);

                var row2 = document.createElement("div");
                row2.classList.add("row");

                var col2 = document.createElement("div");
                col2.classList.add("col");

                var input = document.createElement("textarea");
                input.setAttribute("id", "answer_content" + k + "_qst" + j + "_ex" + i);
                input.setAttribute("name", "answer_content" + k + "_qst" + j + "_ex" + i);
                input.setAttribute("rows", "2");
                input.setAttribute("cols", "100");

                col2.appendChild(input);

                row2.appendChild(col2);

                col.appendChild(row1);
                col.appendChild(row2);

                row.appendChild(col);

                modal_body_container.appendChild(row);
            }
        }

        function true_false(j, i) {
            var next = document.getElementById("next" + j + "_ex" + i);
            next.disabled = false;

            var row_delete = document.getElementById("true/false_details" + j + "_ex" + i);
            row_delete.style.display = "none";
            this.qst(j, i);

            var modal_body_container = document.getElementById("modal_body_container" + j + "_ex" + i);
            var nb_ans = document.getElementById("nb_ans" + j + "_ex" + i).value;

            for (var k = 1; k <= nb_ans; k++) {
                
                var row = document.createElement("div");
                row.classList.add("row");

                var col = document.createElement("div");
                col.classList.add("col");

                var row1 = document.createElement("div");
                row1.classList.add("row");

                var col1 = document.createElement("div");
                col1.classList.add("col");

                var label = document.createElement("label");
                label.classList.add("m-0");

                var label_text = document.createTextNode("Statement " + k);

                label.appendChild(label_text);

                col1.appendChild(label);

                row1.appendChild(col1);

                var row2 = document.createElement("div");
                row2.classList.add("row");

                var col2 = document.createElement("div");
                col2.classList.add("col");

                var input = document.createElement("textarea");
                input.setAttribute("id", "answer_content" + k + "_qst" + j + "_ex" + i);
                input.setAttribute("name", "answer_content" + k + "_qst" + j + "_ex" + i);
                input.setAttribute("rows", "2");
                input.setAttribute("cols", "100");

                col2.appendChild(input);

                row2.appendChild(col2);

                col.appendChild(row1);
                col.appendChild(row2);

                row.appendChild(col);

                modal_body_container.appendChild(row);
            }
        }

        function qst(j, i) {
            var modal_body_container = document.getElementById("modal_body_container" + j + "_ex" + i);

            var row = document.createElement("div");
            row.classList.add("row");

            var col = document.createElement("div");
            col.classList.add("col");

            var row1 = document.createElement("div");
            row1.classList.add("row");

            var col1 = document.createElement("div");
            col1.classList.add("col");

            var label = document.createElement("label");
            label.classList.add("m-0");

            var label_text = document.createTextNode("Question " + j);

            label.appendChild(label_text);

            col1.appendChild(label);

            row1.appendChild(col1);

            var row2 = document.createElement("div");
            row2.classList.add("row");

            var col2 = document.createElement("div");
            col2.classList.add("col");

            var input = document.createElement("textarea");
            input.setAttribute("id", "qst_content" + j + "_ex" + i);
            input.setAttribute("name", "qst_content" + j + "_ex" + i);
            input.setAttribute("rows", "4");
            input.setAttribute("cols", "100");

            col2.appendChild(input);

            row2.appendChild(col2);

            col.appendChild(row1);
            col.appendChild(row2);

            row.appendChild(col);

            modal_body_container.appendChild(row);
        }

        function reset() {
            var modal_child = document.getElementById("modal-child");
            modal_child.remove();

            var next = document.getElementById("next");
            next.disabled = true;
        }

    </script>

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
                <div class="col-3">
                    <img class="ml-0 position-relative" src="{{ asset('img/create/undraw_reading.svg') }}" alt="" style="width: 40vw; bottom: -15vw;">
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
                                    <h2 style="color: #0E153A; font: 700 3vw 'Roboto';">EXAMENS</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class= "row mt-4">
                        <div class="col">
                            <form class="" id="create_ex" action="{{ route('teacher.create_exams') }}" method="POST" enctype="multipart/form-data">
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
                                                <label class="m-0" for="tp_title">Examen title</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input class="shape" type="text" id="ex_title" name="ex_title" style="width: 30vw;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row p-2 mb-2">
                                    <div class="col-3 mr-3">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="dur">Durée</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <select class="shape" type="number" id="duration" name="duration">
                                                    @for ($i = 1; $i <= 5; $i+=0.5)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="op_date">Date d'ouverture</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input class="shape" type="date" id="op_date" name="op_date" onkeydown="return false;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label class="m-0" for="op_time">Heure d'ouverture</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input class="shape" type="time" id="op_time" name="op_time" onkeydown="return false;">
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
                                            <div class="col p-3 ml-3 mr-3" style="background-color: rgb(14, 21, 58, 0.15); border-radius: 20px;">
                                                <div class="row align-items-center text-center">
                                                    <div class="col-4">
                                                        <label for="nb_ex">Number of exercises</label>
                                                    </div>
                                                    <div class="col">
                                                        <input id="nb_ex" name="nb_ex" type="number" value="1" min="1" max="20" onkeydown="return false">
                                                    </div>
                                                    <div class="col">
                                                        <a class="btn rounded-pill" onclick="show_exercise();" style="background-color: #0E153A; color: white;">Confirm</a>
                                                    </div>
                                                </div>
                                                <div id="grand_parent" class="row">
                                                    <div id="addition_parent" class="col">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col text-center">
                                                <button id="next" class="btn btn-warning btn-lg" type="button" data-toggle="modal" data-target="#question1_ex1" onclick="create_question();" disabled>Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="modal-parent">


                                </div>
                                
                                <!--<div class="row mt-5 mb-3 align-items-center justify-content-center">
                                    <div class="col-auto p-2">
                                        <input class="btn btn-primary shape_btn" type="submit" value="CREATE" style="width: 10vw;">
                                    </div>
                                </div>-->
                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <img class="position-absolute" src="{{ asset('img/create/undraw_Graduat.svg') }}" alt="" style="top: 0px; right: -15vw; width: 34vw;">
                </div>
            </div>
        </div>
    </div>

@endsection