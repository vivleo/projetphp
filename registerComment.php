<?php
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
    $timestamp=time();
    $stmt = $dbh->prepare("INSERT INTO `comment` (post_id, user_id, timestamp, content) 
                           VALUES (:post_id, :user_id, :timestamp, :content)");

    $stmt->bindParam(':post_id', $_SESSION["currentPost"]);
    $stmt->bindParam(':user_id', $_SESSION["id"]);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':content', $_POST["content"]);
    $stmt->execute();

    header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;

?>