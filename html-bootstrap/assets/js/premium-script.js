// ============================
// SIGAP ALAM - Premium UI/UX
// Interactive JavaScript
// ============================

// ============================
// Toast Notification System
// ============================

class ToastManager {
    constructor() {
        this.container = this.createContainer();
    }

    createContainer() {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    show(type, title, message, duration = 4000) {
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        
        const icons = {
            success: '<i class="bi bi-check-circle-fill" style="color: #10b981; font-size: 1.5rem;"></i>',
            error: '<i class="bi bi-x-circle-fill" style="color: #ef4444; font-size: 1.5rem;"></i>',
            warning: '<i class="bi bi-exclamation-triangle-fill" style="color: #f59e0b; font-size: 1.5rem;"></i>',
            info: '<i class="bi bi-info-circle-fill" style="color: #0ea5e9; font-size: 1.5rem;"></i>'
        };

        toast.innerHTML = `
            <div class="toast-icon">${icons[type]}</div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        `;

        this.container.appendChild(toast);

        // Close button
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => this.remove(toast));

        // Auto remove
        setTimeout(() => this.remove(toast), duration);

        // Trigger animation
        setTimeout(() => toast.classList.add('show'), 10);

        return toast;
    }

    remove(toast) {
        toast.classList.add('removing');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }

    success(title, message) {
        return this.show('success', title, message);
    }

    error(title, message) {
        return this.show('error', title, message);
    }

    warning(title, message) {
        return this.show('warning', title, message);
    }

    info(title, message) {
        return this.show('info', title, message);
    }
}

// Initialize toast manager
const toast = new ToastManager();

// ============================
// Role Switcher
// ============================

class RoleSwitcher {
    constructor() {
        this.currentRole = 'user';
        this.init();
    }

    init() {
        // Create role switcher if doesn't exist
        const navbarNav = document.querySelector('.navbar-collapse .navbar-nav');
        if (navbarNav && !document.querySelector('.role-switcher')) {
            this.createRoleSwitcher(navbarNav);
        }

        // Event listeners
        this.setupEventListeners();
    }

    createRoleSwitcher(parent) {
        const roleSwitcherHTML = `
            <li class="nav-item role-switcher ms-2">
                <button class="role-switcher-btn">
                    <i class="bi bi-person-circle"></i>
                    <span>Demo Role</span>
                    <i class="bi bi-chevron-down" style="font-size: 0.75rem;"></i>
                </button>
                <div class="role-dropdown">
                    <div class="role-dropdown-header">
                        <h6>Pilih Role Demo</h6>
                    </div>
                    <button class="role-option" data-role="user">
                        <div class="role-icon user">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="role-info">
                            <div class="role-name">User</div>
                            <p class="role-description">Masyarakat umum - Baca artikel & komentar</p>
                        </div>
                    </button>
                    <button class="role-option" data-role="contributor">
                        <div class="role-icon contributor">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div class="role-info">
                            <div class="role-name">Kontributor</div>
                            <p class="role-description">Penulis artikel - Kelola konten edukasi</p>
                        </div>
                    </button>
                    <button class="role-option" data-role="admin">
                        <div class="role-icon admin">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                        <div class="role-info">
                            <div class="role-name">Admin</div>
                            <p class="role-description">Administrator - Kelola sistem lengkap</p>
                        </div>
                    </button>
                </div>
            </li>
        `;

        parent.insertAdjacentHTML('beforeend', roleSwitcherHTML);
    }

    setupEventListeners() {
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.role-switcher-btn');
            const dropdown = document.querySelector('.role-dropdown');
            
            if (btn) {
                e.stopPropagation();
                dropdown?.classList.toggle('active');
            } else if (!e.target.closest('.role-dropdown')) {
                dropdown?.classList.remove('active');
            }
        });

        // Role selection
        document.addEventListener('click', (e) => {
            const roleOption = e.target.closest('.role-option');
            if (roleOption) {
                const role = roleOption.dataset.role;
                this.switchRole(role);
            }
        });
    }

    switchRole(role) {
        const routes = {
            user: 'index.html',
            contributor: 'dashboard-contributor.html',
            admin: 'dashboard-admin.html'
        };

        const roleNames = {
            user: 'User',
            contributor: 'Kontributor',
            admin: 'Admin'
        };

        toast.info('Mengalihkan...', `Beralih ke role ${roleNames[role]}`);

        setTimeout(() => {
            window.location.href = routes[role];
        }, 800);
    }
}

// Initialize role switcher
const roleSwitcher = new RoleSwitcher();

// ============================
// Smooth Scroll & Animations
// ============================

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe elements on page load
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.card-custom, .article-card, .stats-card').forEach(el => {
        observer.observe(el);
    });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href !== '#!') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// Navbar scroll effect
let lastScroll = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        navbar?.classList.add('scrolled');
    } else {
        navbar?.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
});

// ============================
// Card Click Handlers
// ============================

// Disaster category cards
document.querySelectorAll('.card-custom').forEach(card => {
    card.addEventListener('click', function(e) {
        // Don't trigger if clicking a link inside
        if (e.target.closest('a')) return;
        
        const link = this.querySelector('.card-link');
        if (link) {
            const href = link.getAttribute('href');
            if (href && href !== '#') {
                toast.info('Memuat...', 'Membuka halaman detail');
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            }
        }
    });
});

// Article cards
document.querySelectorAll('.article-card').forEach(card => {
    card.addEventListener('click', function(e) {
        if (e.target.closest('a')) return;
        
        toast.info('Memuat...', 'Membuka artikel');
        setTimeout(() => {
            window.location.href = 'detail-artikel.html';
        }, 500);
    });
});

