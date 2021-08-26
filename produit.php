<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include "./head.php"; ?>

<body>

  <?php include "./header.php"; ?>


      <?php
      include "function.php";

      if (isset($_POST["articleId"])) {
        $idArticle = $_POST["articleId"];
        $articles = getArticles();
        $article = getArticleFromId($idArticle, $articles);
        showArticleDetails($article);
      }
      ?>
  <!--
  <form>
    <input type="button" value="retour a la page d'acceuil" onclick="history.go(-1)">
  </form>
  -->
  <?php

  include "./footer.php";
  ?>
</body>

</html>