function getRadioValue(name) {
    const radios = document.getElementsByName(name);
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return parseInt(radios[i].value, 10);
        }
    }
    return 0;
}

function processQuiz(event) {
    event.preventDefault(); 

    const userName = document.getElementById('user_name').value.trim();
    const userEmail = document.getElementById('user_email').value.trim();
    
    if (userName === "") {
        alert("🚨 Please enter your name before finding your archetype.");
        return false;
    }

    if (userEmail === "") {
        alert("📧 Please enter your email before finding your archetype.");
        return false;
    }
    
    const q1Score = getRadioValue('question1');
    const q4Select = document.getElementById('q4_select');
    const q4Score = parseInt(q4Select.value, 10);

    if (q1Score === 0) {
        alert("❓ Please answer Question 1.");
        return false;
    }
    
    if (q4Select.value === "") {
        alert("❓ Please answer Question 4.");
        return false;
    }

    const totalScore = q1Score + q4Score; 
    let archetype = "";
    let description = "";

    if (totalScore >= 9) {
        archetype = "Systems Architect 🏗️";
        description = `With a score of ${totalScore} points, you are the **Systems Architect**! You prioritize robust debugging methods (Q1: 5 points) and elegant, practical solutions (Q4: Go Gopher/Python Snake). You think about the big picture and the long-term health of the codebase.`;
    } else if (totalScore >= 5) {
        archetype = "Feature Fixer 🔨";
        description = `With a score of ${totalScore} points, you are the **Feature Fixer**! You rely on high-energy, quick-and-dirty methods like excessive logging (Q1: 3 points) and reliable, high-energy languages (Q4: Java Coffee Cup). You're focused on shipping features and fixing immediate issues.`;
    } else {
        archetype = "Stack Explorer 🌐";
        description = `With a score of ${totalScore} points, you are the **Stack Explorer**! Your first move is to consult external resources (Q1: 1 point) and you might lean toward familiar or elegant tools (Q4: Python Snake). You are resourceful and know how to leverage the community!`;
    }

    const resultDiv = document.getElementById('quiz-result');
    document.getElementById('result-text').innerHTML = `
        <p>Your total score from the key questions is: <strong>${totalScore} points</strong>.</p>
        <h3>${archetype}</h3>
        <p>${description}</p>
    `;
    
    resultDiv.classList.remove('hidden');
    resultDiv.scrollIntoView({ behavior: 'smooth' });

    return true; 
}