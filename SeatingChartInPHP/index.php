<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>座席表＆成績表</title>
</head>
<body>
  <h1>座席表＆成績表</h1>
  
  <div style="background-color: red;">
    <?php
    function calculate_total ($price) {
      $total = $price + 500;
      echo $total . '円';
      }
    calculate_total(500);
    ?>
  </div>
  <div style="background-color: blue;">
    <?php
    include('./leftSide.php');
    ?>
  </div>
  <div style="background-color: green;">
  <?php
    include('./rightSide.php');
    ?>
  </div>



</body>
</html>