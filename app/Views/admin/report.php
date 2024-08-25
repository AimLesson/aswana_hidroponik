<?php $log = model('App\Models\LogModel')->findAll(); ?>

<?= $this->extend('layout/admin.php') ?>

<?= $this->section('content') ?>

<nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <a href="/transaksi" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Transaksi Barang</a>
            </div>
        </li>
    </ol>
</nav>

<div class="relative border overflow-x-auto shadow-md sm:rounded-lg p-3">
    <!-- Tabs -->
    <div class="flex flex-col">
        <div class="sm:hidden">
            <select id="transactionTabs" class="block w-full text-gray-700 bg-white dark:bg-gray-800 dark:text-gray-400 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500" onchange="changeTab(this.value)">
                <option value="tab-in">Barang Masuk</option>
                <option value="tab-out">Barang Keluar</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="flex space-x-4">
                <button id="tab-in" class="text-gray-700 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white py-2 px-4 border-b-2 border-transparent font-medium text-sm focus:outline-none" onclick="changeTab('tab-in')">
                    Barang Masuk
                </button>
                <button id="tab-out" class="text-gray-700 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white py-2 px-4 border-b-2 border-transparent font-medium text-sm focus:outline-none" onclick="changeTab('tab-out')">
                    Barang Keluar
                </button>
            </nav>
        </div>
    </div>

    <!-- Barang Masuk Table -->
    <div id="table-in" class="mt-5">
        <table id="tb_report_in" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Transaksi</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Admin</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Keterangan</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Jenis Transaksi</th>
                    <!-- <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Barang</th> -->
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Barang</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Jumlah Qty</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Total Biaya</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Nomor Kwitansi</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Metode Pembayaran</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Waktu</th>
                    <?php if (auth()->user()->inGroup('superadmin')): ?>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Actions</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($log as $item) : ?>
                    <?php if ($item['jenis'] == 'in') : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 whitespace-nowrap">TR-<?= $item['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['purpose'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">Barang Masuk</td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap">BR-<?= $item['kode_barang'] ?></td> -->
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['nama_barang'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['jumlah'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['reference_number'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['payment_method'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['timestamp'] ?></td>
                            <?php if (auth()->user()->inGroup('superadmin')): ?>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="text-blue-600 hover:text-blue-800" onclick="openEditModal(<?= $item['id'] ?>)">Edit</button>
                                <button class="text-red-600 hover:text-red-800" onclick="confirmDelete(<?= $item['id'] ?>)">Delete</button>
                            </td>
                            <?php endif;?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Barang Keluar Table -->
    <div id="table-out" class="hidden mt-5">
        <table id="tb_report_out" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Transaksi</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Admin</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Keterangan</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Jenis Transaksi</th>
                    <!-- <th scope="col" class="px-6 py-3 whitespace-nowrap">Kode Barang</th> -->
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Nama Barang</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Jumlah Qty</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Waktu</th>
                    <?php if (auth()->user()->inGroup('superadmin')): ?>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($log as $item) : ?>
                    <?php if ($item['jenis'] == 'out') : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 whitespace-nowrap">TR-<?= $item['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['purpose'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">Barang Keluar</td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap">BR-<?= $item['kode_barang'] ?></td> -->
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['nama_barang'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['jumlah'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $item['timestamp'] ?></td>
                            <?php if (auth()->user()->inGroup('superadmin')): ?>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="text-blue-600 hover:text-blue-800" onclick="openEditModal(<?= $item['id'] ?>)">Edit</button>
                                <button class="text-red-600 hover:text-red-800" onclick="confirmDelete(<?= $item['id'] ?>)">Delete</button>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-5xl">
        <h2 class="text-lg font-semibold mb-4">Edit Transaction</h2>
        <form id="editForm">
            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                <input type="hidden" id="edit-id">
                <div class="mb-4">
                    <label for="edit-name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Admin</label>
                    <input type="text" id="edit-name" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Keterangan</label>
                    <input type="text" id="edit-purpose" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Jenis Transaksi</label>
                    <select id="edit-jenis" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                        <option value="in">Barang Masuk</option>
                        <option value="out">Barang Keluar</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit-kode_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kode Barang</label>
                    <input type="text" id="edit-kode_barang" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Barang</label>
                    <input type="text" id="edit-nama_barang" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah Qty</label>
                    <input type="number" id="edit-jumlah" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-total_harga" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Total Biaya</label>
                    <input type="text" id="edit-total_harga" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nomor Kwitansi</label>
                    <input type="text" id="edit-reference_number" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="mb-4">
                    <label for="edit-payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Metode Pembayaran</label>
                    <input type="text" id="edit-payment_method" class="block w-full mt-1 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-gray-400">
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="text-gray-700 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white mr-3" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete this transaction?</p>
        <div class="flex justify-end mt-4">
            <button type="button" class="text-gray-700 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white mr-3" onclick="closeDeleteModal()">Cancel</button>
            <button id="confirmDeleteButton" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>

<script>
    // Function to change active tab and toggle table visibility
    function changeTab(tabId) {
        document.getElementById('tab-in').classList.remove('border-blue-600', 'text-blue-600');
        document.getElementById('tab-out').classList.remove('border-blue-600', 'text-blue-600');
        document.getElementById('table-in').classList.add('hidden');
        document.getElementById('table-out').classList.add('hidden');

        document.getElementById(tabId).classList.add('border-blue-600', 'text-blue-600');
        document.getElementById('table-' + tabId.split('-')[1]).classList.remove('hidden');
    }

    // Function to open the edit modal
    function openEditModal(id) {
        fetch('/report/get/' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit-id').value = data.id;
                document.getElementById('edit-name').value = data.name;
                document.getElementById('edit-purpose').value = data.purpose;
                document.getElementById('edit-jenis').value = data.jenis;
                document.getElementById('edit-kode_barang').value = data.kode_barang;
                document.getElementById('edit-nama_barang').value = data.nama_barang;
                document.getElementById('edit-jumlah').value = data.jumlah;
                document.getElementById('edit-total_harga').value = data.total_harga;
                document.getElementById('edit-reference_number').value = data.reference_number;
                document.getElementById('edit-payment_method').value = data.payment_method;
                document.getElementById('editModal').classList.remove('hidden');
            });
    }

    // Function to close the edit modal
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Handle form submission to save edited transaction
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const id = document.getElementById('edit-id').value;
        const data = {
            name: document.getElementById('edit-name').value,
            purpose: document.getElementById('edit-purpose').value,
            jenis: document.getElementById('edit-jenis').value,
            kode_barang: document.getElementById('edit-kode_barang').value,
            nama_barang: document.getElementById('edit-nama_barang').value,
            jumlah: document.getElementById('edit-jumlah').value,
            total_harga: document.getElementById('edit-total_harga').value,
            reference_number: document.getElementById('edit-reference_number').value,
            payment_method: document.getElementById('edit-payment_method').value,
        };

        fetch('/report/update/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeEditModal(); // Close the modal on success
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Error updating transaction');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Error updating transaction');
            });
    });

    // Function to confirm delete
    function confirmDelete(id) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('confirmDeleteButton').setAttribute('onclick', 'deleteTransaction(' + id + ')');
    }

    // Function to close the delete modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Function to delete a transaction
    function deleteTransaction(id) {
        console.log('Attempting to delete transaction with id:', id); // Log the attempt
        fetch('/report/delete/' + id, {
                method: 'DELETE'
            })
            .then(response => {
                console.log('Response received:', response); // Log the response object
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data); // Log the JSON data
                // Handle success or error
                if (data.success) {
                    console.log('Transaction deleted successfully');
                    location.reload(); // Reload the page
                } else {
                    console.error('Error deleting transaction');
                    alert('Error deleting transaction');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error); // Log any fetch errors
                alert('Error deleting transaction');
            });
    }

    // Set default tab
    document.addEventListener('DOMContentLoaded', () => {
        changeTab('tab-in');
    });
</script>

<?= $this->endSection() ?>