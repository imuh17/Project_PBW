<?php
include("koneksi.php");

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menangkap data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan sanitasi input
$username = mysqli_real_escape_string($conn, $username);

// Query untuk mencari user berdasarkan username
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mengambil data user
    $row = $result->fetch_assoc();
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Jika password benar, arahkan ke halaman lain atau set session
        header('Location: ./user/index.php');
        exit();
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found";
}

$conn->close();
?>
