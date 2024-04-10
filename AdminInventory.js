document.addEventListener('DOMContentLoaded', function () {
    // Get the edit modal and its fields
    const editModal = document.getElementById('editProductModal');
    const productid = editModal.querySelector('#product_id');
    const productNameInput = editModal.querySelector('#product_name');
    const productCategoryInput = editModal.querySelector('#product_category');
    const priceInput = editModal.querySelector('#price');
    const stockInput = editModal.querySelector('#stock');

    const deleteModal = document.getElementById('deleteProductModal');
    const deleteProductid = deleteModal.querySelector('#delete_product_id');

    console.log(priceInput.value);

    // Add click event listener to all edit buttons
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the product data from the button's data attributes
            const productName = this.getAttribute('data-product-name');
            const productId = this.getAttribute('data-product-id');
            const productCategory = this.getAttribute('data-product-category');
            const price = this.getAttribute('data-price');
            const stock = this.getAttribute('data-stock');

            // Set the values of the edit form fields
            productNameInput.value = productName;
            productid.value = productId;
            productCategoryInput.value = productCategory;
            priceInput.value = price;
            stockInput.value = stock;
        });
    });

    // Add click event listener to all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the product data from the button's data attributes
            const productId = this.getAttribute('data-product-id');

            // Set the value of the delete form field
            deleteProductid.value = productId;
        });
    });

    // add event listener if user checks the checkbox on change product photo
    const changePhotoCheckbox = document.getElementById('changeImage');
    const productImageInput = document.getElementById('product_image_edit');
    changePhotoCheckbox.addEventListener('change', function () {
        if (this.checked) {
            productImageInput.disabled = false;
        } else {
            productImageInput.disabled = true;
        }
    });

    const plusBtn = document.getElementById('plus');
    const minusBtn = document.getElementById('minus');

    plusBtn.addEventListener('click', function () {
        stockInput.value = parseInt(stockInput.value) + 1;
    });

    minusBtn.addEventListener('click', function () {
        const currentValue = parseInt(stockInput.value);
        if (currentValue > 0) {
            stockInput.value = currentValue - 1;
        }
    });
});
