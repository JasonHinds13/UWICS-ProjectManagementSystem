/* global $ */

window.onload = function() {
    init();
}

function init() {
    $("#signup").on("click", function() {
        $("#logininfo").load("signup.html");
    }
    );
    
    $("#login").on("click", function() {
        $("#logininfo").load("login.html");
    }
    );
    
    window.captureEvents(Event.SUBMIT);
    window.onsubmit = check;
}

function check() {
    
}