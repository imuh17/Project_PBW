<?php
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesan = $_POST['id_pesan'];
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    // Debugging
    echo "ID Pesan: " . htmlspecialchars($id_pesan) . "<br>";
    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Waktu: " . htmlspecialchars($waktu) . "<br>";
    echo "Jumlah Tiket: " . htmlspecialchars($jumlah_tiket) . "<br>";

    // Memastikan input yang diperlukan tidak kosong
    if (empty($id_pesan) || empty($nama) || empty($waktu) || empty($jumlah_tiket)) {
        echo "Harap lengkapi semua data.";
        exit;
    }

    // Query untuk mengupdate data pesanan
    $query = "UPDATE pesanan_tiket SET nama=?, waktu=?, jumlah_tiket=? WHERE id_pesan=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $nama, $waktu, $jumlah_tiket, $id_pesan);

    if ($stmt->execute()) {
        echo "Data berhasil diubah. <a href='cart.php'>Kembali ke Daftar Pesanan</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
