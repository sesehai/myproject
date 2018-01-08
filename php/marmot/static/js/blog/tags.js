
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var fnTags = {
    list: function(){
        var data = {
            url: '/api/tag/index',
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
                html += '<ul>';
                var list = json.entity.list;
                for(index in list){
                    html += '  <li><a href="index.html?tag='+list[index]['id']+'">'+list[index]['name']+'</a></li>';
                }
                html += '</ul>';
                $('#tags_list').html(html);
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
        fnTags.list();
    }
);