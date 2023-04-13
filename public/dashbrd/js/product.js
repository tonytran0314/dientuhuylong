$(document).ready(function() {
    $('.hide_product_button').click(function() {
        let product_id = $(this).val();
        $('#product_id').val(product_id);
    });

    $('.restore_product_button').click(function() {
        let product_id = $(this).val();
        $('#restore_product_id').val(product_id);
        $('#restore_form').submit();
    });

    $('.delete_product_button').click(function() {
        let product_id = $(this).val();
        $('#delete_product_id').val(product_id);
    });
});