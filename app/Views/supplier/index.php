<?= $this->extend('layout/admin.php') ?>

<?= $this->section('content') ?>

<div class="p-4">
  <!-- Breadcrumb -->
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
          <a href="/supplier" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Supplier</a>
        </div>
      </li>
    </ol>
  </nav>


  <a href="<?= site_url('supplier/create') ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mb-3">Tambah Supplier</a>
  <div class="relative border overflow-x-auto shadow-md sm:rounded-lg p-3 mt-4">
    <table id="tb_supplier" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="p-4">ID</th>
          <th scope="col" class="px-6 py-3">Nama Supplier</th>
          <th scope="col" class="px-6 py-3">Alamat</th>
          <th scope="col" class="px-6 py-3">No. Telp / HP</th>
          <th scope="col" class="px-6 py-3">Perusahaan</th>
          <th scope="col" class="px-6 py-3">No. Rekening</th>
          <th scope="col" class="px-6 py-3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($suppliers as $supplier) : ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="p-4"><?= $supplier['id'] ?></td>
            <td class="px-6 py-4"><?= $supplier['name'] ?></td>
            <td class="px-6 py-4"><?= $supplier['address'] ?></td>
            <td class="px-6 py-4"><?= $supplier['phone'] ?></td>
            <td class="px-6 py-4"><?= $supplier['company'] ?></td>
            <td class="px-6 py-4"><?= $supplier['rekening'] ?></td>
            <td class="flex items-center px-6 py-4">
              <a href="<?= base_url('supplier/edit/' . $supplier['id']) ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="confirmDelete('<?= $supplier['id'] ?>')">Remove</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function confirmDelete(itemId) {
    Swal.fire({
      title: 'Hapus Supplier Ini?',
      text: "Tindakan ini tidak bisa dibatalkan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?= base_url('supplier/delete/') ?>' + itemId;
      }
    })
  }
</script>
<?= $this->endSection() ?>