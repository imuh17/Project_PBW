<?php
include("../koneksi.php");

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT pesanan_tiket.id_pesan, pesanan_tiket.nama, film.judul_film, pesanan_tiket.waktu, pesanan_tiket.jumlah_tiket, film.harga FROM pesanan_tiket JOIN film ON pesanan_tiket.id_film = film.id_film";
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.5.0/dist/full.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <!-- NAVBAR START -->
    <nav class="navbar bg-gray-800 p-4 flex items-center w-screen sticky z-50">
        <div class="container flex justify-between mx-4">
            <div class="text-white text-xl font-bold">Cinema</div>
            <ul class="flex space-x-4">
                <li class="mx-4"><a class="text-white" href="index.php">Home</a></li>
                <li class="mx-4"><a class="text-white" href="index.php#Film">Film</a></li>
            </ul>
            <div>
                <a href="#">
                    <i class="fa-solid fa-cart-shopping 2xl" style="color: #ffffff"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->
    <div class="">
        <table class="table table-md px-10">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Judul Film</th>
                    <th>Waktu</th>
                    <th>Jumlah Tiket</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): 
                    $total_harga = $row['jumlah_tiket'] * $row['harga'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['judul_film']) ?></td>
                    <td><?= htmlspecialchars($row['waktu']) ?></td>
                    <td><?= htmlspecialchars($row['jumlah_tiket']) ?></td>
                    <td>
                        Rp.
                        <?= number_format($total_harga, 0, ',', '.') ?>
                    </td>
                    <td>
                        <button type="button" class="btn bg-yellow-400" onclick="document.getElementById('my_modal_<?= $row['id_pesan'] ?>').showModal()">
                            Ubah
                        </button>
                        <dialog id="my_modal_<?= $row['id_pesan'] ?>" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">Re-Schedule Ticket!</h3>
                                <form action="ubah_pesanan.php" method="post">
                                    <input type="hidden" name="id_pesan" value="<?= $row['id_pesan'] ?>" />
                                    <div class="mb-4">
                                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" name="nama" class="mt-1 p-2 w-full border rounded-md" value="<?= htmlspecialchars($row['nama']) ?>" required />
                                    </div>
                                    <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu</label>
                                    <select name="waktu" class="select select-bordered w-full max-w-xs">
                                        <option disabled selected value=""><?= htmlspecialchars($row['waktu']) ?></option>
                                        <option value="07.00">07.00</option>
                                        <option value="09.00">09.00</option>
                                        <option value="12.00">12.00</option>
                                        <option value="15.00">15.00</option>
                                        <option value="17.00">17.00</option>
                                        <option value="19.00">19.00</option>
                                    </select>
                                    <div class="mb-4">
                                        <label for="jumlah_tiket" class="block text-sm font-medium text-gray-700">Jumlah tiket</label>
                                        <input type="number" name="jumlah_tiket" class="mt-1 p-2 w-full border rounded-md" value="<?= htmlspecialchars($row['jumlah_tiket']) ?>" required />
                                    </div>
                                    <div>
                                        <button type="submit" class="btn bg-yellow-400">Ubah</button>
                                    </div>
                                </form>
                                <div class="modal-action">
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn">Close</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        <button type="button" class="btn bg-red-500" onclick="showDeleteModal('<?= $row['id_pesan'] ?>', '<?= htmlspecialchars($row['nama']) ?>')">Hapus</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Hapus <span id="delete_name"></span></h3>
            <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
            <form action="hapus_pesanan.php" method="post">
                <input type="hidden" name="id_pesan" id="delete_id_pesan" />
                <div class="modal-action">
                    <button type="button" class="btn" onclick="document.getElementById('delete_modal').close()">Cancel</button>
                    <button type="submit" class="btn bg-red-500">Confirm</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function showDeleteModal(id, name) {
            document.getElementById('delete_id_pesan').value = id;
            document.getElementById('delete_name').textContent = name;
            document.getElementById('delete_modal').showModal();
        }
    </script>
</body>
</html>
