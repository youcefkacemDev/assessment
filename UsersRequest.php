<?php

require_once './Api.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$api = new Api();
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

$id = isset($uri[2]) ? (int)$uri[2] : null;

$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case "GET": {
            if ($id) {
                echo $api->getUser($id);
            } else {
                echo $api->getAllUsers();
            }
            break;
        }
    case "POST": {
            $name = $input['name'] ?? '';
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? '';
            echo $api->createUser($name, $email, $password);
            break;
        }
    case "PUT": {
            if ($id) {
                $name = $input['name'] ?? '';
                $email = $input['email'] ?? '';
                echo $api->updateUser($id, $name, $email);
            }
            break;
        }
    case "DELETE": {
            if ($id) {
                echo $api->deleteUser($id);
            }
            break;
        }

    default: {
            echo json_encode([
                'message' => 'method did not match'
            ]);
        }
}
