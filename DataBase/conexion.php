<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mk_healt";
$port = 3307;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Asegurarse de que todos los datos necesarios están presentes
if (isset($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['cpNegocio'], $_POST['TipoNegocio'], $_POST['puestoOcupa'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $cpNegocio = $conn->real_escape_string($_POST['cpNegocio']);
    $TipoNegocio = $conn->real_escape_string($_POST['TipoNegocio']);
    $puestoOcupa = $conn->real_escape_string($_POST['puestoOcupa']);

    $sql = "INSERT INTO mk_form (nombre, correo, telefono, cpNegocio, TipoNegocio, puestoOcupa) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param('ssssss', $nombre, $correo, $telefono, $cpNegocio, $TipoNegocio, $puestoOcupa);

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
