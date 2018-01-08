
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var fnIndex = {
    list: function(){
        var page = BlogCommon.UrlGet()['page'];
        var pagesize = BlogCommon.UrlGet()['pagesize'] || 20;
        var tag = BlogCommon.UrlGet()['tag'];
        var date = BlogCommon.UrlGet()['date'];
        var data = {
            url: '/api/index/index',
            params: {
                page: page,
                pagesize: pagesize,
                tag: tag,
                date: date
            },
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.getRequest(data).then(function(json){
            if(json.code == 200){
                var html = '';
                var list = json.entity.list.rows;
                for(index in list){
                    html += '<div class="blog-post">';
                    html += '<div class="blog-post">';
                    html += '<h2 class="blog-post-title">'+list[index]['title']+'</h2>';
                    html += '<p class="blog-post-meta">'+list[index]['ctime']+' by <a href="#">'+list[index]['user_name']+'</a></p>';
                    html += '<p>'+marked(list[index]['description'])+'</p>';
                    html += '<p><a href="detail.html?id='+list[index]['id']+'">阅读</a></p>';
                    html += '</div>';
                }
                var group = json.entity.group;
                var group_html = '';
                for(index in group){
                    group_html += '<li><a href="index.html?date='+group[index]['m']+'">'+group[index]['m']+' ('+group[index]['num']+')</a></li>';
                }
                $('#blog_list').html(html);
                $('#group').html(group_html);

                if(parseInt(json.entity.list.currentPage)>1){
                    $('#prev').attr("href", "index.html?page=" + (parseInt(json.entity.list.currentPage)-1));
                    $('#next').removeClass('disabled');
                }else{
                    $('#prev').attr("href", "javascript:void(0)");
                    $('#prev').addClass('disabled');
                }
                if(parseInt(json.entity.list.currentPage)<parseInt(json.entity.list.totalPages)){
                    $('#next').attr("href", "index.html?page=" + (parseInt(json.entity.list.currentPage)+1));
                    $('#next').removeClass('disabled');
                }else{
                    $('#next').attr("href", "javascript:void(0)");
                    $('#next').addClass('disabled');
                }
            }else{
                BlogCommon.showErr(
                    $('body'), 
                    {
                        trigger: 'hover',
                        placement: 'top', // or bottom, left, right, and variations
                        title: json.msg
                    },
                    1000
                );
            }
        });
    }
};

$(
    function(){
        fnIndex.list();
    }
);