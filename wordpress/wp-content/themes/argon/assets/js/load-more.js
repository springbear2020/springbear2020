jQuery(function ($) {
    // 通用加载更多函数
    function initLoadMore(options) {
        const {
            type,               // 类型标识：books/projects
            listSelector,       // 列表容器选择器
            loadingSelector,    // 加载状态容器选择器
            ajaxAction,         // AJAX action 名称
            emptyText           // 无更多内容提示文本
        } = options;

        let page = 2;
        let loading = false;
        let finished = false;
        let scrollTimer;

        // 滚动监听逻辑
        $(window).on('scroll', function () {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(function () {
                if (loading || finished) return;

                const scrollTop = $(window).scrollTop();
                const windowHeight = $(window).height();
                const docHeight = $(document).height();
                const $loading = $(loadingSelector);

                // 滚动到底部附近触发加载
                if (scrollTop + windowHeight + 100 >= docHeight) {
                    loading = true;
                    $loading.removeClass('d-none');

                    // AJAX 请求
                    $.post(books_ajax.ajax_url, {
                        action: ajaxAction,
                        page: page,
                        type: type // 传给后端区分类型
                    }, function (res) {
                        $loading.addClass('d-none');

                        // 无更多内容
                        if ($.trim(res) === '') {
                            finished = true;
                            $loading.html(`<p class="text-muted mb-0">${emptyText}</p>`).removeClass('d-none');
                            return;
                        }

                        // 追加内容
                        $(listSelector).append(res);
                        page++;
                        loading = false;
                    }).fail(function () {
                        $loading.addClass('d-none');
                        loading = false;
                        finished = true;
                    });
                }
            }, 100); // 防抖
        });
    }

    // 初始化书籍加载
    initLoadMore({
        type: 'books',
        listSelector: '#books-list',
        loadingSelector: '#books-loading',
        ajaxAction: 'load_more_items',
        emptyText: '书库已掏空，下次早点来蹲新书～'
    });

    // 初始化项目加载
    initLoadMore({
        type: 'projects',
        listSelector: '#projects-list',
        loadingSelector: '#projects-loading',
        ajaxAction: 'load_more_items',
        emptyText: '项目库已到底，暂无更多项目～'
    });
});