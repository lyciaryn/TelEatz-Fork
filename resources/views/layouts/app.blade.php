<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link class="rounded" rel="shortcut icon" href="{{ asset('img/Teleatz1-white-full.png') }}" type="image/x-icon">
</head>

<body style="background-color: #fafbfd;">
    @yield('content')

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        </script>
    @endif

    @if (session('justsuccess'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('justsuccess') }}",
                icon: "success",
                timer: 1000, // 2000 ms = 2 detik
                showConfirmButton: false // Hilangkan tombol OK
            });
        </script>
    @endif

    {{-- @if (session('successlogin'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "Kamu berhasil login",
            icon: "success"
        });
    </script>
    @endif --}}

    @if (session('deletesuccess'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "Makanan Berhasil Terhapus", // Menampilkan pesan dari session success1
                icon: "success",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        </script>
    @endif



    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: false,
                customClass: {
                    confirmButton: 'btn btn-danger me-4',
                    cancelButton: 'btn btn-primary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>


    <script>
        function confirmLogout() {
            Swal.fire({
                title: "Yakin ingin logout?",
                text: "Sesi kamu akan berakhir.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: false,
                customClass: {
                    confirmButton: 'btn btn-danger me-4',
                    cancelButton: 'btn btn-primary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout').submit();
                }
            });
        }
    </script>

    <script>
        function confirmCancel(orderId) {
            Swal.fire({
                title: "Yakin ingin membatalkan pesanan?",
                text: "Tindakan ini tidak bisa dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Batalkan',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form-' + orderId).submit();
                }
            });
        }
    </script>



    <script>
        function previewImage() {
            const input = document.getElementById('img');
            const preview = document.getElementById('imagePreview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
