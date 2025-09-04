jQuery(document).ready(function ($) {
    if (communitySummaryAjax.use_ajax == '1') {
        $('#generate-summary-button').on('click', function (e) {
            e.preventDefault();

        $.post(communitySummaryAjax.ajax_url, {
            action: 'generate_community_summary',
            security: communitySummaryAjax.nonce,
            post_id: $('#post_ID').val()
        }, function (response) {
            if (response.success) {
                $('#community_summary').text(response.data.summary);
                $('#community_summary').val(response.data.summary);
                
                alert('Summary Content updated');

            }
        });
        });
    }
});