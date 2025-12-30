// ============================
// SIGAP ALAM - Main JavaScript
// ============================

// Smooth scroll animation
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all cards and sections
    document.querySelectorAll('.card-custom, .article-card, .stats-card').forEach(el => {
        observer.observe(el);
    });
});

// Mobile sidebar toggle
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.querySelector('.sidebar');

if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
}

// Close sidebar when clicking outside (mobile)
document.addEventListener('click', function(event) {
    if (sidebar && sidebar.classList.contains('active')) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    }
});

// ============================
// Form Validation
// ============================

// Bootstrap form validation
(function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

// ============================
// Article Management
// ============================

// Delete article confirmation
function confirmDelete(articleId, articleTitle) {
    if (confirm(`Apakah Anda yakin ingin menghapus artikel "${articleTitle}"?`)) {
        // In real implementation, this would call API
        console.log('Deleting article:', articleId);
        alert('Artikel berhasil dihapus!');
        // Reload or remove row
        location.reload();
    }
}

// Approve article
function approveArticle(articleId) {
    if (confirm('Setujui artikel ini untuk dipublikasikan?')) {
        // In real implementation, this would call API
        console.log('Approving article:', articleId);
        alert('Artikel berhasil disetujui!');
        location.reload();
    }
}

// Reject article
function rejectArticle(articleId) {
    const note = prompt('Masukkan alasan penolakan:');
    if (note) {
        // In real implementation, this would call API
        console.log('Rejecting article:', articleId, 'Note:', note);
        alert('Artikel ditolak!');
        location.reload();
    }
}

// ============================
// Image Preview
// ============================

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// ============================
// Comment System
// ============================

function submitComment(event) {
    event.preventDefault();
    
    const form = event.target;
    const name = form.querySelector('[name="name"]').value;
    const email = form.querySelector('[name="email"]').value;
    const comment = form.querySelector('[name="comment"]').value;
    
    if (!name || !comment) {
        alert('Nama dan komentar harus diisi!');
        return;
    }
    
    // In real implementation, this would call API
    console.log('Submitting comment:', { name, email, comment });
    
    // Add comment to list
    const commentList = document.getElementById('commentList');
    const newComment = document.createElement('div');
    newComment.className = 'border-bottom pb-3 mb-3';
    newComment.innerHTML = `
        <div class="d-flex align-items-start gap-3">
            <div class="bg-gradient-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                <strong>${name.charAt(0).toUpperCase()}</strong>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <strong class="d-block">${name}</strong>
                        <small class="text-muted">Baru saja</small>
                    </div>
                </div>
                <p class="mb-0">${comment}</p>
            </div>
        </div>
    `;
    
    commentList.insertBefore(newComment, commentList.firstChild);
    
    // Reset form
    form.reset();
    alert('Komentar berhasil ditambahkan!');
}

// ============================
// Search & Filter
// ============================

function searchArticles() {
    const searchInput = document.getElementById('searchArticle');
    if (!searchInput) return;
    
    const searchTerm = searchInput.value.toLowerCase();
    const articleRows = document.querySelectorAll('.article-row');
    
    articleRows.forEach(row => {
        const title = row.querySelector('.article-title').textContent.toLowerCase();
        if (title.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterByStatus(status) {
    const articleRows = document.querySelectorAll('.article-row');
    
    articleRows.forEach(row => {
        const rowStatus = row.dataset.status;
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// ============================
// Modal Management
// ============================

// Open disaster modal for add
function openAddDisasterModal() {
    const modal = new bootstrap.Modal(document.getElementById('disasterModal'));
    document.getElementById('disasterModalLabel').textContent = 'Tambah Jenis Bencana';
    document.getElementById('disasterForm').reset();
    document.getElementById('disasterId').value = '';
    modal.show();
}

// Open disaster modal for edit
function editDisaster(id, name, icon, description) {
    const modal = new bootstrap.Modal(document.getElementById('disasterModal'));
    document.getElementById('disasterModalLabel').textContent = 'Edit Jenis Bencana';
    document.getElementById('disasterId').value = id;
    document.getElementById('disasterName').value = name;
    document.getElementById('disasterIcon').value = icon;
    document.getElementById('disasterDescription').value = description;
    modal.show();
}

// Save disaster (add or update)
function saveDisaster(event) {
    event.preventDefault();
    
    const form = event.target;
    const id = form.querySelector('#disasterId').value;
    const name = form.querySelector('#disasterName').value;
    const icon = form.querySelector('#disasterIcon').value;
    const description = form.querySelector('#disasterDescription').value;
    
    // In real implementation, this would call API
    if (id) {
        console.log('Updating disaster:', { id, name, icon, description });
        alert('Jenis bencana berhasil diupdate!');
    } else {
        console.log('Creating disaster:', { name, icon, description });
        alert('Jenis bencana berhasil ditambahkan!');
    }
    
    // Close modal and reload
    const modal = bootstrap.Modal.getInstance(document.getElementById('disasterModal'));
    modal.hide();
    location.reload();
}

// Delete disaster
function deleteDisaster(id, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus jenis bencana "${name}"?`)) {
        // In real implementation, this would call API
        console.log('Deleting disaster:', id);
        alert('Jenis bencana berhasil dihapus!');
        location.reload();
    }
}

// ============================
// Text Editor (Simple)
// ============================

// Initialize simple text formatting
function formatText(command, value = null) {
    document.execCommand(command, false, value);
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
        element.textContent = value;
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate stats on page load
document.addEventListener('DOMContentLoaded', function() {
    const statsNumbers = document.querySelectorAll('.stats-number');
    statsNumbers.forEach(stat => {
        const endValue = parseInt(stat.dataset.value || stat.textContent);
        animateNumber(stat, 0, endValue, 1500);
    });
});

// ============================
// Role Switcher (For Demo)
// ============================

function switchRole(role) {
    console.log('Switching to role:', role);
    
    switch(role) {
        case 'user':
            window.location.href = 'index.html';
            break;
        case 'contributor':
            window.location.href = 'dashboard-contributor.html';
            break;
        case 'admin':
            window.location.href = 'dashboard-admin.html';
            break;
    }
}

// ============================
// Utility Functions
// ============================

// Format date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Generate slug from title
function generateSlug(title) {
    return title
        .toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/--+/g, '-')
        .trim();
}

// Auto-generate slug when title changes
const titleInput = document.getElementById('articleTitle');
const slugInput = document.getElementById('articleSlug');

if (titleInput && slugInput) {
    titleInput.addEventListener('input', function() {
        slugInput.value = generateSlug(this.value);
    });
}

// ============================
// Toast Notifications
// ============================

function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        // Create toast container if doesn't exist
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'position-fixed top-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }
    
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.getElementById('toastContainer').appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Remove toast after hidden
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
}

// ============================
// Loading State
// ============================

function showLoading(button) {
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
    button.dataset.originalText = originalText;
}

function hideLoading(button) {
    button.disabled = false;
    button.innerHTML = button.dataset.originalText;
}

// ============================
// Local Storage Helper
// ============================

const Storage = {
    set: function(key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    },
    get: function(key) {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    },
    remove: function(key) {
        localStorage.removeItem(key);
    },
    clear: function() {
        localStorage.clear();
    }
};

// ============================
// Initialize tooltips and popovers
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
});
