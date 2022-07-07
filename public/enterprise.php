<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, PATCH, DELETE");

require_once "../autoload.php";

use api\Enterprise;
use api\Unity;




$AUTH_USER = 'admin';
$AUTH_PASS = 'admin';

header('Cache-Control: no-cache, must-revalidate, max-age=0');
$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
$is_not_authenticated = (!$has_supplied_credentials ||
    $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
    $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
);
if ($is_not_authenticated) {
    header('HTTP/1.1 401 Authorization Required');
    header('WWW-Authenticate: Basic realm="Access denied"');
    exit;
}



$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}

$enterprise = new Enterprise();
$unit = new Unity();

$arrayRequest = explode("/", $_SERVER['REQUEST_URI']);


$data = json_decode(file_get_contents('php://input'));



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (end($arrayRequest) === "enterprise.php") {

            $enterprises =  $enterprise->getAllEnterprises();
            http_response_code(200);
            print_r(json_encode($enterprises, JSON_PRETTY_PRINT));
        } else {
            $idEnterprise = end($arrayRequest);
            $enterprise = $enterprise->getEnterprise($idEnterprise);
            http_response_code(200);
            print_r(json_encode($enterprise, JSON_PRETTY_PRINT));
        }

        break;
    case 'POST':
        $idEnterprise =  $enterprise->createEnterprise($data);

        $amount_blocs = intval($data->blocs);

        for ($i = 1; $i <= $amount_blocs; $i++) {
            $bloc = $i;
            $UnitysBloc = intval($data->units_per_bloc);

            for ($i = 1; $i <= $UnitysBloc; $i++) {
                $unit->createUnity($data, $bloc, $idEnterprise);
            }
        }

        http_response_code(201);
        $response = ['status' => 'success'];
        print_r(json_encode($response, JSON_PRETTY_PRINT));
        break;


    case 'PATCH':
        $idEnterprise = end($arrayRequest);
        $enterprises =  $enterprise->updateEnterprise($idEnterprise, $data);

        if ($enterprises == 1) {
            http_response_code(200);
            $response = ['status' => 'success'];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
        }

        if ($enterprises != 1) {
            http_response_code(403);
            $response = ['status' => 'error'];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
        }

        break;
    case 'DELETE':

        $idEnterprise = end($arrayRequest);
        $enterprises =  $enterprise->deleteEnterprise($idEnterprise);

        if ($enterprises == 1) {
            http_response_code(200);
            $response = ['status' => 'success'];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
        }

        if ($enterprises != 1) {
            http_response_code(403);
            $response = ['status' => 'error'];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
        }

        break;

    default:
        http_response_code(403);
        $response = ['status' => 'other'];
        print_r(json_encode($response, JSON_PRETTY_PRINT));
        break;
}
