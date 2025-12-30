@if (session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
        });

        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "Gagal",
            text: "{{ session('error') }}",
            icon: "error",
            draggable: true
        });
    </script>
@endif


@if ($errors->any())
    <script>
        Swal.fire({
            title: "Validasi Gagal",
            html: `{!! implode('<br>', $errors->all()) !!}`,
            icon: "error",
            draggable: true
        });
    </script>
@endif

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Data pengguna akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    window.addEventListener('offline', () => {
        Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question"
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.form-approve').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Approve artikel?',
                    text: 'Artikel akan dipublikasikan dan tampil ke publik',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, approve',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#198754', // bootstrap green
                    cancelButtonColor: '#dc3545',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.form-reject').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Tolak artikel?',
                    text: 'Masukkan alasan penolakan',
                    icon: 'warning',
                    input: 'textarea',
                    inputPlaceholder: 'Tulis alasan penolakan...',
                    inputAttributes: {
                        'aria-label': 'Alasan penolakan'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    preConfirm: (value) => {
                        if (!value) {
                            Swal.showValidationMessage('Alasan wajib diisi');
                        }
                        return value;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.querySelector('input[name="reason"]').value = result.value;
                        form.submit();
                    }
                });
            });
        });
    });
</script>
