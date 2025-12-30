
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/premium-script.js') }}"></script>
    
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('active');
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                toast.info('Logging out...', 'Mengalihkan ke halaman login');
                setTimeout(() => window.location.href = 'login.html', 1000);
            }
        }

        function filterUsers(role) {
            const rows = document.querySelectorAll('.user-row');
            const tabs = document.querySelectorAll('.filter-tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.closest('.filter-tab').classList.add('active');
            
            let count = 0;
            rows.forEach(row => {
                if (role === 'all' || row.dataset.role === role) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });
            toast.info('Filter Diterapkan', `Menampilkan ${count} pengguna`);
        }

        function searchUsers() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.user-row');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }

        function openAddUserModal() {
            document.getElementById('userModalTitle').innerHTML = '<i class="bi bi-person-plus text-success me-2"></i>Tambah Pengguna Baru';
            document.getElementById('userForm').reset();
            const modal = new bootstrap.Modal(document.getElementById('userModal'));
            modal.show();
        }

        function viewUser(id) {
            toast.info('Membuka Detail', 'Memuat informasi pengguna...');
        }

        function editUser(id) {
            document.getElementById('userModalTitle').innerHTML = '<i class="bi bi-pencil text-primary me-2"></i>Edit Pengguna';
            const modal = new bootstrap.Modal(document.getElementById('userModal'));
            modal.show();
        }

        function saveUser() {
            const form = document.getElementById('userForm');
            if (!form.checkValidity()) {
                toast.error('Form Tidak Lengkap', 'Harap lengkapi semua field');
                return;
            }
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
            modal.hide();
            toast.info('Memproses...', 'Menyimpan data pengguna');
            setTimeout(() => {
                toast.success('Berhasil!', 'Data pengguna berhasil disimpan');
                location.reload();
            }, 1000);
        }

        function toggleUserStatus(id) {
            if (confirm('Apakah Anda yakin ingin mengubah status pengguna ini?')) {
                toast.info('Memproses...', 'Mengubah status pengguna');
                setTimeout(() => {
                    toast.success('Berhasil!', 'Status pengguna berhasil diubah');
                    location.reload();
                }, 1000);
            }
        }

        function deleteUser(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus pengguna "${name}"?`)) {
                toast.info('Menghapus...', 'Proses penghapusan data');
                setTimeout(() => {
                    toast.success('Berhasil!', 'Pengguna berhasil dihapus');
                    location.reload();
                }, 1000);
            }
        }
    </script>
</body>
</html>
