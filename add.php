<?php
    ini_set('display_errors', 'on');
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "root";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo ('Connexion échouée : ' . $e->getMessage());
    }
    $user_id=$_SESSION["id"];
    $timestamp=time();
    $title=$_POST["title"];
    $content=$_POST["content"];
    if(isset($_FILES['image']))
    {
        $errors=array();
        $allowed_ext= array('jpg','jpeg','png','gif');
        $file_name =$_FILES['image']['name'];
        //$file_name =$_FILES['image']['tmp_name'];
        $file_ext = strtolower( end(explode('.',$file_name)));


        $file_size=$_FILES['image']['size'];
        $file_tmp= $_FILES['image']['tmp_name'];
        echo $file_tmp;echo "<br>";

        $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
        $data = file_get_contents($file_tmp);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //echo "Base64 is ".$base64;
    }
    
    $stmt = $dbh->prepare("INSERT INTO `post` (user_id, timestamp, title, content, photo) VALUES (:user_id, :timestamp, :title, :content, :photo)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':photo', $base64);

    $stmt->execute();
    header("Location: display.php");
    
?>