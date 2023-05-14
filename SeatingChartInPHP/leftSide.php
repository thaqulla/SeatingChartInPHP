<div id="side">
  <p>ここはサイドです</p>
  <ul>
    
    <?php
      for ($i = 1; $i <= 10; $i += 1) {
        echo "<li>メニュー" . $i . "</li>";
      }
    ?>
<form>
  <select>
    <?php

    $types = ["テスト","平常授業","季節講習","特別特訓"];
    
    foreach ($types as $type) {
      echo "<option>" . $type . "</option>";
    }

    ?>
  </select>
</form>
    
  </ul>
</div>