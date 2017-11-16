<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 16/11/2017
 * Time: 12:03
 */
$uri = "http://toolstorerestservice20171116012949.azurewebsites.net/Service1.svc/tools";
$jsondata = file_get_contents($uri);
//print_r($jsondata);
$convertToAssociativeArray = true;
$tools = json_decode($jsondata,$convertToAssociativeArray);

//print:($tools);
//return;

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('tools.html.twig');

$parametersToTwig = array("tools"=> $tools);
echo $template->render($parametersToTwig);


