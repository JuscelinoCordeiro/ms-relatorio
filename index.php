<?php
require_once __DIR__ .'/vendor/autoload.php';


$json = file_get_contents('php://input');
$parametros = isset($json) ? json_decode($json) : '';

$conteudo = (isset($parametros->conteudo)? $parametros->conteudo: "");
// echo $conteudo;
// exit();
$css = 'bootstrap.css';
$time = date("d-m-Y_H:i:s");  ;

$filename = '/relatorios/arquivo'.$time.'.pdf';
$filepath = __DIR__ .'/relatorios/arquivo'.$time.'.pdf';


$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($conteudo);
$mpdf->Output($filepath,'F');

if(file_exists($filepath)){
    echo json_encode(array('status' => '1', 'dados' => $filename));
}else{
    echo (json_encode(array('status' => '0', 'dados' => 'erro')));
}
