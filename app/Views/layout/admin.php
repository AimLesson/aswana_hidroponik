<!doctype html>
<html>

<head>
    <title>Aswana Hidroponik</title>
    <link rel="icon" href="bg.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?= $this->include('component/sidebar.php') ?>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <?= $this->renderSection('content') ?>
        </div>
        <?= $this->include('component/footer.php') ?>
    </div>

    <!--SCRIPT-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable for "Barang Masuk"
            var dataTableIn = $('#tb_report_in').DataTable({
                dom: 'Bfrtip',
                scrollX: true, // Enable horizontal scrolling
                buttons: [{
                    extend: 'print',
                    title: '', // Remove the default title
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Actions) from being printed
                    },
                    customize: function(win) {
                        var selectedMonthText = $('#monthFilter option:selected').text(); // Get the selected month text
                        var subtitle = selectedMonthText ? 'Periode : ' + selectedMonthText : 'All Data';

                        // Calculate the total
                        var total = $('#tb_report_in').DataTable().column(6).data().reduce(function(a, b) {
                            var intVal = function(i) {
                                return typeof i === 'string' ?
                                    parseFloat(i.replace(/[\Rp,.]/g, '')) || 0 :
                                    typeof i === 'number' ?
                                    i : 0;
                            };
                            return intVal(a) + intVal(b);
                        }, 0);

                        $(win.document.body)
                            .css('font-size', '12pt')
                            .prepend(
                                '<div class="flex items-center mb-2">' +
                                    '<div class="text-left">' +
                                        '<img src="bg.png" class="ms-3" style="height: 75px;"/>' +
                                    '</div>' +
                                    '<div class="me-5" style="flex: 2; text-align: center;">' +
                                    '<h2 style="margin: 0;">Aswana Hidroponik</h2>' +
                                    '<h2 style="margin: 0;">Laporan Pembelian Barang</h2>' +
                                    '<h4 style="margin: 0;">' + subtitle + ' - Total: Rp ' + total.toLocaleString('id-ID') + '</h4>' +
                                '</div>' +
                                '</div>'
                            );

                        $(win.document.body).find('tfoot th').eq(6).text('Rp ' + total.toLocaleString('id-ID'));
                    }
                }],
                columnDefs: [{
                    targets: -1,
                    visible: true,
                    searchable: false,
                    orderable: false
                }],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // Function to remove formatting and convert the value to a float
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            parseFloat(i.replace(/[\Rp,.]/g, '')) || 0 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    var total = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(6).footer()).html('Rp ' + total.toLocaleString('id-ID'));
                }
            });

            // Initialize DataTable for "Barang Keluar"
            var dataTableOut = $('#tb_report_out').DataTable({
                dom: 'Bfrtip',
                scrollX: true, // Enable horizontal scrolling
                buttons: [{
                    extend: 'print',
                    title: '', // Remove the default title
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Actions) from being printed
                    },
                    customize: function(win) {
                        var selectedMonthText = $('#monthFilter option:selected').text(); // Get the selected month text
                        var subtitle = selectedMonthText ? 'Periode ' + selectedMonthText : 'All Data';

                        $(win.document.body)
                            .css('font-size', '12pt')
                            .prepend(
                                '<div class="flex items-center mb-2">' +
                                    '<div class="text-left">' +
                                    '<img src="bg.png" class="ms-3" style="height: 75px;"/>' +
                                    '</div>' +
                                '<div class="me-5" style="flex: 2; text-align: center;">' +
                                    '<h2 style="margin: 0;">Aswana Hidroponik</h2>' +
                                    '<h2 style="margin: 0;">Laporan Pengeluaran Barang</h2>' +
                                    '<h4 style="margin: 0;">' + subtitle + '</h4>' +
                                '</div>' +
                                '</div>'
                            );
                    }
                }],
                columnDefs: [{
                    targets: -1,
                    visible: true,
                    searchable: false,
                    orderable: false
                }]
            });

            // Event listener for month filter dropdown
            $('#monthFilter').on('change', function() {
                var selectedMonth = $(this).val(); // Get the selected month

                // Custom filtering function for "Barang Masuk"
                $.fn.dataTable.ext.search.push(function(settings, data) {
                    if (settings.nTable.id !== 'tb_report_in') return true; // Only apply to the correct table

                    var dateColumnIndexIn = 9; // Index for "Waktu" in "Barang Masuk" table
                    var date = data[dateColumnIndexIn] || ''; // Get the date value from the row
                    var month = date.substr(5, 2); // Extract the month from the date

                    if (!selectedMonth || month === selectedMonth) {
                        return true; // Show all data if no month is selected or matches the selected month
                    }
                    return false; // Hide rows that don't match the month
                });

                dataTableIn.draw(); // Redraw "Barang Masuk" table based on the filter
                $.fn.dataTable.ext.search.pop(); // Remove the filter function after applying

                // Custom filtering function for "Barang Keluar"
                $.fn.dataTable.ext.search.push(function(settings, data) {
                    if (settings.nTable.id !== 'tb_report_out') return true; // Only apply to the correct table

                    var dateColumnIndexOut = 6; // Index for "Waktu" in "Barang Keluar" table
                    var date = data[dateColumnIndexOut] || ''; // Get the date value from the row
                    var month = date.substr(5, 2); // Extract the month from the date

                    if (!selectedMonth || month === selectedMonth) {
                        return true; // Show all data if no month is selected or matches the selected month
                    }
                    return false; // Hide rows that don't match the month
                });

                dataTableOut.draw(); // Redraw "Barang Keluar" table based on the filter
                $.fn.dataTable.ext.search.pop(); // Remove the filter function after applying
            });
        });
    </script>




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