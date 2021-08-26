
<?php
//demarrer une session 
session_start();

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
//var_dump($result)
?>



<!DOCTYPE html>
<html lang="en">
<?php
    include "./head.php";
    ?>
    <title>Liste des produits</title>
<body>

<?php include "./header.php";?> 

<main class="container">
 <div classs= "row">
    <section class="col-12">
        <?php
        if(!empty($_SESSION['erreur'])){
            echo'<div class="alert alert-danger" role=""alertr>'.$_SESSION['erreur'].'
            </div>';
            $_SESSION['erreur'] = "";
        }
        ?>
        <h1>Listes des produit</h1>
        <table class="table">
       <thead>
           <th>ID</th>
           <th>Nom</th>
           <th>Prix</th>
           <th>description</th>
           <th>Action</th>
       </thead>
       <tbody>
           <?php
           //On boucle sur la variable result pour afficher les articles de notre table qui contien un tableau et pour chaque ligne du tableau y a un ligne qui s'appel parfum 
            foreach($result as $article){
           ?>

           <tr>
               <td><?= $article['id'] ?></td>
               <td><?= $article['nom'] ?></td>
               <td><?= $article['prix'] ?></td>
               <td><?= $article['description'] ?></td>


               <td><a href="details.php?id=<?=$article['id']?>">voir</a></td>
           </tr>
           <?php }  ?>
       </tbody>
           
        </table>
            <a href="add.php" class="btn btn-primary">ajouter un produit</a>
    </section>
 </div>
 
</main>
</body>
</html>