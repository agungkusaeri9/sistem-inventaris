<?php


function process_login($post)
{
    global $koneksi;

    // Melindungi dari SQL injection
    $username = htmlspecialchars($post['username']);
    $password = htmlspecialchars($post['password']);

    $result = $koneksi->query("SELECT * FROM user WHERE username='$username'");
    // Memeriksa jumlah baris yang ditemukan
    $user = $result->fetch_object();
    // Jika username dan password cocok, set session dan kembalikan true
    if ($user) {

        // cek password
        if (password_verify($password, $user->password)) {
            session_start();
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['nama'] = $user->nama;
            $_SESSION['username'] = $user->username;
            $_SESSION['level'] = $user->level;
            redirectUrl(BASE_URL . '/main.php?page=dashboard');
        } else {
            return false;
        }
    } else {
        // Jika email dan password tidak cocok, kembalikan false
        return false;
    }
}