import './bootstrap';
import Swal from 'sweetalert2';

// Fungsi untuk menampilkan alert saat halaman dimuat
function showAlert(message, type = 'success') {
    Swal.fire({
        icon: type,
        title: 'Notification',
        text: message,
        confirmButtonText: 'OK'
    });
}

// Event listener untuk menjalankan fungsi saat dokumen siap
document.addEventListener('DOMContentLoaded', function() {
    // Mengambil elemen flash message dari DOM
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        const message = flashMessage.dataset.message;
        const type = flashMessage.dataset.type || 'success';
        showAlert(message, type);
    }
});


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
