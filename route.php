<?php

include('controller.php');
$koneksi = new database();
$action = $_GET['action'];

if ($action == "register"){
    $koneksi->register($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['address']);
}elseif ($action == "masok"){
    $koneksi->masok($_POST['username'], $_POST['password']);
}elseif ($action == "create_album"){
    $koneksi->create_album($_POST['name'], $_POST['description']);
}elseif ($action == "update_album"){
    $koneksi->update_album($_POST['name'], $_POST['description'], $_POST['id']);
}else if ($action == "create_foto"){
    $koneksi->create_foto($_POST['title'], $_FILES['file'], $_POST['album_id'], $_POST['description']);
}else if ($action == "update_foto"){
    $koneksi->update_foto($_POST['id'], $_POST['title'], $_FILES['file'], $_POST['album_id'], $_POST['description']);
}else if ($action == "like"){
    $koneksi->like($_GET['foto_id']);
}else if ($action == "comment"){
    $koneksi->comment($_POST['foto_id'], $_POST['comment']);
}else if ($action == "delete"){
    $koneksi->delete($_GET['table'], $_GET['id']);
}
