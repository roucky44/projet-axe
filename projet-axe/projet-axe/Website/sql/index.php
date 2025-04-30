<?php

require_once("connexion.php"); // me permet de récupérer ma connexion


/// Create Read Update Delete


//echo '<pre>'; 
//var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
// la méthode fetchALL me renvoit un tableau multi dimentionnel avec tous mes enregistrements en base
// le PDO FETCH_ASS est une constante qui me permet d'avoir en index de mes tableaux, le nom des colonnes
//echo'</pre>';


///// 
///// EXEC
/////

// $sql = "INSERT INTO book (title, author, date_publication, category_idcategory) 
// VALUES( 'Le petit prince', 'Sacha Lacombe', '1997-03-28', 1 )";

// $pdo->exec($sql);

///// 
///// PREPARE & EXECUTE
/////


// try{
//     $stmt = $pdo->prepare("INSERT INTO book (title, author, date_publication, category_idcategory) 
//     VALUES( :title, :author, :date_publication, :category )");

//     $stmt->execute([
//         "title" => "Le rouge et le noir",
//         "author" => "Standall",
//         "date_publication" => "1945-01-01",
//         "category" => 1,
//     ]);

//     $stmt->execute([
//         "title" => "One piece",
//         "author" => "Oda",
//         "date_publication" => "1975-01-01",
//         "category" => 1,
//     ]);
// } catch(PDOException $e) {
//     echo $e->getMessage();
// }

if ($_POST) {

    // var_dump($_POST);
    $title = $_POST["title"];
    $author = $_POST["author"];
    $date_publication = $_POST["date_publication"];

    try {
        $stmt = $pdo->prepare("INSERT INTO book (title, author, date_publication, category_idcategory) 
    VALUES( :title, :author, :date_publication, :category )");

        $stmt->execute([
            "title" => $title,
            "author" => $author,
            "date_publication" => $date_publication,
            "category" => 1,
        ]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

if(isset($_GET['action']) && $_GET['action'] == 'delete') {

    $idbook = $_GET['id_book'];

    try {
        $stmt = $pdo->prepare("DELETE FROM book WHERE idbook = :idbook");

        $stmt->execute([
            "idbook" => $idbook,
        ]);

        echo "Le livre a bien été supprimé !";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

if(isset($_GET['action']) && $_GET['action'] == 'modify') {

    $idbook = $_GET['id_book'];

    // je récupère en bdd toutes les infos lié à cet id
    // faudra variabiliser le livre 
    // et pré-charger ses infos en dans le formulaire
    // ajouter un input type hidden pour stocker l'id dans le formulaire
    // créer un formulaire de modification

    try {
        $stmt = $pdo->prepare("DELETE FROM book WHERE idbook = :idbook");

        $stmt->execute([
            "idbook" => $idbook,
        ]);

        echo "Le livre a bien été supprimé !";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}


///// 
///// SELECT
/////
$stmt = $pdo->query("SELECT * FROM book"); // PDO STATEMENT
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Mes livres en BDD</h1>

    <table border="1">
        <thead>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Supprimer</th>
            <th>Modifier</th>
        </thead>

        <tbody>

            <?php

            foreach ($books as $key => $book) {
                echo "<tr>";
                echo "<td>" . $book["title"] . "</td>";
                echo "<td>" . $book["author"] . "</td>";
                echo "<td>" . $book["date_publication"] . "</td>";
                echo "<td>" . $book["category_idcategory"] . "</td>";
                echo "<td> <a href='?id_book=". $book["idbook"] . "&action=delete'> Supprimer </a> </td>";
                echo "<td> <a href='?id_book=". $book["idbook"] . "&action=modify'> Modifier </a> </td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>

    <br>
    <br>
    <form method="POST">

        <label for="title">Titre:</label>
        <input type="text" name="title" id="title" placeholder="Titre">


        <label for="author">Auteur:</label>
        <input type="text" name="author" id="author" placeholder="Auteur">


        <label for="date_publication">Titre:</label>
        <input type="date" name="date_publication" id="date_publication">

        <input type="submit" value="Créer livre">

    </form>

</body>

</html>