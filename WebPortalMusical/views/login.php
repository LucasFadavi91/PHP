<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="author" value="Lucas Fadavi"/>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <form name='datos' action='./controllers/logincontrol.php' method='POST'>
        <label for="username">Email</label>
        <input type="email" name="username" required/><br><br>

        <label for="passcode">Password</label>
        <input type="text" name="passcode" required/><br><br>

        <input type="submit" value="Iniciar sesión"/>
    </form>
</body>
</html>


