<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icone-moeda.png" type="image/x-icon">
    <title>Conversor de moeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <div id="formulario">
            <form action="resultado.php" method="post">
                <div id="valor_user">
                    <h1>Valor a converter:</h1>
                    <span>R$</span>
                    <input type="number" name="num" step="0.01">
                </div>
                <div id="moedas">
                    <h2>Moedas:</h2>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Moeda</th>
                                <th scope="col">Cotação Atual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><input type="radio" name="moeda" id="dolar" value="dolar"></th>
                                <td><label for="dolar">Dólar</label></td>
                                <td><label for="dolar">5.25</label></td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" name="moeda" id="euro" value="euro"></th>
                                <td><label for="euro">Euro</label></td>
                                <td><label for="euro">5.66</label></td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" name="moeda"  id="libra" value="libra"></th>
                                <td><label for="libra">Libra</label></td>
                                <td><label for="libra">6.42</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit">converter</button>
            </form>
        </div>
    </div>
</body>
</html>