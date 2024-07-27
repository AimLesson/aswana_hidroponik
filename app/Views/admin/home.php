<?php $carousel = model('App\Models\Image')->findAll(); ?>
<?php $produk = model('App\Models\produkModel')->findAll(); ?>

<?= $this->extend('layout/admin.php') ?>

<?= $this->section('content') ?>

<!-- Carousel -->
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <?php foreach ($carousel as $image) : ?>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?= $image['url'] ?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="<?= $image['description'] ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <?php foreach ($carousel as $index => $image) : ?>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>" data-carousel-slide-to="<?= $index ?>"></button>
        <?php endforeach; ?>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4 mt-4 mb-4">
    <a href="/transaksi" class="flex items-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <svg class="w-[38px] h-[38px] mr-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
        </svg>
        <h5 class="text-2xl ms-2 font-bold tracking-tight text-gray-900 dark:text-white">Transaksi Barang</h5>
    </a>

    <a href="/barang" class="flex items-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <svg class="w-[38px] h-[38px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z" clip-rule="evenodd" />
        </svg>
        <h5 class="text-2xl ms-2 font-bold tracking-tight text-gray-900 dark:text-white">Daftar Barang</h5>
    </a>

    <a href="/supplier" class="flex items-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <svg class="w-[38px] h-[38px] mr-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z" clip-rule="evenodd" />
        </svg>
        <h5 class="text-2xl ms-2 font-bold tracking-tight text-gray-900 dark:text-white">Supplier</h5>
    </a>

    <a href="/laporan" class="flex items-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <svg class="w-[38px] h-[38px] mr-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z" clip-rule="evenodd" />
        </svg>

        <h5 class="text-2xl ms-2 font-bold tracking-tight text-gray-900 dark:text-white">Laporan</h5>
    </a>
</div>






<?= $this->endSection() ?>