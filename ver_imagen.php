<?php
include 'funciones.php';

$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  $id = $_GET['id'];
  $consultaSQL = "SELECT imagen FROM alumnos WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumno = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$alumno || empty($alumno['imagen'])) {
    echo "Este alumno no tiene una imagen asociada.";
  } else {
    echo '<img src="' . $alumno['imagen'] . '" alt="Imagen de alumno">';
  }

} catch(PDOException $error) {
  echo $error->getMessage();
}
?>
