<?php
include "../../db/koneksi.php";
session_start();

$user= mysqli_query($con, "SELECT * FROM user WHERE level = 'user'");
$count_user= mysqli_num_rows($user);

$user_proses= mysqli_query($con, "SELECT * FROM user WHERE level = 'user' and status = 'proses'");
$count_userp= mysqli_num_rows($user_proses);

$user_aktif= mysqli_query($con, "SELECT * FROM user WHERE level = 'user' and status = 'aktif'");
$count_usera= mysqli_num_rows($user_aktif);

$event= mysqli_query($con, "SELECT * FROM event ");
$count_event= mysqli_num_rows($event);


$queryUser = mysqli_query($con, "SELECT * FROM user INNER JOIN event ON user.id_event = event.id_event WHERE user.level = 'user'");
$getData = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);

if(isset($_GET['no_lambung'])){
    $no_lambung = $_GET['no_lambung'];

    $queryHapus = "DELETE FROM user WHERE no_lambung = '$no_lambung'";
    $exHapus = mysqli_query($con, $queryHapus);

    if($exHapus){

        $queryHapus1 = mysqli_query($con, "DELETE FROM validasi WHERE no_lambung = '$no_lambung'");

        $queryHapus2 = mysqli_query($con, "DELETE FROM timing WHERE no_lambung = '$no_lambung'");
        
        $queryHapus3 = mysqli_query($con, "DELETE FROM start WHERE no_lambung = '$no_lambung'");
        
        $queryHapus4 = mysqli_query($con, "DELETE FROM finish WHERE no_lambung = '$no_lambung'");

        $queryHapus5 = mysqli_query($con, "DELETE FROM tmp_tabel WHERE no_lambung = '$no_lambung'");
        echo '<script>
        alert("Data berhasil dihapus");
        window.location.replace("./dashboard.php")
        </script>';
    }else{
        echo '<script>alert("Gagal menghaous data")</script>';
    }
    
}

?>
<?php include "../layout/header.php" ?>
<main class="h-full overflow-y-auto">
    <form action="select" method="post">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            LAMBAN GARAGE TIMER SYSTEM
        </h2>
        <!-- CTA -->
        <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span>Selamat Datang <?=$_SESSION['nama'] ?>, Anda Login Sebagai <?= $_SESSION['level'] ?></span> 
            </div>
        </a>
        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
				<a href="laporan/lp_user.php">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                    </svg>
                </div> </a>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total User
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?=$count_user;?>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
				<a href="event.php">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
				</a>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Event
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?=$count_event?>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
			<a href="laporan/lp_user.php?aktif">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                </div>
				</a>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        User Aktif
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?=$count_usera?>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
			<a href="laporan/lp_user.php?proses">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-ruleA="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
				</a>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        User Proses
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?=$count_userp?>
                    </p>
                </div>
            </div>
        </div>
        </form>
        <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nama User</th>
                    <th class="px-4 py-3">Event </th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php
                foreach ($getData as $data) {
                
                ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['nama'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['nama_event'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['status'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                            <a href="./dashboard.php?no_lambung=<?= $data['no_lambung'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-500 rounded-full dark:bg-blue-700 dark:text-blue-100" > Hapus </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
        <?php include "../layout/footer.php" ?>