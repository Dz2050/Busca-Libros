<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Busca Tu Libro</title>
</head>
<body>

<h1>Buscar Libros</h1>
    
    <form action="buscar.php" method="POST">
        <input type="text" id="titulo" name="titulo" placeholder="Título">
        <input type="text" id="autor" name="autor" placeholder="Autor">
        <button type="submit">Vamos!</button>
    </form>

    <script src="ubicacion.js"></script>
</body>
</html>