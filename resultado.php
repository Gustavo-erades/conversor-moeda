<?php
    //pega a data atual
    $fuso= new DateTimeZone('America/Sao_Paulo');
    $data=new DateTime('now', $fuso);
    //pega a data atual para usar a API do Banco Central Brasileiro
    $inicio=date("m-d-Y", strtotime("-7 days"));
    $fim=date("m-d-Y");
    //pega o número digitado pelo usuário
    $num=isset($_POST["num"])?$_POST["num"]:"";
    //pega a opção selecionada pelo usuário
    $opcao=isset($_POST["moeda"])?$_POST["moeda"]:"";
    //padrão para internacionalização de moeda
    //biblioteca intl
    $padrao=numfmt_create("pt-BR",NumberFormatter::CURRENCY);
    //cálculo e armazenamento do resultado
    if($opcao!="" && $num!=""){
        if($opcao=="dolar"){
            // URL para Api para pegar valor do dólar direto do Banco Central do Brasil
            $url_dolar='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            $dados=json_decode(file_get_contents($url_dolar), true);
            $cotacao= $dados["value"][0]["cotacaoCompra"];
            //segue com o cálculo normal
            $nome_moeda="Dólar";
            $sigla_moeda="USD";
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="euro"){
            // URL para Api para pegar valor do dólar direto do Banco Central do Brasil
            $url_euro='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'EUR\'&@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            $dados=json_decode(file_get_contents($url_euro), true);
            $cotacao= $dados["value"][0]["cotacaoCompra"];
            $nome_moeda="Euro";
            $sigla_moeda="EUR";
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="libra"){
            // URL para Api para pegar valor do dólar direto do Banco Central do Brasil
            $url_libra='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'GBP\'&@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            $dados=json_decode(file_get_contents($url_libra), true);
            $cotacao= $dados["value"][0]["cotacaoCompra"];
            $nome_moeda="Libra";
            $sigla_moeda="GBP";
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }
    }else{
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icone-moeda.png" type="image/x-icon">
    <title>Conversor de moeda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <div id="resposta">
            <h1 id="data">
                <?php  echo $data->format('d/m/y');?>
                
            </h1>
           <div id="moeda2">
                <?php echo "Moeda usada: <span>".$nome_moeda."<span>" ?>
           </div>
           <div id="cotacao2">
                <?php echo "Cotação usada: <span>".numfmt_format_currency($padrao,$cotacao,"BRL")."</span>"; ?>
           </div>
           <p>
                <?php echo "<span>".numfmt_format_currency($padrao,$num,"BRL")."</span> equivalem a <span>".numfmt_format_currency($padrao,$resultado,$sigla_moeda)."</span> atualmente."?>
           </p>
           <button onclick="javascript:history.go(-1);">Voltar</button>
        </div>
        <div id="aviso"><b>OBS:</b> A <b>cotação</b> utilizada vem da API do <b>Banco Central do Brasil<b></div>
    </div>
</body>
</html>
