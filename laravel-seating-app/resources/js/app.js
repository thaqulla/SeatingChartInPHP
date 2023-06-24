import './bootstrap';

import '../sass/app.scss'

import '../css/app.css';

// document.addEventListener('DOMContentLoaded', function() {
//   const form = document.getElementById('alphabetForm');
//   const radioButtons = form.querySelectorAll('input[type="radio"]');
//   const selectionDisplay = document.getElementById('selectionDisplay');
  
//   // ページ初期表示時に選択したオプションを表示するための処理
//   const selectedOption = form.querySelector('input[name="alphabet"]:checked').value;
//   selectionDisplay.textContent = `選択したオプション：${selectedOption}`;
  
//   radioButtons.forEach(function(radioButton) {
//     radioButton.addEventListener('change', function() {
//       // ラジオボタンが変更された際に選択したオプションを表示する処理を行います
//       const selectedOption = form.querySelector('input[name="alphabet"]:checked').value;
//       selectionDisplay.textContent = `選択したオプション：${selectedOption}`;
//     });
//   });
// });

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

// $(function(){
//   //印刷ボタンをクリックした時の処理
//   $('.print-btn').on('click', function(){
    
//   //プリントしたいエリアの取得
//   var printArea = document.getElementsByClassName("print-area");

//   //プリント用の要素「#print」を作成し、上で取得したprintAreaをその子要素に入れる。
//   $('body').append('<div id="print" class="printBc"></div>');
//   $(printArea).clone().appendTo('#print');

//   //この下に、以降の処理が入ります。
//   $('body > :not(#print)').addClass('print-off');
//   window.print();

//   //window.print()を実行した後、作成した「#print」と、非表示用のclass「print-off」を削除
//   $('#print').remove();
//   $('.print-off').removeClass('print-off');
//    });
//   });

  // When the browser is ready...
  $(function() {
    // validate
    $("#contact").validate({
        // Set the validation rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            message: "required",
        },
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            email: "Please enter a valid email address",
            message: "Please enter a message",
        },
        // submit handler
        submitHandler: function(form) {
          //form.submit();
           $(".message").show();
           $(".message").fadeOut(4500);
        }
    });
  });