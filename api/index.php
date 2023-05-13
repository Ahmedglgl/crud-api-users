<?php 

require_once('classes/autoloader.php');
use Controllers\personController;

$routes = array(
    'person' => array(
        'methods' => array(
            'index' => array(
                'method' => 'GET',
                'function' => 'index'
            ),
            'show' => array(
                'method' => 'GET',
                'function' => 'show'
            ),
            'store' => array(
                'method' => 'POST',
                'function' => 'store'
            ),
            'update' => array(
                'method' => 'PUT',
                'function' => 'update'
            ),
            'destroy' => array(
                'method' => 'DELETE',
                'function' => 'destroy'
            )
        )
    )
);

try {

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $personController = new personController();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $method = $routes['person']['methods']['show']['function'];
                return $personController->$method($id);
                break;
            case 'PUT':
                $post_vars = (array) json_decode(file_get_contents('php://input'), TRUE);        
                $method = $routes['person']['methods']['update']['function'];
                return $personController->$method($post_vars,$id);
                break;
            case 'DELETE':
                $method = $routes['person']['methods']['destroy']['function'];
                return $personController->$method($id);
                break;
            default:
                echo  json_encode('Method not allowed');
            break;
        }
    }else{
        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $method = $routes['person']['methods']['index']['function'];
                return $personController->$method();
                break;
            case 'POST':
                $post_vars = (array) json_decode(file_get_contents('php://input'), TRUE);        
                $method = $routes['person']['methods']['store']['function'];
                return $personController->$method($post_vars);
                break;
            default:
                echo  json_encode('Method not allowed');
                break;
        }
    }
 


} catch(Exception $e){
    echo json_encode($e->getMessage());
}
?>
