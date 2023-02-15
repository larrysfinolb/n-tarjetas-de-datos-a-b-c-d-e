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
  <main class="mx-auto p-5 bg-slate-100 min-h-screen flex flex-col justify-center items-center gap-5">
    <h1 class="text-3xl font-bold text-center uppercase">N tarjetas de datos A, B, C, D, E</h1>
    <p class="text-lg font-bold uppercase text-center">Ingresa la cantidad de tarjetas de datos de estudiantes que deseas rellenar</p>
    <form class="grid grid-cols-1 max-w-lg w-full gap-5" action="form.php" method="POST">
      <input class="rounded-lg shadow border-slate-400" type="number" name="numberCards" id="numberCards" min="1" step="1" required>
      <button class="col-span-full bg-blue-500 border rounded-lg p-2 font-bold uppercase text-white shadow" type="submit" name="send">Enviar</button>
    </form>
  </main>
</body>

</html>