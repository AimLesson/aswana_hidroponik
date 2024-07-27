<?php 
$carousel = model('App\Models\Image')->findAll(); 
$produk = model('App\Models\produkModel')->findAll(); 
?>

<?= $this->extend('layout/guest.php') ?>

<?= $this->section('content') ?>

<!-- Carousel -->
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <?php foreach ($carousel as $image) : ?>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img 
                    src="<?= $image['url'] ?>" 
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                    alt="<?= htmlspecialchars($image['description'], ENT_QUOTES) ?>"
                >
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Slider Indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <?php foreach ($carousel as $index => $image) : ?>
            <button 
                type="button" 
                class="w-3 h-3 rounded-full" 
                aria-current="<?= $index === 0 ? 'true' : 'false' ?>" 
                aria-label="Slide <?= $index + 1 ?>" 
                data-carousel-slide-to="<?= $index ?>"
            ></button>
        <?php endforeach; ?>
    </div>
    <!-- Slider Controls -->
    <button 
        type="button" 
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" 
        data-carousel-prev
    >
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg 
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" 
                aria-hidden="true" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 6 10"
            >
                <path 
                    stroke="currentColor" 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M5 1 1 5l4 4" 
                />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button 
        type="button" 
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" 
        data-carousel-next
    >
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg 
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" 
                aria-hidden="true" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 6 10"
            >
                <path 
                    stroke="currentColor" 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="m1 9 4-4-4-4" 
                />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<!-- Produk Section -->
<h3 class="text-3xl text-center font-bold dark:text-white mt-8">Daftar Produk</h3>
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
