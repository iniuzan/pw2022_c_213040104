<?php 
session_start();
if (!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
$film = query("SELECT * FROM film ORDER BY id DESC");

//ketika tombol cari ditekan
if (isset($_POST['cari'])){
    $film = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galva Media</title>
</head>

<body>
    <h1>Daftar Film</h1>
    <a href="tambah.php">Tambah Data Film</a>
    <br> <br>

    <form action="" method="POST">
        <input type="text" name="keyword" size="30" autofocus placeholder="Masukkan Keyword Pencarian"
            autocomplete="off">
        <button type="submit" name="cari">Cari!</button>
    </form>

    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul Film</th>
            <th>Thumbnail</th>
            <th>Genre</th>
            <th>Tahun Rilis</th>
            <th>Sutradara</th>
            <th>Penerbit</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($film as $row):?>

        <tr>
            <td><?= $i ?></td>
            <td><?= $row['judul_film'] ?></td>
            <td><img src="./assets/img/<?= $row['thumbnail'] ?>" width="140px" alt="">
            </td>
            <td><?= $row['genre'] ?></td>
            <td><?= $row['tahun_rilis'] ?></td>
            <td><?= $row['sutradara'] ?></td>
            <td><?= $row['penerbit'] ?></td>
            <td>
                <a href="ubah.php?id=<?=$row['id'];?>">Ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a> |
                <a href="detail.php">Detail</a>
            </td>
        </tr>
        <?php $i++ ;?>
        <?php endforeach; ?>

    </table>
    <a href="./logout.php">Logout!</a>
</body>

</html>