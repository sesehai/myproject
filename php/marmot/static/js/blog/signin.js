
var ticket = '';
var fnSignIn = {
    signInPost: function(){
        // commit
        $('#button_sign').on('click', function(){
            var name = $('#name').val(),
                password = $('#password').val();
            if(name == ''){
                BlogCommon.showErr(
                    $('#name'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写用户名"
                    },
                    1000
                );
                return;
            }else if(password == ''){
                BlogCommon.showErr(
                    $('#password'), 
                    {
                        trigger: 'focus',
                        placement: 'top', // or bottom, left, right, and variations
                        title: "请填写密码"
                    },
                    1000
                );
                return;
            }
            var data = {
                url: '/api/user/signin',
                params: {
                    name: name,
                    password: $.md5(password)
                },
                headers: {
                    ticket: ticket,
                    sign: ''
                }
            };
            BlogCommon.postRequest(data).then(function(json){
                if(json.code == 200){
                    BlogCommon.showErr(
                        $('#button_sign'), 
                        {
                            trigger: 'hover',
                            placement: 'top', // or bottom, left, right, and variations
                            title: json.msg
                        },
                        1000
                    );
                    setTimeout(function(){
                        location.href = 'index.html';
                    }, 1000);
                }else{
                    BlogCommon.showErr(
                        $('#button_sign'), 
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
    }
};

$(
    function(){
        fnSignIn.signInPost();
    }
);