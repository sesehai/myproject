
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var fnArchives = {
    groupList: function(){
        var date = BlogCommon.UrlGet['date'];
        var data = {
            url: '/api/archives/index',
            params: {
            },
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.getRequest(data).then(function(json){
            if(json.code == 200){
                var html = '';
                var list = json.entity.list;
                for(index in list){
                    html += '<li>';
                    html += list[index]['group_month']+' (' + list[index]['group_num'] + ')';
                    html += '<ul>';
                    var article_list = list[index]['rows'];
                    for(a_index in article_list){
                        html += '  <li><a href="detail.html?id='+article_list[a_index]['id']+'">'+article_list[a_index]['title']+'</a> ('+article_list[a_index]['ctime']+' )</li>';
                    }
                    html += '</ul>';
                    html += '</li>';
                }
                $('#group_list').html(html);
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
        fnArchives.groupList();
    }
);