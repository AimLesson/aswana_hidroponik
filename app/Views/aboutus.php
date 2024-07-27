<?php 
$produk = model('App\Models\produkModel')->findAll(); 
?>

<?= $this->extend('layout/guest.php') ?>

<?= $this->section('content') ?>

<!-- About Us Section -->
<div class="flex justify-center items-center mt-8 mb-8">
    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img 
            class="m-2 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" 
            src="bg.png" 
            alt="About Us"
        >
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">About Us</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Aswana Hidroponik merupakan salah satu perusahaan yang bergerak pada bidang pertanian hidroponik. 
                Aswana Hidroponik menyediakan berbagai macam sayuran seperti caisim, kangkung, selada, kailan, kale, mint, pokcoy, dan siomak.
            </p>
        </div>
    </a>
</div>

<!-- Sumber Daya Manusia Section -->
<h3 class="text-3xl font-bold text-center dark:text-white mt-4">Sumber Daya Manusia</h3>
<div class="flex grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4 mt-4">
    <?php 
    $sdm = [
        ['name' => 'Bpk. Gatot', 'image' => 'sdm/gatot.jpg'],
        ['name' => 'Ibu Christin', 'image' => 'sdm/christin.jpg'],
        ['name' => 'Bpk. Sito', 'image' => 'sdm/sito.jpg'],
        ['name' => 'Ibu Tuti', 'image' => 'sdm/tuti.jpg'],
    ];
    foreach ($sdm as $person) : 
    ?>
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img 
                class="w-full h-68 object-cover rounded-t-lg" 
                src="<?= $person['image'] ?>" 
                alt="<?= htmlspecialchars($person['name'], ENT_QUOTES) ?>" 
            />
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <?= htmlspecialchars($person['name'], ENT_QUOTES) ?>
                </h5>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
