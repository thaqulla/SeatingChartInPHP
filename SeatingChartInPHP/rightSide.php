<div id="side">
  <p>ここはサイドです</p>
  <form>
    <select>
      <?php
      $names = ["yamada ","tanaka","satoh","suzuki"];
      
      foreach ($names as $name) {
        echo "<option>" . $name . "</option>";
      }
      ?>
    </select>
  </form>
</div>