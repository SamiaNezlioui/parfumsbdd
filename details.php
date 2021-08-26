<?php
// On démarre une session
session_start();

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('./connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $article = $query->fetch();

    // On vérifie si le produit existe
    if(!$article){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
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
        <h1>Fiche produit</h1>
            <p><?= $article['nom']?></p>
            <p>prix: <?= $article['prix']?>€</p>
            <p>description: <?=$article['description']?></p>
            <img src="./images/<?=$article['image']?>" width="200"/>
       
            <a href="add.php" class="btn btn-primary">ajouter un produit</a>
            <p><a href="edit.php?id=<?=$article['id']?>">Modifier</a>
            <a href="delete.php?id=<?=$article['id']?>">Supprimer</a></p>
    </section>
 </div>
 </main> 
</body>
</html>