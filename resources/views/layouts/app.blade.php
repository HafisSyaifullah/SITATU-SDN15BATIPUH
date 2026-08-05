<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} - SITU SDN 15 Batipuh</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main-content">
            @include('layouts.navbar')

            <main class="content-area">
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: @json(session('success')),
                                timer: 2500,
                                showConfirmButton: false,
                            });
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: @json(session('error')),
                            });
                        });
                    </script>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

    <script>
        // Setup CSRF token untuk semua request AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle tombol hapus dengan konfirmasi SweetAlert di semua halaman
        $(document).on('click', '.btn-delete', function () {
            const url = $(this).data('url');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: url,
                    });
                    form.append('@csrf');
                    form.append('@method("DELETE")');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>