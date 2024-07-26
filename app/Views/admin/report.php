<?php $log = model('App\Models\LogModel')->findAll(); ?>

<?= $this->extend('layout/admin.php') ?>

<?= $this->section('content') ?>

<nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
        </svg>
        Home
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="/transaksi" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Transaksi Barang</a>
      </div>
    </li>
  </ol>
</nav>
<div class="relative border overflow-x-auto shadow-md sm:rounded-lg p-3">
    <table id="tb_report" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Transaksi</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Admin</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Keterangan</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Jenis Transaksi</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Barang</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Barang</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Jumlah Qty</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Total Biaya</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Nomor Refrensi</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Metode Pembayaran</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($log as $item): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 whitespace-nowrap">TR-<?= $item['id'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['name'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['purpose'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?php if ($item['jenis'] == 'in'): ?>
                        Barang Masuk
                    <?php elseif ($item['jenis'] == 'out'): ?>
                        Barang Keluar
                    <?php else: ?>
                        <?= $item['jenis'] ?>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">BR-<?= $item['kode_barang'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['nama_barang'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['jumlah'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['reference_number'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['payment_method'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $item['timestamp'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
