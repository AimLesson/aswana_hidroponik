<!doctype html>
<html>

<head>
    <title>Aswana Hidroponik</title>
    <link rel="icon" href="bg.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('asset/bg.jpg'); /* Replace with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body>
    <?= $this->include('component/navbar.php') ?>
    <div class="p-4">
        <div class="p-4 items-center border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <?= $this->renderSection('content') ?>
        </div>
        <?= $this->include('component/footer.php') ?>
    </div>

    <!--SCRIPT-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success') ?>'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session()->getFlashdata('error') ?>'
            });
        </script>
    <?php endif; ?>
</body>

</html>
