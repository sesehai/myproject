
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var fnArticle = {
    checkTicket: function(){
        var data = {
            url: '/api/user/check',
            params: {},
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.postRequest(data).then(function(json){
            if(json.code == 200){
                
            }else{
                location.href = 'signin.html';
            }
        });
    },
    list: function(){
        var page = BlogCommon.UrlGet()['page'];
        var pagesize = BlogCommon.UrlGet()['pagesize'] || 20;
        var data = {
            url: '/api/article/list',
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
                    html += '<tr>';
                    html += '<th scope="row">'+rows[index]['id']+'</th>';
                    html += '<td>'+rows[index]['title']+'</td>';
                    html += '<td>'+rows[index]['ctime']+'</td>';
                    html += '<td><a href="addarticle.html?id='+rows[index]['id']+'">编辑</a> | <a href="javascript:fnArticle.del('+rows[index]['id']+');">删除</a></td>';
                    html += '</tr>';
                }
                $('#rows_tbody').html(html);

                if(parseInt(json.entity.currentPage)>1){
                    $('#prev').attr("href", "articlelist.html?page=" + (parseInt(json.entity.currentPage)-1));
                    $('#next').removeClass('disabled');
                }else{
                    $('#prev').attr("href", "javascript:void(0)");
                    $('#prev').addClass('disabled');
                }
                if(parseInt(json.entity.currentPage)<parseInt(json.entity.totalPages)){
                    $('#next').attr("href", "articlelist.html?page=" + (parseInt(json.entity.currentPage)+1));
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
    },
    del: function(id){
        var data = {
            url: '/api/article/del?id=' + id,
            params: {
            },
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.getRequest(data).then(function(json){
            if(json.code == 200){
                BlogCommon.showErr(
                    $('body'), 
                    {
                        trigger: 'hover',
                        placement: 'top', // or bottom, left, right, and variations
                        title: json.msg
                    },
                    1000
                );
                location.reload();
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
        fnArticle.checkTicket();
        fnArticle.list();
    }
);