jQuery(document).ready(function($) {
    const postId = $('#post_ID').val();
    const nonce = $('#ai-headlines').data('nonce');

    // Hneď načítať existujúce návrhy
    /*$.ajax({
        url: AiHeadlines.ajax_url,
        method: 'POST',
        data: {
            action: 'ai_headlines',
            post_id: postId,
            nonce: nonce
        },
        success: function(response) {
            if(response.success && response.data.titles.length) {
                let html = '<ul style="cursor:pointer;">';
                response.data.titles.forEach(title => {
                    html += '<li class="ai-title-item">' + title + '</li>';
                });
                html += '</ul>';
                $('#ai-headlines-output').html(html);
            }
        }
    });*/

    // Kliknutie na title nastaví post title a uloží cez AJAX
    $(document).on('click', '.ai-title-item', function() {
        const selectedTitle = $(this).text();

        $.ajax({
            url: AiHeadlines.ajax_url,
            method: 'POST',
            data: {
                action: 'ai_set_title',
                post_id: postId,
                title: selectedTitle,
                nonce: nonce
            },
            success: function(resp) {
                if(resp.success) location.reload();
            }
        });
    });

    // Generovanie nových AI headlines po kliknutí na tlačidlo
    $('#ai-headlines').on('click', function() {
        $.ajax({
            url: AiHeadlines.ajax_url,
            method: 'POST',
            data: {
                action: 'ai_headlines',
                post_id: postId,
                nonce: nonce
            },
            beforeSend: function() {
                $('#ai-headlines-output').html('Generujem nadpisy...');
            },
            success: function(response) {
                if(response.success) {
                    let html = '<ul style="cursor:pointer;">';
                    response.data.titles.forEach(title => {
                        html += '<li class="ai-title-item">' + title + '</li>';
                    });
                    html += '</ul>';
                    $('#ai-headlines-output').html(html);
                }
            }
        });
    });
});
