<?php
/* ,,,,,,,,,,,,,,,,,,,,,,,,,,, Afficher les article  ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,, */
function getArticles()
{
  $article1 = [
    "name" => "la vie est belle de LANCOME",
    "id" => 1,
    "image" => "lancome.jpg",
    "price" => 100,
    "description" => "Eau de parfum",
    "details" => "Lancôme crée le premier iris gourmand : un équilibre parfait mêlant la noblesse de l'iris, la profondeur du patchouli et la régression d'un accord gourmand.
    Le flacon unique de La vie est belle symbolise la quintessence du bonheur : la grâce d'un sourire comme inscrit dans le cristal."
  ];
  $article2 = [
    "name" => "Aqua Allegoria de GUERLAIN",
    "id" => 2,
    "image" => "guerlain.jpg",
    "price" => 80,
    "description" => "Eau de Toilette",
    "details"=> "Parfum-Femme: Aqua Allegoria </br> Nettare Di Sole - Eau de Toilette </br> Vaporisateur :75ml"
  ];
  $article3 = [
    "name" => "Libre Eau de parfum de YVES SAINT LAURENT ",
    "id" => 3,
    "image" => "saintlaurent.jpg",
    "price" => 70,
    "description" => "Eau de Parfum INTENSE",
    "details" => "Libre Eau de parfum </br> Une lavande florale. La tension entre la sensualité brûlante de la fleur d'oranger du Maroc et l'audace d'une lavande de France revisitée au féminin. </br> Vaporisateur 75ml"
  ];

  ##########On mets tt les articles dans un seul tableau avec PUSH  #######
  $articles = [];
  array_push($articles,  $article1,  $article2,  $article3);
  return  $articles;
}


#####  afficher les articles sur la page d'accueil avec foreach #####
//creation des bouton detail Produit et Ajouter au panier
function showArticles($articles)
{
  foreach ($articles as $article) {
    echo "<div class=\"card col-md-5 col-lg-3 p-3 m-3\" style=\"width: 18rem;\">
    <img class=\"card-img-top\"   src=\"images/" . $article['image'] . "\" alt=\"Card image cap\">
    <div class=\"card-body  align-middle\">
    <h4 class=\"card-title font-italic\">". $article['name'] . "</h4>
    <p class=\"card-text font-weight-light\">" . $article['price'] . " €</p>
      <p class=\"card-text font-italic\">" . $article['description'] . "</p>
            <form action=\"produit.php\" method=\"post\" >
            <input type=\"hidden\" name=\"articleId\" value=\"" . $article["id"] . "\">
            <input class=\"btn btn-light\" type=\"submit\" value=\"detail Produit\">
            </form>

            <form action=\"panier.php\" method=\"post\">
            <input type=\"hidden\" name=\"articleId\" value=\"" . $article["id"] . "\">
            <input class=\"btn btn-dark mt-2\" type= \"submit\" value=\"Ajouter au panier\" >
            </form>
            </div>
    </div>";
  }
}

############################# retourner un article ######

function getArticleFromId($id, $articles)
{
  foreach ($articles as $article) {
    if ($article["id"] == $id) {
      return $article;
    }
  }
}

####################### afficher les details #############

function showArticleDetails($article)
{
  echo "
  <div class=\"container p-5\">
          <div class=\"row\">
              <div class=\"col-md-6\">
               <img class=\"card-img-top w-75\"  src=\"images/" . $article['image'] . "\" alt=\"Card image cap\">
              </div>

             <div class=\"col-md-6\">
                <h4 class=\"card-title font-italic\"> " . $article['name'] . "</h4> 
                 <p class=\"card-text font-weight-bold\">" . "Prix : ". $article['price'] . " €</p>
                <p class=\"card-text font-italic\">" . $article['details'] . "</p>
            
                <form action=\"panier.php\" method=\"post\">
                <input type=\"hidden\" name=\"articleId\" value=\"" . $article["id"] . "\">
                <input type= \"submit\" value=\"Ajouter au panier\" class=\"btn btn-secondary\">
                </form>
            </div>
         </div>
  </div>";
}

