function toggleWishlist(button) {
    let productId = button.getAttribute("data-id");
    let heartIcon = button.querySelector("i");

    fetch("wishlist_action.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "sanpham_id=" + productId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            heartIcon.classList.toggle("text-danger");
            heartIcon.classList.toggle("text-secondary");
        } else {
            alert(data.message); // Hiển thị lỗi (nếu có)
        }
    })
    .catch(error => console.error("Error:", error));
}
