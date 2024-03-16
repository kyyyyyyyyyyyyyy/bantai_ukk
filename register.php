<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="route.php?action=register" method="post">
        <label for="">nama</label>
        <input type="text" name="name" placeholder="masukan nama" required>
        <br>
        <label for="">email</label>
        <input type="text" name="email" placeholder="masukan email" required>
        <br>
        <label for="">username</label>
        <input type="text" name="username" placeholder="masukan username" required>
        <br>
        <label for="">password</label>
        <input type="text" name="password" placeholder="masukan password" required>
        <br>
        <label for="">alamat</label>
        <textarea name="address" id="" cols="30" rows="10">masukan alamat</textarea>
        <br>
        <button type="submit">kirim</button>
    </form> 
    
</body>
</html>