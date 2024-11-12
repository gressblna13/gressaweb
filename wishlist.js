document.addEventListener('DOMContentLoaded', function () {
    const wishlistIcons = document.querySelectorAll('.wishlist-icon');

    wishlistIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const category = this.getAttribute('data-category');
            const userId = 1; // Ganti dengan user ID yang sesuai

            // Tambahkan ke wishlist
            fetch('wishlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_id=' + userId + '&product_id=' + productId + '&category=' + category,
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                this.classList.toggle('active'); // Ubah warna ikon
                updateWishlistCount();
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateWishlistCount() {
        fetch('wishlist_count.php')
            .then(response => response.text())
            .then(count => {
                document.getElementById('wishlist-count').innerText = count;
            })
            .catch(error => console.error('Error:', error));
    }
});
