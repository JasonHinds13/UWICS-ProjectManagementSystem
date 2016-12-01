/* global $ */

$(document).ready(function() {
    var acctype = document.cookie.split(';')[0].split("=")[1];
    console.log(acctype);
    var acc = $.cookie("acctype", 1);
    console.log(acc);
    
    if ($(acctype) == "leader") {
        $("#home").attr('href','leaderhomepage.php');
        $("#navbar").append( '<a href="createproject.html"><button id = "projects">Create Projects</button></a><a href="createtask.html"><button id = "tasks">Create Tasks</button></a>' );
    } else if ($(acctype) == "member") {
        $("#home").attr('href','memberhomepage.php');
    }
}); 