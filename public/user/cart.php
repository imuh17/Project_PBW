<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "filmyfy";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT pesanan_tiket.nama, film.judul_film, pesanan_tiket.waktu, pesanan_tiket.jumlah_tiket FROM pesanan_tiket JOIN film ON pesanan_tiket.id_film = film.id_film
";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style/style-user.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../../assets/style/style.css" />
    <title>Document</title>
  </head>
  <body>
    <!-- NAVBAR START -->
    <nav class="navbar bg-gray-800 p-4 flex items-center w-screen sticky z-50">
      <div class="container flex justify-between mx-4">
        <div class="text-white text-xl font-bold">Cinema</div>
        <ul class="flex space-x-4">
          <li class="mx-4"><a class="text-white" href="index.php">Home</a></li>
          <li class="mx-4">
            <a class="text-white" href="index.php#film">Film</a>
          </li>
        </ul>
        <div>
          <a href="#">
            <i class="fa-solid fa-cart-shopping 2xl" style="color: #ffffff"></i>
          </a>
        </div>
      </div>
    </nav>
    <!-- NAVBAR END -->
    <?php while($row = mysqli_fetch_assoc($result)): ?> 
    <div class="container">
      <table class="table table-md px-10">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Judul Film</th>
            <th>Waktu</th>
            <th>Jumlah Tiket</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['judul_film'] ?></td>
            <td><?= $row['waktu'] ?></td>
            <td><?= $row['jumlah_tiket'] ?></td>
            <td>Rp. 240.000</td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php endwhile; ?>
    <!-- testing -->
  </body>
</html>
