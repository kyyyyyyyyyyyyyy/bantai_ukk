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


    <div>
        <?php foreach($db->comments() as $data){ ?>
        <h3><?php echo $data['username'] ?></h3>
        <p><?php echo $data['comment'] ?></p>
        <?php } ?>
    </div>

    <form action="route.php?action=comment" method="post">
        <input type="hidden" name="foto_id" value="<?php echo $_GET['foto_id'] ?>">
        <textarea name="comment" id="" cols="30" rows="10">masukan komentar</textarea>
        <button type="submit">kirim</button>
    </form>
    
</body>
</html>