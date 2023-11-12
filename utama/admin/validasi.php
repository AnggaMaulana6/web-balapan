<?php
session_start();
include "../../db/koneksi.php";

$query = mysqli_query($con, "SELECT * FROM user INNER JOIN event ON user.id_event = event.id_event WHERE user.status = 'proses' OR user.status = 'kadaluarsa';");
$getData = mysqli_fetch_all($query, MYSQLI_ASSOC);



?>
<?php include "../layout/header.php" ?>
<h2 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    Data Validasi
</h2>

<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">Nama Event</th>
                    <th class="px-4 py-3">Nama Peserta</th>
                    <th class="px-4 py-3">No Lambung</th>
                    <th class="px-4 py-3">Jenis Mobil</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php
                $no = 1;
                foreach ($getData as $data) {
                
                ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $no++ ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['nama_event'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['nama'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['no_lambung'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                <?= $data['jenis_mobil'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="./menu/validasi_user.php?no_lambung=<?= $data['no_lambung'] ?>" class='px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-500 rounded-full dark:bg-blue-700 dark:text-blue-100'> Validasi </a>
                                <a href="./menu/koreksi.php?no_lambung=<?= $data['no_lambung'] ?>" class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-500 rounded-full dark:bg-blue-700 dark:text-blue-100"> Koreksi </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

        <?php include "../layout/footer.php" ?>