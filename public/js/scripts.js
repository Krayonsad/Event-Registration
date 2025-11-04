document.addEventListener("DOMContentLoaded", function () {
    const registerButton = document.querySelector(".btn-primary");

    if (registerButton) {
        registerButton.addEventListener("click", function () {
            alert("You clicked Register!");
        });
    }
});

// // select2 initialization
$(document).ready(function () {
  $('.select2').select2({
    theme: 'bootstrap-5',
    width: '100%'
  });
});

