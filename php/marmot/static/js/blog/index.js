
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var fnIndex = {
    list: function(){
        var page = BlogCommon.UrlGet['page'];
        var pagesize = BlogCommon.UrlGet['pagesize'];
        var data = {
            url: '/api/article/index',
            params: {
                page: page,
                pagesize: pagesize
            },
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.getRequest(data).then(function(json){
            if(json.code == 200){
                var html = '';
                var rows = json.entity.rows;
                for(index in rows){
                    html += '<div class="blog-post">';
                    html += '<div class="blog-post">';
                    html += '<h2 class="blog-post-title">'+rows[index]['title']+'</h2>';
                    html += '<p class="blog-post-meta">'+rows[index]['ctime']+' by <a href="#">'+rows[index]['user_name']+'</a></p>';
                    html += '<p>'+rows[index]['description']+'</p>';
                    html += '</div>';
                }
                $('#blog_list').html(html);
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