<?php
    //pega a data atual
    $fuso= new DateTimeZone('America/Sao_Paulo');
    $data=new DateTime('now', $fuso);
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
            $nome_moeda="Dólar";
            $sigla_moeda="USD";
            $cotacao=5.25;
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="euro"){
            $nome_moeda="Euro";
            $sigla_moeda="EUR";
            $cotacao=5.66;
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="libra"){
            $nome_moeda="Libra";
            $sigla_moeda="GBP";
            $cotacao=6.42;
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
    </div>
</body>
</html>