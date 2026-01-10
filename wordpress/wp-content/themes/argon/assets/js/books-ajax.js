jQuery(function ($) {

    let page = 2;
    let loading = false;
    let finished = false;

    let scrollTimer;
    $(window).on('scroll', function () {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(function () {
            if (loading || finished) return;

            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let docHeight = $(document).height();

            const $loading = $('#books-loading');
            if (scrollTop + windowHeight + 100 >= docHeight) {

                loading = true;
                $loading.removeClass('d-none');

                $.post(books_ajax.ajax_url, {
                    action: 'load_more_books',
                    page: page
                }, function (res) {
                    $loading.addClass('d-none');

                    if ($.trim(res) === '') {
                        finished = true;
                        $loading.html('<p class="text-muted mb-0">书库已掏空，下次早点来蹲新书～</p>').removeClass('d-none');
                        return;
                    }

                    $('#books-list').append(res);
                    page++;
                    loading = false;
                }).fail(function () {
                    $loading.addClass('d-none');

                    loading = false;
                    finished = true;
                });
            }
        }, 100); // 100ms 防抖
    });
});