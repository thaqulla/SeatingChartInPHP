import './bootstrap';

import '../sass/app.scss'

import '../css/app.css';

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('alphabetForm');
  const radioButtons = form.querySelectorAll('input[type="radio"]');

  radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
          form.submit();
      });
  });
});

function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text/plain", event.target.id);
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("text/plain");
  event.target.appendChild(document.getElementById(data));
}