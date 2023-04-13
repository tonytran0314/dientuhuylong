$(document).ready(function() {
    $('.update_comment_button').click(function() {
        let content = $(this).data("content");
        let comment_id = $(this).data("comment-id");

        $('#update_content').val(content);
        $('#comment_id').val(comment_id);
    });

    $('.delete_comment_button').click(function() {
        let comment_id = $(this).data("comment-id");

        $('#delete_comment_id').val(comment_id);
    });
});