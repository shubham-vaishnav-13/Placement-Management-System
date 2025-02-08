const form = document.querySelector(".login-box form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();
};
continueBtn.addEventListener("click", () => {
    // Ajax
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST", "register_candidate.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data.trim() === "success") {
                    location.href = "login.php";
                }
                else {
                    errorText.textContent = data.trim(); 
                    errorText.style.display = "block";
                }
            } else {
                alert("Error: " + xhr.statusText);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
});
