<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mk_health";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Asegurarse de que todos los datos necesarios están presentes
if (isset($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['cp_negocio'], $_POST['tipo_negocio'], $_POST['puesto'])) {
    // Imprimir los datos recibidos para verificar
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;  // Detener la ejecución para revisar los datos

    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $cp_negocio = $conn->real_escape_string($_POST['cp_negocio']);
    $tipo_negocio = $conn->real_escape_string($_POST['tipo_negocio']);
    $puesto = $conn->real_escape_string($_POST['puesto']);

    $sql = "INSERT INTO registros (nombre, correo, telefono, cp_negocio, tipo_negocio, puesto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param('ssssss', $nombre, $correo, $telefono, $cp_negocio, $tipo_negocio, $puesto);

    if ($stmt->execute()) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos necesarios.";
}

$conn->close();
?>
