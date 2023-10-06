<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM user");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $username = htmlspecialchars($post['username']);
    $level = htmlspecialchars($post['level']);
    $password = password_hash($post['password'], PASSWORD_BCRYPT);

    $insert = $koneksi->query("INSERT INTO `user` (`id_user`, `nama`, `username`,`password`,`level`) VALUES (NULL, '$nama','$username','$password','$level')");

    if ($insert) {
        $insertId =  true;
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM user WHERE id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
  
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $username = htmlspecialchars($post['username']);
    $level = htmlspecialchars($post['level']);

    // update user
    if ($post['password']) {
        // cek password dan password konfirmasi
        if($post['password'] !== $post['konfirmasi_password'])
        {
            redirectUrl(BASE_URL . '/main.php?page=user-edit&id_user='.$post['id_user'].'&status=error&message=Password dan konfirmasi password tidak sesuai.');
        }
        $pw_hash = password_hash($post['password'],PASSWORD_BCRYPT);
        $passwordUpdate = ",`password` = " . "'". $pw_hash . "'";
    } else {
        $passwordUpdate = NULL;
    }
    $koneksi->query("UPDATE `user` SET `nama` = '$nama', `username` = '$username' $passwordUpdate WHERE `user`.`id_user` = $post[id_user]");


    return true;
}

function deleteData($id_user)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM user WHERE id_user=$id_user");
}



function updateProfile($post)
{
    global $koneksi;
  
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $username = htmlspecialchars($post['username']);

    // update user
    if ($post['password']) {
        
        $pw_hash = password_hash($post['password'],PASSWORD_BCRYPT);
        $passwordUpdate = ",`password` = " . "'". $pw_hash . "'";
    } else {
        $passwordUpdate = NULL;
    }
    $user = $koneksi->query("UPDATE `user` SET `nama` = '$nama', `username` = '$username' $passwordUpdate WHERE `user`.`id_user` = $_SESSION[id_user]");
    
    if($user)
    {
         // hapus session
         unset($_SESSION['nama']);
         unset($_SESSION['username']);

         // buat session baru
         $_SESSION['nama'] = $nama;
         $_SESSION['username'] = $username;

         return true;
    }else{
        return false;
    }
}


function validasiTambah($post)
{
    global $koneksi;
    // cek kesamaan password dan konfirmasi_password
    if($post['password'] !== $post['konfirmasi_password'])
    {
        redirectUrl(BASE_URL . '/main.php?page=user-create&status=error&message=Password dan password konfirmasi tidak sesuai.');
        exit; 
    }
    // cek apakah ada username di database
    $cekUser = $koneksi->query("SELECT * FROM user WHERE username = '$post[username]'")->fetch_assoc();

    if ($cekUser) {
        redirectUrl(BASE_URL . '/main.php?page=user-create&status=error&message=User dengan Username tersebut sudah terdaftar.');
        exit;
    } else {
        if (!$post['nama'] || !$post['username'] || !$post['level'] || !$post['password']) {

            redirectUrl(BASE_URL . '/main.php?page=user-create&status=error&message=Nama, Username, Level dan Password tidak boleh kosong.');
            exit;
        }
    }
}


function validasiEdit($post)
{
    global $koneksi;

    // cek apakah ada username di database
    $cekUser = $koneksi->query("SELECT * FROM user WHERE username = '$post[username]' AND id_user!=$post[id_user]")->fetch_assoc();

    if ($cekUser) {
        redirectUrl(BASE_URL . '/main.php?page=user-edit&id_user='.$post['id_user'].'&status=error&message=User dengan Username tersebut sudah terdaftar.');
        exit;
    } else {
        if (!$post['nama'] || !$post['username'] || !$post['level']) {
            redirectUrl(BASE_URL . '/main.php?page=user-edit&id_user='.$post['id_user'].'&status=error&message=Nama, username, Level dan Password tidak boleh kosong.');
            exit;
        }
    }
}