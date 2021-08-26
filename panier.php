<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./head.php"; ?>

<body>

  <?php include "./header.php"; ?>

  <?php include "function.php";

  if (isset($_POST["articleId"])) {
    $idArticle = $_POST["articleId"];
    $articles = getArticles();
    $article = getArticleFromId($idArticle, $articles);
    addToCard($article);
  }

  if (isset($_POST["deleteArticle"])) {
    $idArticle = $_POST["deleteArticle"];
    $articles = getArticles();
    $article = getArticleFromId($idArticle, $articles);
    deleteProduit($article);
  }
  if (isset($_POST["newQuantité"])) {
    changeQuantity();
  }
  if (isset($_POST["deletePanier"])) {
    deletePanier();
  }

  display();
 // boutonVidagePanier();
  ?>

  <?php
  echo "<h4> Total :</h4>" . MontantGlobal();
  echo "<h4> Frais de port :</h4>" . calculFraisDePort() . "€";
  echo "Total  general : "  . (MontantGlobal() + calculFraisDePort());
  ?>

  <!--- Boutton de validation avec un Model Bootstrap----->

  <!-- Button-->
  <button type="button" class="btn btn-dark data-toggle"  data-toggle="modal" data-target="#exampleModal">
    Validez votre commande
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Félecitation votre commande est bien enregistrer!</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <p>Votre commande est bien  validée</p>
          <p>votre commande sera expediée dans 3 à 4 trois jours </p>
          <p>Merci pour votre confiance.</p>
        </div>

        <div class="modal-footer">
          <form action="index.php" method="post">
            <input type="hidden" name="ValiderPanier">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">retour à l'accueil</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--
    <a href="index.php">Retour a la page d'accuiel</a>
   -->
  
   
   <?php
  //include "./footer.php";
  ?>
  
  

</body>

</html>