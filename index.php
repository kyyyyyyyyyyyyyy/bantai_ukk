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

    <h1>ini ink</h1>

    <form action="route.php?action=create_album" method="post">
        <label for="">nama</label>
        <input type="text" name="name" placeholder="masukan nama" required>
        <br>
        <label for="">deskripsi</label>
        <textarea name="description" id="" cols="30" rows="10">masukan alamat</textarea>
        <br>
        <button type="submit">kirim</button>
    </form> 

    <table>
        <thead>
            <tr>
                <td>no</td>
                <td>nama album</td>
                <td>deskripsi</td>
                <td>aksi</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            foreach($db->albums() as $data){
        ?>
            <tr>
                <td><?php echo $no++ ."."; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['description']; ?></td>
                <td>
                    <a href="editAlbum.php?id=<?php echo $data['id'] ?>">aksi</a>
                    <a href="route.php?action=delete&table=album&id=<?php echo $data['id'] ?>">hapus</a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbod>
    </table>

    <a href="fotos.php">up</a>
   
</body>
</html>