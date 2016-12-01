/* global $ */

$(document).ready(function() {
    var type = document.cookie.split(";");
    var acctype = type[2].split("=")[1];
    
    var ctask ='<a href="createtask.html"><button id = "tasks">Create Tasks</button></a>'
    var cproj = '<a href="createproject.html"><button id = "projects">Create Projects</button></a>'
    var vproj = '<a href="viewprojects.html"><button id = "projects">View Projects</button></a>'
    var vtask = '<a href="viewtasks.html"><button id = "tasks">View Tasks</button></a>'
    var forum = '<a href="forum.php"><button id = "forum">Forum</button></a>'
    
    if (acctype == "leader") {
        //$("#home").attr('href','leaderhomepage.php');
        $("#navbar").append( '<a id = "home" href="leaderhomepage.php"><button id = "home">Home</button></a>' + ctask + cproj + vproj + vtask + forum);
    } else if (acctype == "member") {
        //$("#home").attr('href','memberhomepage.php');
        $("#navbar").append('<a id = "home" href="memberhomepage.php"><button id = "home">Home</button></a>' + vproj + vtask + forum );
    }
}); 