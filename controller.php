<?php

class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "bantai";
    var $koneksi = "";

    public function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()){
            echo "gagal terhubung oss, karena :" .mysqli_connect_errno();
        }
        session_start();
    }

    public function register($name, $username, $password, $email, $address){
        mysqli_query($this->koneksi, "INSERT INTO user values('', '$name', '$username', '$password', '$email', '$address')");
        header('location:index.php');
    }

    public function masok($username, $password){
        $user = mysqli_query($this->koneksi, "SELECT * from user where username = '$username'");
        if(mysqli_num_rows($user) >= 1){
           $find = mysqli_fetch_assoc($user);
           if($password == $find['password']){
            $_SESSION['name'] = $find['name'];
            $_SESSION['id'] = $find['id'];
            $_SESSION['status_login'] = true;
            header('location:index.php');
            exit;
            }else {
                // Password tidak sesuai
                header('location:login.php?error=wrong_password');
                exit;
            }
        }
    
        // Username tidak ditemukan
        header('location:login.php?error=user_not_found');
        exit;
    }

    public function create_album($name, $description) {
        // Pastikan $_SESSION['id'] sudah didefinisikan
        if(isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            mysqli_query($this->koneksi, "INSERT INTO album VALUES('', '$name', '$description', '$user_id', NOW())");
    
            // Cek apakah terdapat kesalahan pada query
            if(mysqli_errno($this->koneksi)) {
                echo "Terdapat kesalahan pada query: " . mysqli_error($this->koneksi);
                exit;
            }
    
            header('location:albums.php');
        } else {
            // Lakukan penanganan jika $_SESSION['id'] belum didefinisikan
            echo "Session 'id' belum didefinisikan.";
            exit;
        }
    }
    

    public function albums () {
       $data = mysqli_query($this->koneksi, "select * from album");

       while($row = mysqli_fetch_array($data)){
        $return[] = $row; 
       }

       return $return;
    }

    public function edit_album ($id) {
        $return = mysqli_query($this->koneksi, "select * from album where id='$id'");
        return $return->fetch_array();
    }
    public function edit_foto ($id) {
        $return = mysqli_query($this->koneksi, "select * from foto where id='$id'");
        return $return->fetch_array();
    }

    public function update_album ($name, $description, $id) {
        mysqli_query($this->koneksi, "update album set name='$name', description='$description' where id='$id'");
        if (mysqli_errno($this->koneksi)){
            echo "tolong di baca : " .mysqli_errno($this->koneksi);
            exit;
        } else {
            header ('location:index.php');
        }
    }

    public function delete($table, $id) {
        mysqli_query($this->koneksi, "delete from foto where album_id='$id'");
        if(mysqli_errno($this->koneksi)){
            echo "aduh kang : " .mysqli_error($this->koneksi);
        }else {
            mysqli_query($this->koneksi, "delete from `$table` where id='$id'");
        if(mysqli_errno($this->koneksi)){
            echo "angger : " .mysqli_error($this->koneksi);
        }else {
            header ('location:index.php');
        }}
    }

    public function create_foto ($title, $file, $album_id, $description) {
        move_uploaded_file($file['tmp_name'], 'assets/' . basename($file['name']));

        $location = 'assets/' .$file['name'];
        $user_id = $_SESSION['id'];
        mysqli_query($this->koneksi, "insert into foto values ('', '$title', '$description', '$location', '$album_id', '$user_id', NOW())");

        if(mysqli_errno($this->koneksi)){
            echo "tolong di baca :" .mysqli_errno($this->koneksi);
        } else {
            header('location:index.php');
        }
    }

    public function fotos(){
        $data = mysqli_query($this->koneksi, "select foto.*, count(like.id) as jumlah_like from foto left join `like` on foto.id = like.foto_id group by foto.id");
        
        while($row = mysqli_fetch_array($data)) {
            $return[] = $row;
        }

        return $return;
    }

    public function update_foto($id, $title, $file, $album_id, $description) {    
        $foto = mysqli_query($this->koneksi, "SELECT * FROM foto WHERE id = '$id'");
        $find = mysqli_fetch_array($foto);
        $user_id = $_SESSION['id'];
    
        if ($file['tmp_name']) {
            // Hapus file lama
            unlink('assets/' . basename($find['location']));
    
            // Pindahkan file baru
            move_uploaded_file($file['tmp_name'], 'assets/' . basename($file['name']));
            $location = 'assets/' . $file['name'];
    
            // Update data foto
            mysqli_query($this->koneksi, "UPDATE foto SET title='$title', description='$description', location='$location', album_id='$album_id', user_id='$user_id', date=NOW() WHERE id='$id'");
    
            // Redirect ke halaman fotos.php setelah berhasil update
            header('location:fotos.php');
            exit;
        } else {
            // Update data foto tanpa mengganti file
            mysqli_query($this->koneksi, "UPDATE foto SET title='$title', description='$description', album_id='$album_id', user_id='$user_id', date=NOW() WHERE id='$id'");
            
            // Redirect ke halaman fotos.php setelah berhasil update
            header('location:fotos.php');
            exit;
        }
    }

    public function like($foto_id){
        $user_id = $_SESSION['id'];
        $chek = mysqli_query($this->koneksi, "select * from `like` where user_id='$user_id'");

        if (mysqli_num_rows($chek) >= 1){
            mysqli_query($this->koneksi, "delete from `like` where foto_id='$foto_id' and user_id='$user_id'");
            header('location:fotos.php');
        } else {
            mysqli_query($this->koneksi, "insert into `like` values ('', '$foto_id', '$user_id', now())");
            header('location:fotos.php');
        }
    }

    public function comments(){
        $data = mysqli_query($this->koneksi, "SELECT komentar.*, user.name AS username 
                                                FROM komentar 
                                                INNER JOIN user ON komentar.user_id = user.id");
       while($row = mysqli_fetch_array($data)){
        $return[] = $row; 
       }

       return $return;
    }
    
    public function comment($foto_id, $comment){
        $user_id = $_SESSION['id'];

        mysqli_query($this->koneksi, "insert into komentar values ('', '$comment', '$foto_id', '$user_id', now())");
        header("location:comment.php?foto_id=$foto_id");
    }

}