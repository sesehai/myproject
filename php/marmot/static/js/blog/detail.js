
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var id = BlogCommon.UrlGet()['id'] || '';
var fnDetail = {
    detail: function(){
        var data = {
            url: '/api/article/detail?id=' + id,
            params: {
            },
            headers: {
                ticket: ticket,
                sign: ''
            }
        };
        BlogCommon.getRequest(data).then(function(json){
            if(json.code == 200){
                var html = json.entity.content;
                $('#title').html(json.entity.title);
                $('#create_time').html(json.entity.ctime);
                $('#user_name').html(json.entity.user_name);
                //$('#content').html(html);
                var tagNameAry = [];
                for(var tag in json.entity.tags){
                    tagNameAry.push("<a href='index.html?tag="+json.entity.tags[tag]['id']+"'>#"+json.entity.tags[tag]['name']+"</a> ");
                }
                $('#tags').html(tagNameAry.join());
                document.getElementById('content').innerHTML = marked(html);
                if(json.entity.prev){
                    $('#prev').attr("href", "detail.html?id=" + json.entity.prev.id);
                    $('#next').removeClass('disabled');
                }else{
                    $('#prev').attr("href", "javascript:void(0)");
                    $('#prev').addClass('disabled');
                }

                if(json.entity.next){
                    $('#next').attr("href", "detail.html?id=" + json.entity.next.id);
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
        fnDetail.detail(id);
        hljs.initHighlightingOnLoad();
    }
);