$(document).ready(function() {
    $('.delete_category_button').click(function() {
        let category_id = $(this).val();
        let product_count = $(this).data("product-count");
        $('#category_id').val(category_id);
        $('#product_count').val(product_count);
    });
});