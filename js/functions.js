function toggle(o) {
    var neopreno = document.querySelector(".neopreno");
    var gel = document.querySelector(".gel");

    if (o.value == "0") neopreno.style.display="none";
    if (o.value == "0") gel.style.display="none";
    if (o.value == "Gel") gel.style.display="block";
    if (o.value == "Neopreno") neopreno.style.display ="block";
    if (o.value == "Gel") neopreno.style.display="none";
    if (o.value == "Neopreno") gel.style.display ="nonw";

}

function alta_capa(o) {
    var alta_capa = document.querySelector(".alta_capa");

    if (o.value == "0") alta_capa.style.display="none";
    if (o.value == "Si") alta_capa.style.display="block";
    if (o.value == "No") alta_capa.style.display ="none";

}