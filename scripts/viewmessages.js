/* global $ */

window.onload = function(){
    
    var mes = document.getElementById("vmes");
    var link = "scripts/main.php?messages=true";
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            $(mes).html(xmlhttp.responseText);
        }
    }
    
    xmlhttp.open('GET', link, true);
    xmlhttp.send();
};