$(document).ready(function() {
    $('.quantity_in_cart').change(function() {
        $(this).find(":selected").each(function() {
            let product_user_id = $(this).data('product-user-id');
            let new_quantity = $(this).val();

            $('#product_user_id').val(product_user_id);
            $('#new_quantity').val(new_quantity);

            $('#update_quantity_form').submit();
        });
    });
});