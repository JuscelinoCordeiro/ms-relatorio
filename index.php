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
    echo $filename;
    // print_r(json_encode(array('status' => '1', 'dados' => 'deu certo')));
}else{
    print_r(json_encode(array('status' => '0', 'dados' => 'deu ruim')));
}

//return $$mpdf->Output();;