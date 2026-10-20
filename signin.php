<?php
// Incluimos la conexión a Supabase
require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    // Cuidado aquí: asegúrate de cómo guardas la contraseña (si usas md5 o texto plano)
    $password = md5($_POST["password"]); 

    // Consulta ÚNICAMENTE en Supabase como pide la plataforma
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = pg_query($supa_conn, $sql);

    if ($result && pg_num_rows($result) > 0) {
        // Si el usuario existe en Supabase, lo deja entrar al dashboard
        header("Location: index.html");
        exit();
    } else {
        // Si no existe, muestra alerta y lo regresa al login
        echo "<script>
                alert('Correo o contraseña incorrectos en Supabase.');
                window.location.href = 'login.php';
              </script>";
    }
}
?>