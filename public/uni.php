<?php

print_r($_SERVER['REQUEST_METHOD']);

echo"<pre>";
var_dump(explode("/", $_SERVER['REQUEST_URI']));
echo"</pre>";


$data = json_decode(file_get_contents('php://input'));

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        http_response_code(404);
        $response = ['status' => 'success'];
        print_r(json_encode($response, JSON_PRETTY_PRINT));
        exit;
        break;
    case 'POST':
        echo $model->post($data);
        break;
    case 'PATCH':
        echo $model->patch(getId(), $data);
        break;
    case 'DEL':
        echo $model->del(getId());
        break;

    default:
        # code...
        break;
}