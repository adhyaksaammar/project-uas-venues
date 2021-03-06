<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/project-uas/API/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here
// files needed to connect to database
include_once '../config/database.php';
include_once 'pengelola.php';
 
// get database connection
$database = new Database();
$db = $database->getConnect();
 
// instantiate product object
$pengelola = new Pengelola($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$pengelola->nama_pengelola = $data->nama_pengelola;
$pengelola->password_pengelola = $data->password_pengelola;
 
// use the create() method here
// create the user
if(
    !empty($pengelola->nama_pengelola) &&
    !empty($pengelola->password_pengelola) &&
    $pengelola->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Pengelola was created."));
}
 
// message if unable to create user
else{
    
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create pengelola."));
}

?>