
var ticket = BlogCommon.cookie.get('ticket') || BlogCommon.UrlGet()['ticket'] || '';
var id = BlogCommon.UrlGet()['id'] || '';
var editor;
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
    bind: function(){
        // commit
        $('#button_add').on('click', function(){
            var id = $('#id').val();
            var title = $('#title').val();
            var tags = $('#tags').val();
            var description = $('#description').val();
            var content = editor.codemirror.getValue();
            if(title == ''){
                BlogCommon.showErr(
                    $('#title'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写标题"
                    },
                    1000
                );
                return;
            }else if(tags == ''){
                BlogCommon.showErr(
                    $('#tags'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写标签"
                    },
                    1000
                );
                return;
            }else if(description == ''){
                BlogCommon.showErr(
                    $('#description'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写摘要"
                    },
                    1000
                );
                return;
            }else if(content == ''){
                BlogCommon.showErr(
                    $('#label_content'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写内容"
                    },
                    1000
                );
                return;
            }
            var data = {
                url: '/api/article/save',
                params: {
                    id: id,
                    title: title,
                    tags: tags,
                    description: description,
                    content: content
                },
                headers: {
                    ticket: ticket,
                    sign: ''
                }
            };
            BlogCommon.postRequest(data).then(function(json){
                if(json.code == 200){
                    BlogCommon.showErr(
                        $('#button_add'), 
                        {
                            trigger: 'hover',
                            placement: 'top', // or bottom, left, right, and variations
                            title: json.msg
                        },
                        1000
                    );
                    setTimeout(function(){
                        location.href = 'articlelist.html';
                    }, 1000);
                }else{
                    BlogCommon.showErr(
                        $('#button_add'), 
                        {
                            trigger: 'hover',
                            placement: 'top', // or bottom, left, right, and variations
                            title: json.msg
                        },
                        1000
                    );
                }
            });
        });
    },
    detail: function(id){
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
                $('#title').val(json.entity.title);
                $('#description').val(json.entity.description);
                editor.codemirror.setValue(json.entity.content);
                $('#id').val(json.entity.id);
                $('#tags').val(json.entity.tagStr);
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
        fnArticle.bind();
        if(id !== ''){
            fnArticle.detail(id);
        }
        editor = new Editor({
            element: document.getElementById('content')
        });
        editor.render();
    }
);