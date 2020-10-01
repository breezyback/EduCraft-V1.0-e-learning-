function hint(str) {

}

function check_cr_creator(check, cr_ids, cr_id, id, type) {
            
    //var check = {!! json_encode($check_teacher) !!};
    if (check) {
        //var cr_ids = {!! json_encode($cr_ids) !!};
        var anch = document.getElementById(id);
        var found = false;
        for (i = 0; i < cr_ids.length; i++) {
            if (cr_ids[i] == cr_id) {
                found = true;
                break;
            }
        }
        if (!found) {
            anch.setAttribute('data-toggle', 'modal');
            anch.setAttribute('data-target', '#exampleModal');
        } else if (type == 'delete') {
            anch.setAttribute('data-toggle', 'modal');
            anch.setAttribute('data-target', '#deleteConfirmation')
        } else if (type == 'update') {
            anch.setAttribute('data-toggle', 'modal');
            anch.setAttribute('data-target', '#updateCourse');
            this.get_course_data(cr_id);
        }
    }
}

function get_course_data(cr_id) {

    console.log('here1');

    var url = "/teacher/update/courses/" + cr_id;

    var id0 = "cr_name"+cr_id;
    var id1 = "cr_descr" + cr_id;
    var ls_id = "list_lesson" + cr_id;
    
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.onload = function() {
        var data = JSON.parse(request.responseText);

        document.getElementById(id0).setAttribute("value", data.cour.name);
        document.getElementById(id1).setAttribute("value", data.cour.description);

        var parent_ls = document.getElementById(ls_id);
        var lesson_list = document.createElement("div");
        lesson_list.setAttribute("id", "lesson_list");

        for (var i = 0; i < (data.lessons).length; i++) {
            var div = document.createElement("div");
            div.setAttribute("id", "lesson" + i);

            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("id", "ls_title" + i);
            input.setAttribute("value", data.lessons[i].name);
            input.setAttribute("name", "ls_title" + i);
            
            var label = document.createElement("label");
            label.setAttribute("for", "ls_title" + i);
            label.classList.add("mr-2")
            
            var text = document.createTextNode("Lesson title");

            var input1 = document.createElement("input");
            input1.setAttribute("type", "file");
            input1.setAttribute("id", "lesson" + i);
            input1.setAttribute("name", "lesson" + i);
            input1.classList.add('ml-3')

            label.appendChild(text);
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(input1);
            lesson_list.appendChild(div);
        }
        parent_ls.appendChild(lesson_list);
    };
    request.send();
}

function undo_data(id) {
    document.getElementById(id).remove();
}