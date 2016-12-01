/* global $ */

window.onload = function(){
    
    var proj = document.getElementById("vproject");
    var link = "scripts/main.php?projects=true";
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            $(proj).html(xmlhttp.responseText);
        }
    }
    
    xmlhttp.open('GET', link, true);
    xmlhttp.send();
};