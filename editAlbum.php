<?php

include('controller.php');
$db = new database();
$id = $_GET['id'];

if(! is_null($id)){
    $value = $db->edit_album($id);
} else {
    header('location:index.php');
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

    <form action="route.php?action=update_album"  method="post">
        <label for="">nama album</label>
        <input type="text" name="name" value="<?php echo $value['name'] ?>">
        <br>
        <label for="">nama album</label>
        <textarea name="description" id="" cols="30" rows="10"><?php echo $value['description'] ?></textarea>
        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
        <button type="submit">kirim</button>
    </form>
    
</body>
</html>