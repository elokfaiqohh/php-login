<?php
session_start();

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <?php include "layout/header.html" ?>

    <main class="bg-gray-900 body-font items-center min-height-[100vh] text-white">
        <div class="container mx-auto flex flex-wrap p-5 flex-col items-left">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Selamat datang, <?= $_SESSION["username"]  ?> </h1>
            <form action="dashboard.php" method="POST">
            <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </main>

    <?php include "layout/footer.html" ?>
</body>

</html>