$(document).ready(function() {
    $('#tp_tinh').on('change', function() {
        let idTp = $(this).val();
        $('#phuong_xa').html('<option disabled selected>-Chọn Phường/Xã-</option>');
        $('#phuong_xa').prop("disabled", true);
        $('#quan_huyen').prop("disabled", false);
        $.get('/ajax/tinhtp/' + idTp, function(data) {
            $('#quan_huyen').html(data);
        });
    });
    $('#quan_huyen').on('change', function() {
        let idqh = $(this).val();
        $('#phuong_xa').prop("disabled", false);
        $.get('/ajax/quanhuyen/' + idqh, function(data) {
            $('#phuong_xa').html(data);
        });
    });
});