##### L'Ajout des article dans le  panier   #####

function addToCard($article)
{
  $articlePresent = false;
  for ($i = 0; $i < count($_SESSION['panier']); $i++) {

    if ($_SESSION['panier'][$i]['id'] == $article['id']) {
      echo "<h5> cette article existe déjà dans votre panier ! </h5>";
      $articlePresent = true;
    }
  }

  if (!$articlePresent) {
    $article["quantité"] = 1;
    array_push($_SESSION['panier'], $article);
  }
}

############################### afficher le PANIER   ############################
function display()
{
  if (count($_SESSION['panier']) > 0) {
    foreach ($_SESSION['panier'] as $article) {
      echo 
      "<div class=\"container p-5\">
           <div class=\"row\">
             <div class=\"col-md-6\>
               <img class=\"card-img-top w-25\" src=\"images/" . $article['image'] . "\" alt=\"Card image cap\">
                 <h4 class=\"card-title font-weight-bold\"> " . $article['name'] . "</h4> 
                 <p class=\"card-text font-weight-light\">" . $article['price'] . " €</p>
                 <p class=\"card-text font-italic\">" . $article['description'] . "</p>
            </div>
        
            <div class=\"col-md-6 p-5\">
                   <form action=\"panier.php\" method=\"post\">
                   <input type=\"hidden\" name=\"idArticleModifier\" value=\"" . $article["id"] . "\">
                   <input type=\"number\" name=\"newQuantité\" value=\"" .   $article["quantité"] . "\">
                   <button type=\"submit\"  class=\"btn btn-outline-success btn-sm\">Validé</button>
                  
                   <form action=\"panier.php\" method=\"post\">
                   <input type=\"hidden\" name=\"deleteArticle\" value=\"" . $article["id"] . "\">
                   <input type= \"submit\" value=\"supprimer\"  class=\"btn btn-outline-dark btn-sm\">
                   </form>
            </div>
           
          </div>
        </div>";
    }
  } else {
    echo "<h5>votre panier est vide ! </h5>";
  }
}
#####################  SUPPRIMER UN ARTICLE  ##################################
function deleteProduit($article)
{
  for ($i = 0; $i < count($_SESSION['panier']); $i++) {
    if ($article['id'] = $_SESSION['panier'][$i]['id']) {
      array_splice($_SESSION['panier'], $i, 1);
      echo 'Article Supprimer';
    }
  }
}

function deletePanier()
{
  $_SESSION['panier'] = [];
  if (isset($_POST['deletePanier'])) {
    echo "<script> alert(\"Le panier a bien été vidé\");</script>";
  }
}
#####################  BOUTON VIDER LE PANIER ##################################
function boutonVidagePanier()
{
  echo
  " <div>
     <form action=\"panier.php\" method=\"post\" class=\"row justify-content-center text-dark font-weight-bold p-2\">
     <input type=\"hidden\" name=\"deletePanier\">
     <button type=\"submit\" class=\"btn btn-danger\">Vider le panier</button>
     </form>
    </div>";
}

#####################  SUPPRIMER UN ARTICLE  ##################################
function changeQuantity()
{
  for ($i = 0; $i < count($_SESSION['panier']); $i++) {
    if ($_SESSION['panier'][$i]['id'] == $_POST['idArticleModifier']) {
      $_SESSION['panier'][$i]['quantité'] = $_POST['newQuantité'];
    }
  }
}

##################### CALCUL MONTANT GLOBAL  ##################################

function MontantGlobal()
{
  $total = 0;
  for ($i = 0; $i < count($_SESSION['panier']); $i++) {
    $total += $_SESSION['panier'][$i]['quantité']  *  $_SESSION['panier'][$i]['price'];
  }
  return $total;
}

##################### CALCUL DES FRAIS DE PORT  #################################
function calculFraisDePort()
{
  $totalArticleQuantite = 0;
  for ($i = 0; $i < count($_SESSION['panier']); $i++) {
    $totalArticleQuantite  += $_SESSION['panier'][$i]['quantité'];
  }
  return $totalArticleQuantite * 3;
}
