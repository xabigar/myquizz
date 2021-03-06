<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
$ns = "http://localhost/wsrv17/myquiz/php/getQuestion.php?wsdl";
$server = new soap_server;
$server->configureWSDL('lortuDatuak',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
$server->wsdl->addComplexType(
    	'galdera',
   	 	'complexType',
   	 	'struct',
    	'all',
    	'',
   		array(
       	 	'testua' => array('name' => 'testua', 'type' => 'xsd:string'),
        	'zuzena' => array('name' => 'zuzena', 'type' => 'xsd:string'),
        	'zail' => array('name' => 'zail', 'type' => 'xsd:int')
    	)
);

$server->register('lortuDatuak',array('x'=>'xsd:int'),array('y'=>'tns:galdera'),$ns);

//funtzioa inplementatzen dugu
function lortuDatuak($x){
	include 'configEzarri.php';
	$ema = mysqli_query($link, "SELECT * FROM questions WHERE id=". $x);
	$lerroKop = mysqli_num_rows($ema);
	if($lerroKop==1){
		$row=mysqli_fetch_array($ema,MYSQLI_ASSOC);	
		return array(
			'testua'=> $row['galdera'],
			'zuzena'=> $row['zuzena'],
			'zail'=> $row['zail']
		);		
	}else{ 
		return array(
			'testua'=> "",
			'zuzena'=> "",
			'zail'=> 0
		);
	}	
}
//nusoap klaseko sevice metodoari dei egiten diogu
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>