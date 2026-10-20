<?php
    // Habilitar errores para ver si falla algo en la ejecución
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require("config/database.php");

    // Get data from html form (client)
    $f_name = $_POST['fname'] ?? '';
    $l_name = $_POST['lname'] ?? '';
    $m_phone = $_POST['mphone'] ?? '';
    $e_mail = $_POST['email'] ?? '';
    $p_assword = $_POST['psw'] ?? '';
    $c_password = $_POST['cpsw'] ?? '';
    
    // Validación opcional de contraseñas iguales
    if ($p_assword !== $c_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit;
    }

    $pass_enc = md5($p_assword);
    
    $sql = "
        INSERT INTO users (
            firstname, lastname, mobile_phone, email, password
        )
        VALUES (
            '$f_name', '$l_name', '$m_phone', '$e_mail', '$pass_enc'
        )
    ";

    // Ejecución en bd local
    $local_res = pg_query($local_conn, $sql);
    
    // Ejecución en bd de Supabase
    $supa_res = pg_query($supa_conn, $sql);

    $msg = "";
    if ($local_res) {
        $msg .= " User created successfully in local database! \\n";
    } else {
        $msg .= " User failed in local database! \\n";
    }
    
    if ($supa_res) {
        $msg .= " User created successfully in Supabase database!";
    } else {
        $msg .= " User failed in Supabase database!";
    }

    // Redirecciona y muestra alerta
    echo "<script>
        alert('$msg');
        window.location.href = 'login.html';
    </script>";
?>