<?php
// Variable bandera para determinar si ocurre algun error o no.
$error = false;

// Variables necesaria para realizar los calculos.
$mathAverage = 0;
$physicAverage = 0;
$developmentAverage = 0;
$numberStudentsPassedMath = 0;
$numberStudentsPassedPhysic = 0;
$numberStudentsPassedDevelopment = 0;
$numberStudentsFailingMath = 0;
$numberStudentsFailingPhysic = 0;
$numberStudentsFailingDevelopment = 0;
$numberStudentsPassedAll = 0;
$numberStudentsPassedOne = 0;
$numberStudentsPassedTwo = 0;
$maxMath = 0;
$maxPhysic = 0;
$maxDevelopment = 0;

// Verificamos que todas las variables hayan sido pasados por POST.
if (
  isset($_POST["calc"]) && isset($_POST['dni']) && isset($_POST["name"]) && isset($_POST["math"]) &&
  isset($_POST["physic"]) && isset($_POST["development"]) && isset($_POST["numberCards"])
) {
  $dni = $_POST['dni'];
  $name = $_POST['name'];
  $math = $_POST['math'];
  $physic = $_POST['physic'];
  $development = $_POST['development'];
  $numberCards = $_POST['numberCards'];

  // Verificamos que ninguna de las variables (Array) esten vacias y que estos tengan todos sus valores.
  if (
    !empty($dni) && count($dni) == $numberCards && !empty($name) && count($name) == $numberCards &&
    !empty($math) && count($math) == $numberCards && !empty($physic) && count($physic) == $numberCards &&
    !empty($development) && count($development) == $numberCards
  ) {

    // Verificamos que los datos en cada posicion del Array dni sean un String.
    foreach ($dni as $value) {
      if (!is_string($value)) {
        $error = true;
        break;
      }
    }
    // Verificamos que los datos en cada posicion del Array name sean un String.
    foreach ($name as $value) {
      if (!is_string($value)) {
        $error = true;
        break;
      }
    }
    // Verificamos que los datos en cada posicion del Array math sean un numero entre 0 y 20.
    foreach ($math as $value) {
      if (!is_numeric($value) || $value < 0 || $value > 20) {
        $error = true;
        break;
      }
    }
    // Verificamos que los datos en cada posicion del Array physic sean un numero entre 0 y 20.
    foreach ($physic as $value) {
      if (!is_numeric($value) || $value < 0 || $value > 20) {
        $error = true;
        break;
      }
    }
    // Verificamos que los datos en cada posicion del Array development sean un numero entre 0 y 20.
    foreach ($development as $value) {
      if (!is_numeric($value) || $value < 0 || $value > 20) {
        $error = true;
        break;
      }
    }

    // Verificamos que no haya ocurrido ningun error en ninguna de las verificaciones anteriores.
    if (!$error) {
      // Calculamos el promedio de cada materia con dos decimales.
      $mathAverage = round(array_sum($math) / $numberCards, 2);
      $physicAverage = round(array_sum($physic) / $numberCards, 2);
      $developmentAverage = round(array_sum($development) / $numberCards, 2);


      // Calculamos el numero de estudiantes que aprobaron y desaprobaron cada materia.
      foreach ($math as $value) {
        if ($value >= 10) {
          $numberStudentsPassedMath++;
        } else {
          $numberStudentsFailingMath++;
        }
      }
      foreach ($physic as $value) {
        if ($value >= 10) {
          $numberStudentsPassedPhysic++;
        } else {
          $numberStudentsFailingPhysic++;
        }
      }
      foreach ($development as $value) {
        if ($value >= 10) {
          $numberStudentsPassedDevelopment++;
        } else {
          $numberStudentsFailingDevelopment++;
        }
      }

      // Calculamos el numero de estudiantes que aprobaron una, dos o todas las materias.
      for ($i = 0; $i < $numberCards; $i++) {
        if ($math[$i] >= 10 && $physic[$i] >= 10 && $development[$i] >= 10) {
          $numberStudentsPassedAll++;
        } else if ($math[$i] >= 10 && $physic[$i] >= 10 || $math[$i] >= 10 && $development[$i] >= 10 || $physic[$i] >= 10 && $development[$i] >= 10) {
          $numberStudentsPassedTwo++;
        } else if ($math[$i] >= 10 || $physic[$i] >= 10 || $development[$i] >= 10) {
          $numberStudentsPassedOne++;
        }
      }

      // Calculamos la nota maxima de cada materia.
      $maxMath = max($math);
      $maxPhysic = max($physic);
      $maxDevelopment = max($development);
    }
  } else {
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
    <h1 class="text-3xl font-bold text-center uppercase">Resultados de las notas de los estudiantes</h1>
    <?php
    if ($error) {
    ?>
      <p class="text-lg font-bold uppercase text-center">Ha ocurrido un error, por favor asegurate de haber completado el <a class="underline text-blue-500" href="form.php">segundo paso</a> correctamente.</p>
    <?php
    } else {
    ?>
      <ul class="list-none list-inside w-fit">
        <li class="font-bold text-lg">Nota promedio de cada materia:
          <ul class="list-disc list-inside w-fit">
            <li class="font-normal text-base">Matemática: <?php echo $mathAverage ?></li>
            <li class="font-normal text-base">Física: <?php echo $physicAverage ?></li>
            <li class="font-normal text-base">Programación: <?php echo $developmentAverage ?></li>
          </ul>
        </li>
        <li class="font-bold text-lg">Número de alumnos aprobados en cada materia:
          <ul class="list-disc list-inside w-fit">
            <li class="font-normal text-base">Matemática: <?php echo $numberStudentsPassedMath ?></li>
            <li class="font-normal text-base">Física: <?php echo $numberStudentsPassedPhysic ?></li>
            <li class="font-normal text-base">Programación: <?php echo $numberStudentsPassedDevelopment ?></li>
          </ul>
        </li>
        <li class="font-bold text-lg">Número de alumnos desaprobados en cada materia:
          <ul class="list-disc list-inside w-fit">
            <li class="font-normal text-base">Matemática: <?php echo $numberStudentsFailingMath ?></li>
            <li class="font-normal text-base">Física: <?php echo $numberStudentsFailingPhysic ?></li>
            <li class="font-normal text-base">Programación: <?php echo $numberStudentsFailingDevelopment ?></li>
          </ul>
        </li>
        <li class="font-bold text-lg">Número de alumnos que aprobaron una unica materia, dos materias o todas las materias:
          <ul class="list-disc list-inside w-fit">
            <li class="font-normal text-base">Sola una materia: <?php echo $numberStudentsPassedOne ?></li>
            <li class="font-normal text-base">Solo dos materias: <?php echo $numberStudentsPassedTwo ?></li>
            <li class="font-normal text-base">Todas las materias: <?php echo $numberStudentsPassedAll ?></li>
          </ul>
        </li>
        <li class="font-bold text-lg">Nota máxima de cada materia:
          <ul class="list-disc list-inside w-fit">
            <li class="font-normal text-base">Matemática: <?php echo $maxMath ?></li>
            <li class="font-normal text-base">Física: <?php echo $maxPhysic ?></li>
            <li class="font-normal text-base">Programación: <?php echo $maxDevelopment ?></li>
          </ul>
        </li>
      </ul>
      <a class="col-span-full bg-blue-500 border rounded-lg p-2 font-bold uppercase text-white shadow text-center" href="index.php">Regresa al inicio</a>
    <?php
    }
    ?>
  </main>
</body>

</html>