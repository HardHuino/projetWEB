// CODE DE BOOTSTRAP pour verifier que les inputs des forms sont bien remplis
(function () {
    'use strict'
    
    var forms = document.querySelectorAll('.needs-validation')
  
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

// Fonction de switch d'element actif (entre connexion et inscription)

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