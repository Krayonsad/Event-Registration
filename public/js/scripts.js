document.addEventListener("DOMContentLoaded", function () {
    const registerButton = document.querySelector(".btn-primary");

    if (registerButton) {
        registerButton.addEventListener("click", function () {
            alert("You clicked Register!");
        });
    }
});
