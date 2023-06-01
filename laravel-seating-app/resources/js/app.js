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

// functionfuncprint(){

//   letheader = document.getElementById('header'), footer = document.getElementById('footer');

//   header.style.visibility = "hidden";

//   footer.style.visibility = "hidden";

//   window.print();




//   header.style.visibility = "visible";

//   footer.style.visibility = "visible";

// };

$(function(){
  //印刷ボタンをクリックした時の処理
  $('.print-btn').on('click', function(){
    
  //プリントしたいエリアの取得
  var printArea = document.getElementsByClassName("print-area");

  //プリント用の要素「#print」を作成し、上で取得したprintAreaをその子要素に入れる。
  $('body').append('<div id="print" class="printBc"></div>');
  $(printArea).clone().appendTo('#print');

  //この下に、以降の処理が入ります。
  $('body > :not(#print)').addClass('print-off');
  window.print();

  //window.print()を実行した後、作成した「#print」と、非表示用のclass「print-off」を削除
  $('#print').remove();
  $('.print-off').removeClass('print-off');
   });
  });