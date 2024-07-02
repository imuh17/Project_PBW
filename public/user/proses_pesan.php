<?php
session_start();

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

// Menangkap data dari form
$id_film = $_POST['id_film'];
$nama = $_POST['nama'];
$waktu = $_POST['waktu'];
$jumlah_tiket = $_POST['jumlah_tiket'];

// Cek apakah id_film ada di tabel film
$cek_film_query = "SELECT * FROM film WHERE id_film = '$id_film'";
$cek_film_result = mysqli_query($conn, $cek_film_query);

if (mysqli_num_rows($cek_film_result) > 0) {
    // Menyimpan data ke tabel pesanan_tiket
    $sql = "INSERT INTO pesanan_tiket (id_film, nama, waktu, jumlah_tiket) VALUES ('$id_film', '$nama', '$waktu', '$jumlah_tiket')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Your purchase has been confirmed!";
        header("Location: index.php?id_film=$id_film");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Film with ID $id_film does not exist.";
}

$conn->close();
?>
