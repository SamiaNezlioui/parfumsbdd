<?php

require_once('./connect.php');

$sql = "INSERT INTO 'articles'('nom','prix','description') VALUES(:nom, :prix, :description);";
$query =$db->prepare($sql);

$query->bindValue(':nom',$article, PDO::PARAM_STR);
$query->bindValue(':prix',$article, PDO::PARAM_STR);
$query->bindValue(':quantite',$article, PDO::PARAM_INT);
$query->execute()

?>

<!DOCTYPE html>
<html lang="en">
<?php
    include "./head.php";
    ?>
    <title>Fiche produit</title>
<body>

<?php include "./header.php";?> 

<main class="container">
 <div classs= "row">
    <section class="col-12">
        <h1>Ajouter un produit</h1>
           <form method="post" >
             <div>
                 
             </div>
               <label for="article">Produit</label>
               <input type="text" name="article" id="article" value="<?= $article['nom']?>">

               <label for="prix">Prix</label>
               <input type="number" name="prix" id="prix" value="<?= $article['prix']?>">

               <label for="description">description</label>
               <input type="text" name="quantité" id="quntite" value="<?= $article['quantité']?>">
              
               <input type="hidden" name="id" value="<?=$article['id']?>">
               <button class="btn btn-primary">Envoyer</button>
           </form>
    </section>
 </div>
 </main> 
</body>
</html>