<?php 

    session_start();

    if(isset($_SESSION['status_login'])){
        header('location:index.php');
        die;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="route.php?action=masok" method="post">
        <label for="">username</label>
        <input type="text" name="username" placeholder="masukan username" required>
        <br>
        <label for="">passwsord</label>
        <input type="password" name="password" placeholder="masukan password" required>
        <button type="submit">kirim</button>
    </form> 
    
</body>
</html>