BlogCommon.ticket = BlogCommon.cookie.get('ticket');

var data = {
    url: '/api/user/check',
    params: {},
    headers: {
        ticket: BlogCommon.ticket,
        sign: ''
    }
};
BlogCommon.postRequest(data).then(function(json){
    if(json.code == 200){
        BlogCommon.user = json.entity;
    }else{
        console.log("not login");
    }
});