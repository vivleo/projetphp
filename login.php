<?php
ini_set('display_errors', 'on');
if (!isset($_POST["conn"])){
    header("Location: index.html");
    exit;
}
    session_start();
    $dsn = "mysql:host=localhost;dbname=pws";
    $usernamebd = "root";
    $passwordbd = "root";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $stmt = $dbh->prepare("SELECT id, username, password FROM user WHERE username= :username AND password= :password;");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $current_user=$stmt->fetch();
    //var_dump($current_user);
    
    $user=$current_user["username"];
    $pass=$current_user["password"];
    //var_dump($user);
    //var_dump($pass);
    //var_dump($user==$username && $pass==$password);
    
    if ($user==$username && $pass==$password){
        $_SESSION["connected"]=true;
        $_SESSION["username"]=$username;
        $_SESSION["id"]=$current_user["id"];
        header("Location: accueil.php");
        exit;
    }
    else{
    
        header("Location: index.html");
        exit;
    }

    
?>