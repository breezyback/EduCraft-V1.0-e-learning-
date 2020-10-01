
class Add {

    static id = 1;

    constructor() {

    }

    element(parent_id) {

        var parent = document.getElementById(parent_id);

        //parent************************************
        var tag0 = document.createElement("div");
        tag0.classList.add("row");
        /***************************************** */



        //1st child
        var tag01 = document.createElement("div");
        tag01.classList.add("col-3");
        tag01.classList.add("pt-5");
        tag01.classList.add("pl-5");
        tag01.classList.add("text-center");

        //1st child of the 1st child
        var tag011 = document.createElement("div");
        tag011.classList.add("row");

        var tag0111 = document.createElement("div");
        tag0111.classList.add("col");

        var tag01111 =  document.createElement("h4");

        var tag01111_text = document.createTextNode("LESSON");

        tag01111.appendChild(tag01111_text);
        tag0111.appendChild(tag01111);
        tag011.appendChild(tag0111);

        //2nd child of the 1st child
        var tag012 = document.createElement("div");
        tag012.classList.add("row");

        var tag0121 = document.createElement("div");
        tag0121.classList.add("col");

        var tag01211 = document.createElement("h3");

        var tag01211_text = document.createTextNode(Add.id + 1);

        tag01211.appendChild(tag01211_text);
        tag0121.appendChild(tag01211);
        tag012.appendChild(tag0121);

        


        //2nd child
        var tag02 = document.createElement("div");
        tag02.classList.add("col");
        tag02.classList.add("pt-4");

        //1st child of the 2nd child
        var tag021 = document.createElement("div");
        tag021.classList.add("row");

        var tag0211 = document.createElement("div");
        tag0211.classList.add("col");

        var tag02111 = document.createElement("label");
        tag02111.classList.add("m-0");
        tag02111.htmlFor = "title" + Add.id;

        var tag02111_text = document.createTextNode("Title");

        tag02111.appendChild(tag02111_text);
        tag0211.appendChild(tag02111);
        tag021.appendChild(tag0211);

        //2nd child of the 2nd child
        var tag022 = document.createElement("div");
        tag022.classList.add("row");
        tag022.classList.add("mb-2");

        var tag0221 = document.createElement("div");
        tag0221.classList.add("col");

        var tag02211 = document.createElement("input");
        tag02211.classList.add("shape");
        tag02211.setAttribute("type", "text");
        tag02211.setAttribute("name", "title" + Add.id);
        tag02211.setAttribute("id", "title" + Add.id);
        tag02211.style.width = "30vw";

        tag0221.appendChild(tag02211);
        tag022.appendChild(tag0221);

        //3rd child of the 2nd child
        var tag023 = document.createElement("div");
        tag023.classList.add("row");

        var tag0231 = document.createElement("div");
        tag0231.classList.add("col");
        tag0231.classList.add("pl-4");

        var tag02311 = document.createElement("input");
        tag02311.classList.add("shape");
        tag02311.setAttribute("type", "file");
        tag02311.setAttribute("name", "lesson" + Add.id);
        tag02311.setAttribute("id", "lesson" + Add.id);

        tag0231.appendChild(tag02311);
        tag023.appendChild(tag0231);


        tag02.appendChild(tag021);
        tag02.appendChild(tag022);
        tag02.appendChild(tag023);
        
        tag01.appendChild(tag011);
        tag01.appendChild(tag012);

        tag0.appendChild(tag01);
        tag0.appendChild(tag02);
        parent.appendChild(tag0);

        Add.id += 1;
    }

    url(url, tag_id) {
        var action = url + "?id=" + Add.id;
        document.getElementById(tag_id).action = action;
    }

}