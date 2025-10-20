function compute_days(){
    const dob = get_dob();
    let ageInDays = 0;

    if (dob) {
        const today = new Date();
        const birthDate = new Date(dob);
        
        const diffTime = today.getTime() - birthDate.getTime();
        
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        ageInDays = diffDays;
    }

    if (ageInDays < 0) {
        write_answer_days("Your date of birth is in the future. Please select a valid date.");
    } else if (ageInDays > 0) {
        write_answer_days(`You are ${ageInDays} days old! <br> (Based on your date of birth: ${dob})`);
    } else if (dob) {
        write_answer_days(`You were born today! <br> (Date of birth: ${dob})`);
    } else {
         write_answer_days("Please select your date of birth.");
    }
}


function compute_circle(){
    const screen = get_screen_dims();
    
    const diameter = Math.sqrt(screen.width * screen.width + screen.height * screen.height);
    const radius = diameter / 2;
    
    const area = Math.PI * radius * radius;

    const radius_fmt = radius.toFixed(2);
    const area_fmt = area.toFixed(2);

    write_answer_circle(`The radius of the circle is ${radius_fmt} pixels. <br>` +
    `The area of the circle is ${area_fmt} square pixels. <br>` +
    `(Based on screen dimensions: ${screen.width} x ${screen.height})`);
}


function check_palindrome(){
    const text_input = get_palindrome();
    
    const clean_text = text_input.toLowerCase().replace(/[^a-z0-9]/g, '');
    
    if (clean_text.length < 2) {
        write_answer_palindrome(`Your text: "${text_input}" <br> It is a palindrome`);
        return;
    }

    let is_palindrome = true;
    const len = clean_text.length;

    for (let i = 0; i < Math.floor(len / 2); i++) {
        if (clean_text[i] !== clean_text[len - 1 - i]) {
            is_palindrome = false;
            break; 
        }
    }

    let result_msg = `Your text: "${text_input}" <br>`;
    if (is_palindrome) {
        result_msg += "It is a palindrome!";
    } else {
        result_msg += "It is NOT a palindrome.";
    }
    
    write_answer_palindrome(result_msg);
}


function create_fibo(){    
    const fibo_length_input = document.getElementById("fibo_length"); 
    const fibo_length = fibo_length_input ? parseInt(fibo_length_input.value) : 0;
    
    let fibo_sequence = [];

    if (isNaN(fibo_length) || fibo_length < 0) {
        write_answer_fibo("Please enter a non-negative integer for the length.");
        return;
    }

    if (fibo_length === 0) {
        write_answer_fibo("The sequence is empty: []");
        return;
    }
    if (fibo_length >= 1) {
        fibo_sequence.push(0);
    }
    if (fibo_length >= 2) {
        fibo_sequence.push(1);
    }

    for (let i = 2; i < fibo_length; i++) {
        const next_fibo = fibo_sequence[i - 1] + fibo_sequence[i - 2];
        fibo_sequence.push(next_fibo);
    }
    
    write_answer_fibo(`Fibonacci sequence of length ${fibo_length}: <br>` +
    `[${fibo_sequence.join(', ')}]`);
}