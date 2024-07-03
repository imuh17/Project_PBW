<?php
include("../koneksi.php");

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id_film"];
$query = "SELECT * FROM film WHERE id_film = '$id'";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style/style-user.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../../assets/style/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <title>Document</title>
  </head>
  <body>
    <!-- NAVBAR START -->
    <header class="">
      <nav class="navbar bg-gray-800 p-4 flex items-center sticky">
        <div class="container flex justify-between mx-4">
          <div class="text-white text-xl font-bold">
            <h2>Cinema</h2>
          </div>
          <ul class="flex space-x-4">
            <li class="mx-4">
              <a class="text-white" href="index.php#home">Home</a>
            </li>
            <li class="mx-4">
              <a class="text-white" href="index.php#Film">Film</a>
            </li>
          </ul>
          <div>
            <a href="cart.php"
              ><i
                class="fa-solid fa-cart-shopping 2xl"
                style="color: #ffffff"
              ></i
            ></a>
          </div>
        </div>
      </nav>
    </header>
    <!-- NAVBAR END -->
    <!-- Content Start -->
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <div class="poster max-w-5xl mt-10">
      <div class="grid grid-cols-3 gap-8 p-4">
        <div class="col-span-1">
          <img
            src="../../assets/img/<?= $row['gambar'] ?>"
            alt=""
            class="rounded-lg"
          />
        </div>
        <div class="col-span-2 mt-4">
          <p class="text-3xl font-semibold"><?= $row['judul_film'] ?></p>
          <br />
          <h2 class="font-semibold text-lg"><?= $row['durasi'] ?></h2>
          <div class="text-sm">
            <p>
              Genre
              <span
                >:
                <?= $row['genre'] ?></span
              >
            </p>
            <p>
              Rating
              <span
                >:
                <?= $row['rating'] ?></span
              >
            </p>
            <p>
              Produser
              <span
                >:
                <?= $row['produser'] ?></span
              >
            </p>
            <p>
              Sutradara
              <span
                >:
                <?= $row['sutradara'] ?></span
              >
            </p>
            <p>
              Penulis
              <span
                >:
                <?= $row['penulis'] ?></span
              >
            </p>
          </div>
          <br />
          <h2 class="text-2xl font-semibold">Sinopsis</h2>
          <br />
          <p class="text-justify text-gray-600 text-sm">
            <?= $row['sinopsis'] ?>
          </p>
          <br />
          <button
            type="button"
            class="btn bg-yellow-400"
            onclick="document.getElementById('my_modal_1').showModal()"
          >
            Pesan Sekarang
          </button>
          <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
              <h3 class="text-lg font-bold">Pesan Ticket!</h3>
              <form action="proses_pesan.php" method="post">
                <input type="hidden" name="id_film" value="<?= $id ?>" />
                <div class="mb-4">
                  <label
                    for="nama"
                    class="block text-sm font-medium text-gray-700"
                    >Nama</label
                  >
                  <input
                    type="text"
                    name="nama"
                    class="mt-1 p-2 w-full border rounded-md"
                    required
                  />
                </div>
                <label
                  for="waktu"
                  class="block text-sm font-medium text-gray-700 mb-2"
                  >Waktu</label
                >
                <select
                  name="waktu"
                  class="select select-bordered w-full max-w-xs"
                >
                  <option disabled selected>Pilih Waktu Menonton</option>
                  <option value="07.00">07.00</option>
                  <option value="09.00">09.00</option>
                  <option value="12.00">12.00</option>
                  <option value="15.00">15.00</option>
                  <option value="17.00">17.00</option>
                  <option value="19.00">19.00</option>
                </select>
                <div class="mb-4">
                  <label
                    for="jumlah_tiket"
                    class="block text-sm font-medium text-gray-700"
                    >Jumlah tiket</label
                  >
                  <input
                    type="number"
                    name="jumlah_tiket"
                    class="mt-1 p-2 w-full border rounded-md"
                    required
                  />
                </div>
                <div>
                  <button type="submit" class="btn bg-yellow-400">
                    Pesan!
                  </button>
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
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <!-- Content End -->
  </body>
</html>
