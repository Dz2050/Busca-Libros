<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libros";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$response = file_get_contents('https://openlibrary.org/search.json?q=Pride+and+Prejudice');
$data = json_decode($response, true);

$conn->query("TRUNCATE TABLE libros");

foreach ($data['docs'] as $book) {
    $titulo = str_replace("'", "''", $book['title']);
    $autor = isset($book['author_name']) ? implode(', ', $book['author_name']) : '';

    $sql = "INSERT INTO autores (nombre) VALUES ('$autor') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)";
    $conn->query($sql);

    $autor_id = $conn->insert_id;

    $sql = "INSERT INTO libros (titulo, autor_id) VALUES ('$titulo', '$autor_id')";
    $conn->query($sql);
}

$term = $_POST["titulo"]; 
$sql = "SELECT * FROM libros WHERE titulo LIKE '%$term%'";
$result = $conn->query($sql);
$books = [];

if ($result->num_rows > 0) {
    echo "<h2>Resultados:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<strong>Título:</strong> " . $row['titulo'] . "<br>";
        echo "<strong>Páginas:</strong> " . $row['paginas'] . "<br>";
        echo "<strong>Fecha de publicación:</strong> " . $row['fecha_publicacion'] . "<br>";
        echo "<strong>Editorial:</strong> " . $row['editorial'] . "<br>";
        echo "<strong>Autor ID:</strong> " . $row['autor_id'] . "<br>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>
