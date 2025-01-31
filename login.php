<?php
// isset untuk cek 
//? if (isset($_POST['login'])){
//?     echo "Mantab";
// }
include "service/database.php";
session_start();

$login_message = "";

if (isset($_SESSION['is_login'])){
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256",$password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";
    $result  = $db->query($sql);

    if ($result->num_rows > 0) {
        // $_SESSION['login'] = true;
        // $_SESSION['username'] = $username;
        // header("Location: index.php");
        //? echo "session_start";
        //? $data = $result->fetch_assoc();
        //? echo "Login berhasil! Selamat datang, ". $data['username'];
        
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data['username'];
        $_SESSION["is_login"] = true; 
        header("Location: dashboard.php");
    } else {
        $login_message = "Username/Password salah!";
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
    <title>Login</title>
</head>

<body>
    <?php include "layout/header.html" ?>

    <main class="bg-gray-900 body-font items-center text-white">
        <div class="container mx-auto p-5 items-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Login Akun</h1><br>
            <form action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit" name="login">Login</button>
            </form>
            <i><?= $login_message ?></i>
        </div>
    </main>

    <?php include "layout/footer.html" ?>
</body>

</html>