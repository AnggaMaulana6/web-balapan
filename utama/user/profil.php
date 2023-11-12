<?php
include "../../db/koneksi.php";
session_start();


    $no_lambung = $_GET['no_lambung'];

    $showData =mysqli_query($con, "SELECT * FROM user WHERE no_lambung = '$no_lambung'");
    $tampil = mysqli_fetch_assoc($showData);

if(isset($_POST['submit'])){
    $no_lambung = $_GET['no_lambung'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no_hp'];

    $query = "UPDATE user SET nama='$nama', alamat= '$alamat', no_hp = '$no' WHERE no_lambung = '$no_lambung' ";

    $exQuery = mysqli_query($con, $query);
    if($exQuery){
        header('location:./dashboard.php');
    }else{
        echo '<script>alert("Gagal mengubah data")</script>';
    }


}



?>



<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>

<body>
    <form action="" method="post">
        <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
            <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="flex flex-col overflow-y-auto md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="../assets/img/create-account-office.jpeg" alt="Office" />
                        <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/create-account-office-dark.jpeg" alt="Office" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                                Edit Profil
                            </h1>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">No Lambung</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="number" name="no_lambung" value=<?=$tampil['no_lambung'] ?> readonly />
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="type" name="nama" value=<?=$tampil['nama'] ?> required placeholder="Nama" />
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                                <textarea name="alamat" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Alamat" required><?=$tampil['alamat'] ?></textarea>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Nomor Hp</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="08*******" type="number" name="no_hp" value=<?=$tampil['no_hp'] ?> readonly />
                            </label>

                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit" name="submit" value="Submit">
                                Perbarui Profil
                            </button>
                            <p class="mt-4">
                                <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="./dashboard.php">
                                    Kembali
                                </a>
                            </p>

                            <hr class="my-8" />


                            <p class="mt-4">
                                <a type="submit" class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="../index.php" aria-valuetext="Kembali">
                                    
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>