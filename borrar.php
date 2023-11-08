<?php
include 'funciones.php';

$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "DELETE FROM alumnos WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  // En lugar de redirigir, proporcionamos un mensaje y un enlace para volver atrás.
  $mensaje = "El alumno ha sido eliminado con éxito.";
} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<div class="container mt-2">
  <div class="row">
    <div class="col-md-12">
      <?php if ($resultado['error']) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      <?php } else { ?>
        <div class="alert alert-success" role="alert">
          <?= $mensaje ?>
        </div>
        <a class="btn btn-primary" href="javascript:history.go(-1)">Volver atrás</a>
      <?php } ?>
    </div>
  </div>
</div>

<?php require "templates/footer.php"; ?>

