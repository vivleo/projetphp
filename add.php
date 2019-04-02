<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="accueil.phtml">Retour</a>
</body>
</html>

<?php
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo ('Connexion échouée : ' . $e->getMessage());
    }
    $user_id=$_SESSION["id"];
    $timestamp=time();
    $title=$_POST["title"];
    $title=$_POST["content"];
    if (isset($_FILES["image"])){
        $photo=fopen($_FILES["image"], "rb");
    }
    $stmt = $dbh->prepare("INSERT INTO `post` (user_id, timestamp, title, content, photo) VALUES (:user_id, :timestamp, :title, :content, :photo)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':photo', $photo);

    $stmt->execute();
    
?>