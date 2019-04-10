<?php
    //" Image :". '<img src="' . $post["photo"] . '" /></p>'
    session_start();
    if (!$_SESSION["connected"]){
        header("Location: index.html");
    }

    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "root";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo ('Connexion échouée : ' . $e->getMessage());
    }
    $id_post=$_GET["id"];
    $_SESSION["currentPost"]=$_GET["id"];
    $stmt = $dbh->prepare("SELECT * FROM post WHERE id=$id_post;");
    $stmt->execute();
    $post=$stmt->fetch();
    echo ("Titre : ".$post["title"]."<br>");
    echo ("Content : ".$post["content"]."<br>");
    echo (" Image :". '<img src="' . $post["photo"] . '" /></p>');



?>

<html>
    <body>
        <form method="post" action="registerComment.php">   
            Votre commentaire :<textarea rows="5" cols="20" name="content" required></textarea><br>
        <input type="submit" name="register" value="Publier le commentaire">
    </form>
    </body>
</html>

<?php
    $stmt = $dbh->prepare("SELECT * FROM comment WHERE post_id=$id_post;");
    $stmt->execute();
    $postComment=$stmt->fetchAll();
    echo ("Commentaires : <br><br>");
    foreach($postComment as $comment){
        echo ("<p>Auteur : ".$comment["user_id"]."<br>");
        echo ("Commentaire : ".$comment["content"]."</p>");
    }
?>