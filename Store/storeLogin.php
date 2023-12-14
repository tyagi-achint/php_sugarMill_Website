<!DOCTYPE html>
<html lang="en">


<?php include '../server.php'; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Login</title>
    <!-- Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>

    <div class="login-container">
        <h2>Store Login</h2>
        <form class="login-form" action="storeHandleLogin.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="storeSignup.php" class="signupLink">Sign up</a></p>
        <p><a href="../index.php" class="signupLink">Home</a></p>


    </div>


</body>

</html>