<?php
// api.php - Coloca esto en tu servidor XAMPP
header('Content-Type: application/json');

 $file = 'data.json';
 $method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Leer datos
    if (file_exists($file)) {
        echo file_get_contents($file);
    } else {
        echo json_encode(["error" => "Archivo no encontrado"]);
    }
}

if ($method === 'POST') {
    // Guardar datos
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['content'])) {
        // Decodificar y re-codificar para formatear bonito
        $json_data = json_decode($input['content']);
        if (file_put_contents($file, json_encode($json_data, JSON_PRETTY_PRINT))) {
            echo json_encode(["success" => true, "message" => "Datos guardados localmente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error de permisos"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Sin contenido"]);
    }
}
?>