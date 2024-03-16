<?php 
    include 'controller.php';
    $db = new database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>
        <thead>
            <tr>
                <td>no</td>
                <td>judul</td>
                <td>foto</td>
                <td>deskripsi</td>
                <td>aksi</td>
                <td>response</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            foreach($db->fotos() as $data){
        ?>
            <tr>
                <td><?php echo $no++ ."."; ?></td>
                <td><?php echo $data['title']; ?></td>
                <td><img src="<?php echo $data['location']; ?>" alt=""></td>
                <td><?php echo $data['description']; ?></td>
                <td>
                    <a href="editFoto.php?id=<?php echo $data['id'] ?>">aksi</a>
                    <a href="route.php?action=delete&table=foto&id=<?php echo $data['id'] ?>">hapus</a>
                </td>
                <td>
                    <p><?php echo $data['jumlah_like'] ?></p>
                    <a href="route.php?action=like&foto_id=<?php echo $data['id'] ?>">like</a>
                    <br>
                    <a href="comment.php?foto_id=<?php echo $data['id'] ?>">comment</a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    
</body>
</html>