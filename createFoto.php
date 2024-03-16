<?php 

    require 'controller.php';
    $db = new database();

    if (!isset($_SESSION['status_login'])){
        header('location:login.php');
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

    <form action="route.php?action=create_foto" method="post" enctype="multipart/form-data">
        <label for="">judul foto</label>
        <input type="text" name="title" required>
        <br>
        <label for="">foto</label>
        <input type="file" name="file" accept=".png, .jpg, .jpeg" id="" required>
        <br>
        <label for="">album</label>
        <select name="album_id" id="">
            <?php
                $no = 1; 
                foreach($db->albums() as $data){
            ?>
            <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
            <?php 
                }
            ?>
        </select>
        <br>
        <label for="">deskripsi</label>
        <textarea name="description" id="" cols="30" rows="10"></textarea>
        <button type="submit">kirim</button>
    </form>
    
</body>
</html>