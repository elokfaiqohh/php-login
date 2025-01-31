<?php

include "service/database.php";
session_start();
$register_message = "";

if (isset($_SESSION['is_login'])){
    header("Location: dashboard.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $register_message = "Username dan password harus diisi!";
    }else{
        $hash_password = hash("sha256",$password);
    
        try{
            $sql = "INSERT INTO users (username, password) VALUES ('$username' , '$hash_password')";
            
            if($db->query($sql)) {
                $register_message = "Berhasil mendaftar!";
            }else{
                $register_message = "Gagal mendaftar! ". $db->error;
            }
        } catch(mysqli_sql_exception){
            $register_message = "Username already";
    
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>

<body>
    <?php include "layout/header.html" ?>

    <main class="bg-gray-900 body-font items-center text-white">
        <div class="container mx-auto p-5 items-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Daftar Akun</h1><br>
            <form action="register.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" ><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" ><br><br>
                <button type="submit"  name="register">Daftar Sekarang</button>
            </form>
            <i><?= $register_message ?></i>
        </div>
    </main>

    <?php include "layout/footer.html" ?>
</body>

</html>