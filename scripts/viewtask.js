/* global $ */

window.onload = function(){
    
    var task = document.getElementById("vtasks");
    var link = "scripts/main.php?tasks=true";
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            $(task).html(xmlhttp.responseText);
        }
    }
    
    xmlhttp.open('GET', link, true);
    xmlhttp.send();
};