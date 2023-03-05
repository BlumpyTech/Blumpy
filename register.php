<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'root');
if(isset($_POST['sendButton'])){
   if(!empty($_POST['username']) AND !empty($_POST['password'])){
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    $insertUser = $bdd->prepare('INSERT INTO users(username, password)VALUES(?, ?)');
    $insertUser->execute(array($username, $password));
    
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $recupUser->execute(array($username, $password));
    if($recupUser->rowCount() > 0){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = $recupUser->fetch()['id'];
    }



    
    }else {
        echo "Veuillez complétez les champs!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <h1 align="center">Register</h1>
    <form method="POST" action="" align="center">
        <input type="text" name="username" autocomplete="off">
        <br/>
        <input type="password" name="password" autocomplete="off">
        <br/><br/>

        <input type="submit" name="sendButton">
</body>
</html>