<?php
include 'funciones.php';

$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
  $consultaSQL = "SELECT * FROM alumnos";
  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();
  $alumnos = $sentencia->fetchAll();
} catch(PDOException $error) {
  echo $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <h2>Listado de Alumnos</h2>
      <a href="crear.php" class="btn btn-primary mb-3">Crear Alumno</a>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Imagen</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alumnos as $alumno) { ?>
            <tr>
              <td><?= $alumno['id'] ?></td>
              <td><?= escapar($alumno['nombre']) ?></td>
              <td><?= escapar($alumno['apellido']) ?></td>
              <td><?= escapar($alumno['email']) ?></td>
              <td><?= $alumno['edad'] ?></td>
              <td>
                <img src="<?= escapar($alumno["imagen"]) ?>" alt="Imagen de <?= escapar($alumno["nombre"]) ?>" style="max-width: 100px;">
              </td>
              <td>
                <a href="editar.php?id=<?= $alumno['id'] ?>" class="btn btn-warning">Editar</a>
                <a href="borrar.php?id=<?= $alumno['id'] ?>" class="btn btn-danger">Borrar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require "templates/footer.php"; ?>

