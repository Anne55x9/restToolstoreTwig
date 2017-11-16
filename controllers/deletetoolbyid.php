<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 16/11/2017
 * Time: 12:04
 */
$uri = "http://toolstorerestservice20171116012949.azurewebsites.net/Service1.svc/tools/";
$id = $_POST['id'];
$full_uri = $uri . $id;

$ch = curl_init($full_uri);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$jsondata = curl_exec($ch);
$theDeletedTool = json_decode($jsondata,true);

if ($theDeletedTook == null){
    $toolArray = false;
}else{
        $toolArray = array($theDeletedTool);
}

//print_r($toolArray);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload' => true
));

$template = $twig->loadTemplate('tools.html.twig');

$parametersToTwig = array("tools" => $toolArray);
echo $template->render($parametersToTwig);