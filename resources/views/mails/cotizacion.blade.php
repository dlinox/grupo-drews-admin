<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensaje</title>
</head>

<body>

  <h1>Mensaje de la web</h1>
  <h3>Nombre: {{$mailData["nombre"]}}</h3>
  <h3>Correo: {{$mailData["correo"]}}</h3>
  <h3>celular: {{$mailData["celular"]}}</h3>
  <h3>Mensaje:</h3>
  <p>
    {{$mailData["mensaje"]}}
  </p>

</body>

</html>