<?php
    //pega a data atual
    $fuso= new DateTimeZone('America/Sao_Paulo');
    $data=new DateTime('now', $fuso);
    //pega o número digitado pelo usuário
    $num=isset($_POST["num"])?$_POST["num"]:"";
    //pega a opção selecionada pelo usuário
    $opcao=isset($_POST["moeda"])?$_POST["moeda"]:"";
    //cálculo e armazenamento do resultado
    if($opcao!="" && $num!=""){
        if($opcao=="dolar"){
            $nome_moeda="Dólar";
            $cotacao=5.25;
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="euro"){
            $nome_moeda="Euro";
            $cotacao=5.66;
            $moeda=$num/$cotacao;
            $resultado=$moeda;
        }elseif($opcao=="libra"){
            $nome_moeda="Libra";
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
                <?php echo "Cotação usada: <span>R\$".number_format($cotacao,2,",",".")."</span>"; ?>
           </div>
           <p>
                <?php echo "<span>R\$".number_format($num,2,",",".")."</span> equivalem a <span>US\$".number_format($moeda,2,",",'.')."</span> atualmente."?>
           </p>
           <button onclick="javascript:history.go(-1);">Voltar</button>
        </div>
    </div>
</body>
</html>