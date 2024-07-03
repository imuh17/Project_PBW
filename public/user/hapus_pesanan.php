<?php
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesan = $_POST['id_pesan'];

    // Memastikan input yang diperlukan tidak kosong
    if (empty($id_pesan)) {
        echo "ID pesanan tidak ditemukan.";
        exit;
    }

    // Query untuk menghapus data pesanan
    $query = "DELETE FROM pesanan_tiket WHERE id_pesan=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pesan);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus. <a href='cart.php'>Kembali ke Daftar Pesanan</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
