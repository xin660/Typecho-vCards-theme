// Author: 熊猫小A
// Link: https://www.imalan.cn

console.log(`%c DoubanBoard 0.5 %c https://blog.imalan.cn/archives/168/`, `color: #fadfa3; background: #23b7e5; padding:5px 0;`, `background: #1c2b36; padding:5px 0;`);


var curBooks_read = 0;
var curBooks_reading = 0;
var curBooks_wish = 0;
var curMovies_watched = 0;
var curMovies_watching = 0;
var curMovies_wish = 0;
DoubanBoard = {
    initDoubanBoard: function () {
        $(`.douban-book-list[data-status="read"]`).after(`<div class="douban-loadmore" id="loadMoreBooks_read" onclick="DoubanBoard.loadBooks('read');">加载更多</div>`);
        $(`.douban-book-list[data-status="reading"]`).after(`<div class="douban-loadmore" id="loadMoreBooks_reading" onclick="DoubanBoard.loadBooks('reading');">加载更多</div>`);
        $(`.douban-book-list[data-status="wish"]`).after(`<div class="douban-loadmore" id="loadMoreBooks_wish" onclick="DoubanBoard.loadBooks('wish');">加载更多</div>`);
        $(`.douban-movie-list[data-status="watched"]`).after(`<div class="douban-loadmore" id="loadMoreMovies_watched" onclick="DoubanBoard.loadMovies('watched');">加载更多</div>`);
        $(`.douban-movie-list[data-status="watching"]`).after(`<div class="douban-loadmore" id="loadMoreMovies_watching" onclick="DoubanBoard.loadMovies('watching');">加载更多</div>`);
        $(`.douban-movie-list[data-status="wish"]`).after(`<div class="douban-loadmore" id="loadMoreMovies_wish" onclick="DoubanBoard.loadMovies('wish');">加载更多</div>`);
        
        curBooks_read = 0;
        curBooks_reading = 0;
        curBooks_wish = 0;
        curMovies_watched = 0;
        curMovies_watching = 0;
        curMovies_wish = 0;
        DoubanBoard.loadBooks('read');
        DoubanBoard.loadBooks('reading');
        DoubanBoard.loadBooks('wish');
        DoubanBoard.loadMovies('watched');
        DoubanBoard.loadMovies('watching');
        DoubanBoard.loadMovies('wish');
        DoubanBoard.loadSingleBoard();
    },

    loadSingleBoard: function () {
        if ($(".douban-single").length < 1) return;
        $.each($(".douban-single"), function (i, item) {
            var api = '';
            if ($(item).attr("data-type") == "book") {
                api = window.DoubanAPI + "?type=singlebook&id=" + $(item).attr("data-id");
            } else {
                api = window.DoubanAPI + "?type=singlemovie&id=" + $(item).attr("data-id");
            }
            $.getJSON(api, function (result) {
                var myrating = parseFloat($(item).attr("data-rating"));
                var title = result.title;
                var rating = parseFloat(result.rating);
                var meta = result.meta;
                var img = result.img;
                var url = result.url;
                var summary = result.summary;
                var posi_rating = 30 * (5 - Math.floor(rating / 2));
                if ((rating - Math.floor(rating / 2) * 2) >= 1) posi_rating = posi_rating - 15;
                var posi_myrating = 30 * (5 - Math.floor(myrating / 2));
                if ((myrating - Math.floor(myrating / 2) * 2) >= 1) posi_myrating = posi_myrating - 15;
                var html = `<div class="douban-single-img" style="background-image:url(` + img + `)"></div>
                        <div class="douban-single-info">
                            <a target="_blank" class="douban-single-title" href="`+ url + `">` + title + `</a><br>
                            <span class="douban-single-meta">`+ meta + `</span><br>
                            豆瓣评分：<span class="douban-single-rating" style="background-position:0 -`+ posi_rating + `px"></span> ` + rating + `<br>
                            我的评分：<span class="douban-single-rating" style="background-position:0 -`+ posi_myrating + `px"></span> ` + myrating + `<br>
                            <span class="douban-single-summary">`+ summary + `</span>
                        </div>`;
                $(item).html(html);
            });
        })
    },

    loadBooks: function (status) {
        if ($(`.douban-book-list[data-status="` + status + `"]`).length < 1) return;
        $(`#loadMoreBooks_` + status).html("加载中...");
        var curBooks;
        if (status == 'read') curBooks = curBooks_read;
        else if (status == 'reading') curBooks = curBooks_reading;
        else curBooks = curBooks_wish;
        var api = window.DoubanAPI + "?type=book&from=" + String(curBooks) + "&status=" + status;
        $.getJSON(api, function (result) {
            $(`#loadMoreBooks_` + status).html("加载更多");
            if (result.length < DoubanPageSize) {
                $(`#loadMoreBooks_` + status).html("没有啦");
            }
            $.each(result, function (i, item) {
                var html = `<div id="doubanboard-book-item-` + String(curBooks) + `" class="doubanboard-item">
                            <div class="doubanboard-thumb" style="background-image:url(`+ item.img + `)"></div>
                            <div title="点击显示详情" class="doubanboard-title">`+ item.title + `</div>
                            <div class="doubanboard-info">
                                <p class="doubanboard-info-basic">
                                书名：`+ item.title + `<br>
                                评分：`+ item.rating + `<br>
                                作者：`+ item.author + `<br>
                                链接：<a target="_blank" href="`+ item.link + `">豆瓣阅读</a><br>
                                简介：<br>
                                </p>
                                <p class="doubanboard-info-summary">
                                    `+ item.summary + `
                                </p>
                            </div>
                        </div>`;
                $(`.douban-book-list[data-status="` + status + `"]`).append(html);
                if (status == 'read') curBooks_read++;
                else if (status == 'reading') curBooks_reading++;
                else curBooks_wish++;
            });
        });
    },

    loadMovies: function (status) {
        if ($(`.douban-movie-list[data-status="` + status + `"]`).length < 1) return;
        $("#loadMoreMovies_" + status).html("加载中...");

        var curMovies;
        if (status == 'watched') curMovies = curMovies_watched;
        else if (status == 'watching') curMovies = curMovies_watching;
        else curMovies = curMovies_wish;

        $.getJSON(window.DoubanAPI + "?type=movie&from=" + String(curMovies) + "&status=" + status, function (result) {
            $("#loadMoreMovies_" + status).html("加载更多");
            if (result.length < DoubanPageSize) {
                $("#loadMoreMovies_" + status).html("没有啦");
            }
            $.each(result, function (i, item) {
                var html = `<a href="` + item.url + `" target="_blank" id="doubanboard-movie-item-` + String(curMovies) + `" class="doubanboard-item">
                            <div class="doubanboard-thumb" style="background-image:url(`+ item.img + `)"></div>
                            <div class="doubanboard-title">`+ item.name + `</div>
                        </a>`;
                $(`.douban-movie-list[data-status="` + status + `"]`).append(html);
                if (status == 'watched') curMovies_watched++;
                else if (status == 'watching') curMovies_watching++;
                else curMovies_wish++;
            });
        });
    }
}

$(document).ready(function () {
    DoubanBoard.initDoubanBoard();
})

$(document).on('pjax:end', function () {
    DoubanBoard.initDoubanBoard();
})

$(document).click(function (e) {
    var target = e.target;
    $(".doubanboard-item").removeClass("doubanboard-info-show");
    $(".doubanboard-item").each(function () {
        if ($(target).parent()[0] == $(this)[0] || $(target) == $(this)[0]) {
            $(this).addClass("doubanboard-info-show");
        }
    })
})
