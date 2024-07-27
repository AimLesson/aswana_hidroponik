<?php 
$produk = model('App\Models\produkModel')->findAll(); 
?>

<?= $this->extend('layout/guest.php') ?>

<?= $this->section('content') ?>

<!-- Produk Section -->
<h3 class="text-3xl text-center font-bold dark:text-white mt-3">Daftar Produk</h3>
<div class="flex grid gap-6 mb-6 md:grid-cols-5 lg:grid-cols-4 mt-4">
    <?php foreach ($produk as $item) : ?>
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img 
                    class="rounded-t-lg" 
                    src="produk/<?= $item['image'] ?>" 
                    alt="<?= htmlspecialchars($item['nama_produk'], ENT_QUOTES) ?>" 
                />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <?= htmlspecialchars($item['nama_produk'], ENT_QUOTES) ?>
                    </h5>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
