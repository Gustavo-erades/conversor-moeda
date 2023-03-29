<?php
    //consumir API do Banco Central para pegar o valor de câmbio das moedas em tempo real
    //pegar a data
    $inicio=date("m-d-Y",strtotime("-7 days"));
    $fim=date("m-d-Y");
    //dólar
    $url_dolar='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    $dados_dolar=json_decode(file_get_contents($url_dolar), true);
    $cotacao_dolar=$dados_dolar["value"][0]["cotacaoCompra"];
    //euro
    $url_euro='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'EUR\'&@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    $dados_euro=json_decode(file_get_contents($url_dolar),true);
    $cotacao_euro=$dados_euro["value"][0]["cotacaoCompra"];
    //libra
    $url_libra='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'GBP\'&@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    $dados_libra=json_decode(file_get_contents($url_libra), true);
    $cotacao_libra=$dados_libra["value"][0]["cotacaoCompra"];
    //internacionalização para valores monetários
    $padrao=numfmt_create("pt_BR",NumberFormatter::CURRENCY)
?>
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
                                <td>
                                    <label for="dolar">
                                        <?php print numfmt_format_currency($padrao, $cotacao_dolar, "BRL") ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" name="moeda" id="euro" value="euro"></th>
                                <td><label for="euro">Euro</label></td>
                                <td>
                                    <label for="euro">
                                        <?php print numfmt_format_currency($padrao, $cotacao_euro, "EUR") ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="radio" name="moeda"  id="libra" value="libra"></th>
                                <td><label for="libra">Libra</label></td>
                                <td>
                                    <label for="libra">
                                        <?php print numfmt_format_currency($padrao, $cotacao_libra, "GBP") ?>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit">converter</button>
            </form>
        </div>
        <div id="aviso"><b>OBS:</b> A <b>cotação</b> utilizada vem da API do <b>Banco Central do Brasil<b></div>
    </div>
</body>
</html>
