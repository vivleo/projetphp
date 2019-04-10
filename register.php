<?php
if (!isset($_POST["register"])){
    header("Location: index.html");
    exit;
}
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
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
    $passwordConf=$_POST["passwordconf"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["email"];
    if ($password==$passwordConf){
        try{
            $stmt = $dbh->prepare("SELECT * FROM user WHERE username="
            .$username." AND password=".$password." AND email=".$email.";");
            $current_user=$stmt->fetch();
            if ($current_user==null){
                $_SESSION["connected"]=true;
                $_SESSION["username"]=$username;
                $_SESSION["id"]=$current_user["id"];
                $stmt = $dbh->prepare("INSERT INTO `user` (username, password, firstname, lastname, email) VALUES (:username, :password, :firstname, :lastname, :email)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':email', $email);

                $stmt->execute();
                header("Location: accueil.php");
                exit;
            }
        }catch(Exception $e){
            echo ("Erreur : ".$e->getMessage()."\n");
        }
    }
?>