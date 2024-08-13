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
    <table id="tb_supplier" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Kode Barang</th>
                <th scope="col" class="px-6 py-3">Nama Barang</th>
                <th scope="col" class="px-6 py-3">Harga Beli</th>
                <th scope="col" class="px-6 py-3">Harga Jual</th>
                <th scope="col" class="px-6 py-3">Stock Barang</th>
                <th scope="col" class="px-6 py-3">Stock Minimum</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $item) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">BR-<?= $item['id'] ?></td>
                    <td class="px-6 py-4"><?= $item['nama_barang'] ?></td>
                    <td class="px-6 py-4"><?= number_format($item['harga_beli'], 0, ',', '.') ?></td>
                    <td class="px-6 py-4"><?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                    <td class="px-6 py-4"><?= $item['stok_produk'] ?></td>
                    <td class="px-6 py-4"><?= $item['stok_min'] ?></td>
                    <td class="flex items-center px-6 py-4">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="openModal('in', '<?= $item['id'] ?>', '<?= $item['nama_barang'] ?>', '<?= $item['harga_beli'] ?>', '<?= $item['harga_jual'] ?>')">In</button>
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="openModal('out', '<?= $item['id'] ?>', '<?= $item['nama_barang'] ?>', '<?= $item['harga_beli'] ?>', '<?= $item['harga_jual'] ?>')">Out</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="transactionModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg max-w-3xl">
        <h2 id="modalTitle" class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-4"></h2>
        <form action="<?= base_url('transaksi/processTransaction') ?>" method="post">
            <?= csrf_field() ?>
            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="nama_barang" name="nama_barang">
                <input type="hidden" id="harga_barang" name="harga_barang">
                <input type="hidden" id="jenis" name="jenis">
                <div id="quantitySection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Qty</label>
                    <input type="number" id="jumlah" name="jumlah" oninput="calculateTotal()" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div id="hargaSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="harga_barang_display" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Harga Barang</label>
                    <input type="text" id="harga_barang_display" name="harga_barang_display" readonly class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div id="totalSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="total_harga" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" readonly class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div id="adminSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Admin</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div id="descriptionSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi</label>
                    <input type="text" id="purpose" name="purpose" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div id="supplierSection" class="mb-4">
                    <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier Produk</label>
                    <select id="supplier" name="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <?php
                        $SP = model('App\Models\SupplierModel')->findAll();
                        foreach ($SP as $s) : ?>
                            <option value="<?= $s['name']; ?>"><?= $s['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="paymentSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode Pembayaran</label>
                    <select id="payment_method" name="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Tentukan Metode</option>
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>
                <div id="referenceSection" class="mb-4"> <!-- Added id for easier manipulation -->
                    <label for="reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nomor Kwitansi</label>
                    <input type="text" id="reference_number" name="reference_number" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
                    <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ms-3" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(type, id, nama_barang, harga_beli, harga_jual) {
        console.log(id); // Debugging: Ensure the correct id is passed

        document.getElementById('jenis').value = type;
        document.getElementById('id').value = id; // Correctly assigning the id
        document.getElementById('nama_barang').value = nama_barang;
        const harga_barang = type === 'in' ? harga_beli : harga_jual;
        document.getElementById('harga_barang').value = harga_barang;
        document.getElementById('harga_barang_display').value = formatRupiah(harga_barang.toString(), 'Rp. ');

        // Clear total harga and quantity
        document.getElementById('total_harga').value = '';
        document.getElementById('jumlah').value = '';

        document.getElementById('modalTitle').innerText = type === 'in' ? 'Barang Masuk' : 'Barang Keluar';

        // Toggle sections visibility based on type
        const supplierSection = document.getElementById('supplierSection');
        const hargaSection = document.getElementById('hargaSection');
        const totalSection = document.getElementById('totalSection');
        const paymentSection = document.getElementById('paymentSection');
        const referenceSection = document.getElementById('referenceSection');

        if (type === 'out') {
            supplierSection.classList.add('hidden');
            hargaSection.classList.add('hidden');
            totalSection.classList.add('hidden');
            paymentSection.classList.add('hidden');
            referenceSection.classList.add('hidden');
        } else {
            supplierSection.classList.remove('hidden');
            hargaSection.classList.remove('hidden');
            totalSection.classList.remove('hidden');
            paymentSection.classList.remove('hidden');
            referenceSection.classList.remove('hidden');
        }

        document.getElementById('transactionModal').classList.remove('hidden');
    }


    function closeModal() {
        document.getElementById('transactionModal').classList.add('hidden');
    }

    // Function to calculate total price
    function calculateTotal() {
        const harga_barang = parseFloat(document.getElementById('harga_barang').value);
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        const total_harga = harga_barang * jumlah;
        document.getElementById('total_harga').value = formatRupiah(total_harga.toString(), 'Rp. ');
    }

    // Function to format number to Rupiah currency format
    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
</script>

<?= $this->endSection() ?>