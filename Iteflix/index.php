<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela de Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 60px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #e50914;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #f6121d;
        }
    </style>
</head>
<body>
    <form method="post" action="login.php">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required />
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required />
        <input type="submit" value="ENVIAR" />
    </form>
</body>
</html>





