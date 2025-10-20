function validate(event) {
    const userName = document.getElementById('user_name').value.trim();
    const userEmail = document.getElementById('user_email').value.trim();
    if (userName === "") {
        alert("🚨 Please enter your name before submitting the quiz.");
        return false; 
    }

    if (userEmail === "") {
        alert("📧 Please enter your email before submitting the quiz.");
        return false;
    }

    const q1Radios = document.getElementsByName('question1');
    let q1Checked = false;
    for (let i = 0; i < q1Radios.length; i++) {
        if (q1Radios[i].checked) {
            q1Checked = true;
            break;
        }
    }

    if (!q1Checked) {
        alert("❓ Please answer Question 1.");
        return false;
    }

    return true; 
}