<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Registration</title>
    <!-- CSS  -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>

    <div class="registration-container">
        <h2>Registration Form</h2>

        <form class="registration-form" action="storeHandleSignup.php" method="post">
            <input type="text" id="name" name="name" placeholder="Name" required>
            <input type="text" id="contact" name="contact" placeholder="Contact" required>
            <input type="text" id="address" name="address" placeholder="Address" required>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="storeLogin.php" class="loginLink">Login</a></p>
        <p><a href="../index.php" class="loginLink">Home</a></p>
    </div>

</body>

</html>