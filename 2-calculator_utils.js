

// ------------- YOUR AGE IN DAYS

function write_answer_days(text_msg){
    let my_p = document.getElementById("p_answer_days");
    my_p.innerHTML = text_msg
}


function get_dob(){
    return document.getElementById("DOB").value;
}




// -------------CIRCLE
function write_answer_circle(text_msg){
    let my_p = document.getElementById("p_answer_circle");
    my_p.innerHTML = text_msg
}

function get_screen_dims(){
    return window.screen;
}




// ------------- PALINDROME
function write_answer_palindrome(text_msg){
    let my_p = document.getElementById("p_answer_palindrome");
    my_p.innerHTML = text_msg
}


function get_palindrome(){
    return document.getElementById("possible_palindrome").value;

}



// ------------- FIBONACCI
function write_answer_fibo(text_msg){
    let my_p = document.getElementById("p_answer_fibo");
    my_p.innerHTML = text_msg
}