// ============================
// Form Validation
// ============================

document.querySelectorAll('.needs-validation').forEach(form => {
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            toast.error('Form Tidak Valid', 'Mohon lengkapi semua field yang diperlukan');
        }
        form.classList.add('was-validated');
    }, false);
});

// ============================
// CRUD Operations
// ============================

// Delete confirmation
window.confirmDelete = function(id, title) {
    if (confirm(`Apakah Anda yakin ingin menghapus "${title}"?`)) {
        toast.info('Menghapus...', 'Proses penghapusan data');
        
        // Simulate API call
        setTimeout(() => {
            toast.success('Berhasil!', 'Data berhasil dihapus');
            // Reload or update UI
            setTimeout(() => location.reload(), 1000);
        }, 1000);
    }
};

// Approve article
window.approveArticle = function(id) {
    if (confirm('Setujui artikel ini untuk dipublikasikan?')) {
        toast.info('Memproses...', 'Menyetujui artikel');
        
        setTimeout(() => {
            toast.success('Disetujui!', 'Artikel berhasil dipublikasikan');
            setTimeout(() => location.reload(), 1000);
        }, 1000);
    }
};

// Reject article
window.rejectArticle = function(id) {
    const note = prompt('Masukkan alasan penolakan:');
    if (note) {
        toast.info('Memproses...', 'Menolak artikel');
        
        setTimeout(() => {
            toast.warning('Ditolak', 'Artikel telah ditolak dengan catatan');
            setTimeout(() => location.reload(), 1000);
        }, 1000);
    }
};

// ============================
// Image Preview
// ============================

window.previewImage = function(input) {
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            toast.success('Gambar Dipilih', 'Preview gambar berhasil dimuat');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
};

// ============================
// Search & Filter
// ============================

window.searchArticles = function() {
    const input = document.getElementById('searchArticle');
    if (!input) return;
    
    const searchTerm = input.value.toLowerCase();
    const rows = document.querySelectorAll('.article-row');
    let found = 0;
    
    rows.forEach(row => {
        const title = row.querySelector('.article-title')?.textContent.toLowerCase() || '';
        if (title.includes(searchTerm)) {
            row.style.display = '';
            found++;
        } else {
            row.style.display = 'none';
        }
    });
    
    if (searchTerm && found === 0) {
        toast.info('Tidak Ditemukan', 'Tidak ada artikel yang cocok dengan pencarian');
    }
};

window.filterByStatus = function(status) {
    const rows = document.querySelectorAll('.article-row');
    let count = 0;
    
    rows.forEach(row => {
        const rowStatus = row.dataset.status;
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
            count++;
        } else {
            row.style.display = 'none';
        }
    });
    
    toast.info('Filter Diterapkan', `Menampilkan ${count} artikel`);
};

// ============================
// Modal Management
// ============================

window.openModal = function(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
};

// ============================
// Auto-generate Slug
// ============================

function generateSlug(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
}

const titleInput = document.getElementById('articleTitle');
const slugInput = document.getElementById('articleSlug');

if (titleInput && slugInput) {
    titleInput.addEventListener('input', function() {
        slugInput.value = generateSlug(this.value);
    });
}

// ============================
// Stats Animation
// ============================

function animateNumber(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value.toLocaleString('id-ID');
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate stats on page load
document.addEventListener('DOMContentLoaded', function() {
    const statsNumbers = document.querySelectorAll('.stats-number[data-value]');
    statsNumbers.forEach(stat => {
        const endValue = parseInt(stat.dataset.value);
        animateNumber(stat, 0, endValue, 1500);
    });
});

// ============================
// Loading States
// ============================

window.showLoading = function(button) {
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner me-2"></span>Loading...';
    button.dataset.originalText = originalText;
};

window.hideLoading = function(button) {
    button.disabled = false;
    button.innerHTML = button.dataset.originalText;
};

// ============================
// Utility Functions
// ============================

// Format date to Indonesian
window.formatDate = function(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

// Copy to clipboard
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text).then(() => {
        toast.success('Disalin!', 'Teks berhasil disalin ke clipboard');
    }).catch(() => {
        toast.error('Gagal', 'Tidak dapat menyalin teks');
    });
};

// ============================
// Page-specific Initializations
// ============================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize Bootstrap popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Welcome message based on page
    const path = window.location.pathname;
    const page = path.split('/').pop();
    
    if (page === 'index.html' || page === '') {
        setTimeout(() => {
            toast.info('Selamat Datang!', 'Jelajahi informasi bencana dan artikel edukasi');
        }, 500);
    }
});

// ============================
// Error Handling
// ============================

window.addEventListener('error', function(e) {
    console.error('Error occurred:', e.error);
    // Don't show toast for every error, only critical ones
});

// Handle offline/online status
window.addEventListener('offline', () => {
    toast.warning('Offline', 'Koneksi internet terputus');
});

window.addEventListener('online', () => {
    toast.success('Online', 'Koneksi internet kembali');
});

// ============================
// Export for use in other scripts
// ============================

window.SigapAlam = {
    toast,
    roleSwitcher,
    confirmDelete,
    approveArticle,
    rejectArticle,
    previewImage,
    searchArticles,
    filterByStatus,
    generateSlug,
    animateNumber,
    showLoading,
    hideLoading,
    formatDate,
    copyToClipboard
};

console.log('%c🌍 SIGAP ALAM ', 'background: linear-gradient(135deg, #059669, #0284c7); color: white; padding: 8px 16px; border-radius: 8px; font-weight: bold; font-size: 16px;');
console.log('%cSistem Edukasi Lingkungan dan Kesadaran Bencana', 'color: #059669; font-size: 12px;');
