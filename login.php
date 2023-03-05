<?php 
$bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'root');
if(isset($_POST['sendButton'])){
    if(!empty($_POST['username']) AND !empty($_POST['password'])){
        $username = htmlspecialchars($_POST['username']);
        $password = sha1($_POST['password']);

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $recupUser->execute(array($username, $password));

        if($recupUser->rowCount() > 0){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header(Location: index.php);

        }else{
            echo "Votre mot de passe ou pseudo est incorrect.";
        }

    }
}else{
    echo "Veuillez complétez les champs!";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body align="center">
<h1 align="center">Login</h1>
    <from method="POST" action="" align="center">
        <input type="text" name="username">
        <br>
        <input type="password" name="password">
        <br>
        <input type="submit" name="sendButton">
    </from>
    
</body>
</html>