<?php
if (!isset($_POST["conn"])){
    header("Location: index.html");
    exit;
}
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    
    $username=$_POST["username"];
    $password=$_POST["password"];
    $stmt = $dbh->prepare("SELECT * FROM user WHERE username=".$username." AND password=".$password.";");
    $current_user=$stmt->fetch();

    if ($current_user!==null){
        $_SESSION["connected"]=true;
        $_SESSION["username"]=$username;
        $_SESSION["id"]=$current_user["id"];
        header("Location: accueil.phtml");
        exit;
    }
    else{
        header("Location: index.html");
    }
?>