<?php
// Variable bandera para determinar si ocurre algun error o no.
$error = false;

// Variable necesaria para renderizar los el número de tarjetas.
$numberCards = 0;

// Verificamos que todas las variables hayan sido pasados por POST.
if (isset($_POST["send"]) && isset($_POST['numberCards'])) {

  $numberCards = $_POST['numberCards'];
  // Verificamos que el número de tarjetas sea un número entero mayor a 0.
  if (!is_numeric($numberCards) || $numberCards <= 0) {
    $error = true;
  }
} else {
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>N tajertas de datos A,B,C,D,E</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body class="font-mono">
  <main class="mx-auto p-5 bg-slate-100 min-h-screen flex flex-col justify-center align-center gap-5">
    <h1 class="text-3xl font-bold text-center uppercase">Tarjetas de datos de estudiantes</h1>
    <?php
    if ($error) {
    ?>
      <p class="text-lg font-bold uppercase text-center">Ha ocurrido un error, por favor asegurate de haber completado el <a class="underline text-blue-500" href="index.php">primer paso</a> correctamente.</p>
    <?php
    } else {
    ?>
      <form class="grid grid-cols-1 md:grid-cols-3 gap-5" action="result.php" method="POST">
        <?php
        for ($i = 0; $i < $numberCards; $i++) {
        ?>
          <div class="flex flex-col gap-1 p-5 border rounded-lg bg-white shadow">
            <h2 class="text-lg font-bold uppercase text-center">Tarjeta de estudiante <?php echo $i + 1; ?></h2>

            <div class="flex flex-col">
              <label class="font-semibold text-gray-600" for="dni<?php echo $i; ?>">Número de cedula</label>
              <input class="rounded-lg shadow border-slate-400" type="text" name="dni[]" id="dni<?php echo $i; ?>" required>
            </div>

            <div class="flex flex-col">
              <label class="font-semibold text-gray-600" for="name<?php echo $i; ?>">Nombre</label>
              <input class="rounded-lg shadow border-slate-400" type="text" name="name[]" id="name<?php echo $i; ?>" required>
            </div>

            <div class="flex flex-col">
              <label class="font-semibold text-gray-600" for="math<?php echo $i; ?>">Nota de matemáticas</label>
              <input class="rounded-lg shadow border-slate-400" type="number" name="math[]" id="math<?php echo $i; ?>" min="0" step="1" max="20" required>
            </div>

            <div class="flex flex-col">
              <label class="font-semibold text-gray-600" for="physic<?php echo $i; ?>">Nota de física</label>
              <input class="rounded-lg shadow border-slate-400" type="number" name="physic[]" id="physic<?php echo $i; ?>" min="0" step="1" max="20" required>
            </div>

            <div class="flex flex-col">
              <label class="font-semibold text-gray-600" for="development<?php echo $i; ?>">Nota de programación</label>
              <input class="rounded-lg shadow border-slate-400" type="number" name="development[]" id="development<?php echo $i; ?>" min="0" step="1" max="20" required>
            </div>

          </div>
        <?php
        }
        ?>
        <input type="hidden" name="numberCards" value="<?php echo $numberCards; ?>" />
        <button class="col-span-full bg-blue-500 border rounded-lg p-2 font-bold uppercase text-white shadow" type="submit" name="calc">Calcular</button>
      </form>
    <?php
    }
    ?>
  </main>
</body>

</html>