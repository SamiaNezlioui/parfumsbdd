
<?php

// inclure la connexion a la base de donnée
require_once('connect.php');
// la requte pour afficher  les articles
$sql = 'SELECT * FROM `articles`';

 //preparation de la requete
$query = $db->prepare($sql);

// execution de la requete
$query->execute();

//stocker le resultat
$result = $query->fetchAll(PDO::FETCH_ASSOC);
var_dump($result)
?>


<?php
session_start();

include "./function.php";

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

//Validation panier
if (isset($_POST["ValiderPanier"])){
    deletePanier();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
    include "./head.php";
    ?>
<body>


 

<?php include "./header.php";?> 

<div class="container p-5">
            <div class="row text-center justify-content-center">
                <?php
                showArticles(getArticles());
                ?>
            </div>
        </div>


<?php include "./footer.php";?>

</body>
</html>