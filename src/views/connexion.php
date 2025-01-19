<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Librairie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #444;
            text-align: center;
        }

        div {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div>
        <h1>Connexion</h1>
        <form action="?do=connexion" method="post" style="display: flex; flex-direction: column; width: 300px; gap: 10px;">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            <input type="submit" value="Connexion">
        </form>
        <a href="?do=inscription">Inscription</a>
    </div>
</body>

</html>