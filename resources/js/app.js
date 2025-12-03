// resources/js/app.js
// Contoh untuk tombol "Create New Post"
document.addEventListener('DOMContentLoaded', function() {
    const createPostButton = document.getElementById('create-post-button');
    const createPostModal = document.getElementById('create-post-modal');
    const closeModalButton = document.getElementById('close-modal-button'); // Tambahkan tombol close

    if (createPostButton && createPostModal) {
        createPostButton.addEventListener('click', function() {
            createPostModal.classList.remove('hidden'); // Atau display: block
        });

        closeModalButton.addEventListener('click', function() { // Tambahkan event listener untuk tombol close
            createPostModal.classList.add('hidden');
        });

        // Tutup modal jika klik di luar area modal
        createPostModal.addEventListener('click', function(e) {
            if (e.target === createPostModal) {
                createPostModal.classList.add('hidden');
            }
        });
    }

    // ... JavaScript untuk fitur interaktif lainnya ...
});