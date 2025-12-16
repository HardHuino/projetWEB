// Example starter JavaScript for disabling form submissions if there are invalid fields CODE EBOOTSTRAP
(function () {
    'use strict'
    
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })();

// Toggle between login and register forms

function toggleForms() {
  var loginPane = document.getElementById('pills-login');
  var registerPane = document.getElementById('pills-register');
  console.log("Toggling forms");
  if (loginPane && registerPane) {
    if (loginPane.classList.contains('show')) {
      loginPane.classList.remove('show', 'active');
      registerPane.classList.add('show', 'active');
    } else {
      registerPane.classList.remove('show', 'active');
      loginPane.classList.add('show', 'active');
    }
  }
}

// Submit answers to questions

function SubmitFormData(displayName, roomCode) {
    var displayName = displayName;
    var answerText = $("#answerText").val();
    var roomCode = roomCode;
    $.post("submitAnswer.php", { displayName : displayName, answerText : answerText, roomCode: roomCode });
  //   function(data) {
	//  $('#submitForm')[0].reset();
  //   });
}

