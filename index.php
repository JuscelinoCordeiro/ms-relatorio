<?php
require_once __DIR__ .'/vendor/autoload.php';


$json = file_get_contents('php://input');
$parametros = isset($json) ? json_decode($json) : '';

$conteudo = (isset($parametros->conteudo)? $parametros->conteudo: "");
$css = 'bootstrap.css';
//$css = 'estilo.css';
$time = date("d-m-Y_H:i:s");  ;
//echo $time;

$filename = '/relatorios/arquivo'.$time.'.pdf';
$filepath = __DIR__ .'/relatorios/arquivo'.$time.'.pdf';


$mpdf = new \Mpdf\Mpdf();

//$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($conteudo);
$mpdf->Output($filepath,'F');
// return $mpdf->Output(\Mpdf\Output\Destination::DOWNLOAD);

if(file_exists($filepath)){
    // echo $filename;
    // echo (json_encode(array('status' => '1', 'dados' => utf8_encode($filename))));
    echo json_encode(array('status' => '1', 'dados' => $filename));
}else{
    echo (json_encode(array('status' => '0', 'dados' => 'erro')));
}
