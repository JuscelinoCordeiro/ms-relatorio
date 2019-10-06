<?php
require_once __DIR__ .'/vendor/autoload.php';

//print_r($_POST);
// if(isset($_POST['conteudo'])){
//     $conteudo = json_decode($_POST['conteudo']);
// }
$json = file_get_contents('php://input');
$parametros = isset($json) ? json_decode($json) : '';

$conteudo = (isset($parametros->conteudo)? $parametros->conteudo: "");
$css = 'bootstrap.css';
$time = date("d-m-Y_H:i:s");  ;
//echo $time;

$arquivo = 'arquivo'.$time.'.pdf';
$mpdf = new \Mpdf\Mpdf();
//$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($conteudo);
$mpdf->Output($arquivo,'F');

if(file_exists($arquivo)){
    $var = file_get_contents($arquivo);
    return $var;
}else{
    echo 0;
}
//return ;