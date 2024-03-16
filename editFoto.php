<?php 

    include_once 'controller.php';
    $db = new database();
    $id = $_GET['id'];

    if(! is_null($id)){
        $value = $db->edit_foto($id);
    } else {
        header ("location:fotos.php");
    }

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

    <form action="route.php?action=update_foto" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
        <label for="">judul foto</label>
        <input type="text" name="title" value="<?php echo $value['title'];?>" required>
        <br>
        <label for="">foto</label>
        <input type="file" name="file" accept=".png, .jpg, .jpeg" id="" img="<?php echo $value['location'];?>">
        <br>
        <label for="">album</label>
        <select name="album_id" id="">
        <?php
            $no = 1; 
            foreach ($db->albums() as $data) {
            $selected = ($value['album_id'] == $data['id']) ? 'selected' : '';
        ?>

        <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>><?php echo $data['name']; ?></option>
        
        <?php 
            }
        ?>
        </select>
        <br>
        <label for="">deskripsi</label>
        <textarea name="description" id="" cols="30" rows="10"><?php echo $data['description'] ?></textarea>
        <button type="submit">kirim</button>
    </form>
    
</body>
</html>