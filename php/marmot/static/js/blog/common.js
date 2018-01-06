"use strict"
/**
 * JavaScript Document
 * 公共类Common
 */

var BlogCommon = {
    // 调试参数
    DEBUG: true,
    BASE_URL: 'http://' + (window.location.host.indexOf('test')>0 || window.location.host.indexOf('localhost') >= 0 ? 'localhost' : 'localhost') + ':9527/',
    UA: navigator.userAgent.toLowerCase(),
    APPID: '0101',
    APPVER: '1.0.0',
    OS: navigator.userAgent.toLowerCase().indexOf('android')>-1 ? 'android' : 'ios',
    MD5KEY: '121213sad',
    REQUEST_DEFAULT_PARAMS: {},
    TICKET: '',
    USER: {},
    dateFormat: function(date, format) {
        format = format || 'yyyy-MM-dd hh:mm:ss';
        var o = {
            "M+": date.getMonth() + 1,
            "d+": date.getDate(),
            "h+": date.getHours(),
            "m+": date.getMinutes(),
            "s+": date.getSeconds(),
            "q+": Math.floor((date.getMonth() + 3) / 3),
            "S": date.getMilliseconds()
        };
        if (/(y+)/.test(format)) {
            format = format.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(format)) {
                format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
            }
        }
        return format;
    },
    stringify: function(data) {
        var value = "";
        for (prop in data) {
            value += prop + "=" + data[prop] + "&";
        }
        return value.substr(0, value.length - 1);
    },
    getSig: function(param) {
        var paramStr = [],
            paramStrSorted = [];
        for (var n in param) {
            paramStr.push(n);
        }
        paramStr = paramStr.sort();
        $(paramStr).each(function(index) {
            paramStrSorted.push(this + "=" + decodeURIComponent(param[this]));
        });
        var text = paramStrSorted.join('&') + "&" + BlogCommon.MD5KEY;
        return $.md5(text);
    },
    /**
     * Http Get 请求
     * @param model
     * @returns {*}
     */
    getRequest: function (model) {
        var newReq = $.extend({}, BlogCommon.REQUEST_DEFAULT_PARAMS, model.params);
        var url = model.url.indexOf('http')>-1 ? model.url : (BlogCommon.BASE_URL + model.url);
        if(model.headers){
            model.headers["sign"] = BlogCommon.getSig(newReq);
        }
        if(model.async == undefined){
            model.async = true;
        }
        return $.ajax({
            url: url,
            type: 'GET',
            data: JSON.stringify(newReq),
            crossDomain: true,
            dataType: model.type || 'json',
            cache: true,
            headers: model.headers,
            async:model.async,
            statusCode: {500: function() {
                if(BlogCommon.DEBUG){
                    console.log('500 服务器错误');
                }
            }},
            statusCode: {404: function() {
                if(BlogCommon.DEBUG) {
                    console.log('404 服务器无法找到被请求的页面');
                }
            }},
            error: function (x, h, r) {
                BlogCommon.showErr('网络错误，请检查您的网络连接');
            },
            success: function (data) {
                if(BlogCommon.DEBUG) {
                    console.log('请求成功：' + BlogCommon.BASE_URL + JSON.stringify(newReq));
                }
            }
        });
    },
    /**
     * HTTP POST 请求
     * @param model
     * @returns {*}
     */
    postRequest: function (model) {
        model.headers["sign"] = BlogCommon.getSig(model.params);
        model.headers["Content-Type"] = "application/x-www-form-urlencoded";
        return $.ajax({
            url: BlogCommon.BASE_URL + model.url + '?' + BlogCommon.stringify(BlogCommon.REQUEST_DEFAULT_PARAMS),
            type: 'POST',
            data: model.params,
            dataType: 'json',
            headers: model.headers,
            statusCode: {500: function() {
                if(BlogCommon.DEBUG){
                    console.log('500 服务器错误');
                }
            }},
            statusCode: {404: function() {
                if(BlogCommon.DEBUG) {
                    console.log('404 服务器无法找到被请求的页面');
                }
            }},
            error: function (x, h, r) {
                BlogCommon.showErr('网络错误，请检查您的网络连接');
            },
            success: function (data) {
                if(BlogCommon.DEBUG) {
                    console.log('请求成功：' + BlogCommon.BASE_URL + model.url + '?' + BlogCommon.stringify(BlogCommon.REQUEST_DEFAULT_PARAMS) + '\n' + JSON.stringify(model.params));
                }
            }
        });
    },
    /**
     * 错误信息显示
     * @param str
     */
    showErr: function(elm, options, time){
        $(elm).popover(options).popover('show');
        setTimeout(function(){
            $(elm).popover('dispose');
        }, time);
    },
    /**
     * 获取URL参数
     */
    UrlGet: function() {
        var args = {};
        var query = location.search.substring(1);
        var pairs = query.split("&");
        for (var i = 0; i < pairs.length; i++) {
            var pos = pairs[i].indexOf('=');
            if (pos == -1) continue;
            var argname = pairs[i].substring(0, pos);
            var value = pairs[i].substring(pos + 1);
            value = decodeURIComponent(value);
            args[argname] = value;
        }
        return args;
    }
};

/**
 * cookie 类
 * @type {{set: BlogCommon.cookie.set, get: BlogCommon.cookie.get, del: BlogCommon.cookie.del}}
 */
BlogCommon.cookie = {
    set: function (l, j, g) {
        var k = l + "=" + escape(j);
        var h = new Date(), i = 0;
        if (g && g > 0) {
            i = g * 3600 * 1000;
            h.setTime(h.getTime() + i);
            k += "; expires=" + h.toGMTString();
        } else {
            k += "; expires=Session";
        }
        document.cookie = k;
    }, 
    get: function (f) {
        var e = document.cookie.split("; ");
        for (var g = 0; g < e.length; g++) {
            var h = e[g].split("=");
            if (h[0] == f) {
                return unescape(h[1]);
            }
        }
    }, 
    del: function (c) {
        var d = new Date();
        d.setTime(d.getTime() - 10000);
        document.cookie = c + "=a; expires=" + d.toGMTString();
    }
};

/**
 * 微信内嵌判断
 * @returns {boolean}
 */
BlogCommon.is_weixin = function() {
    var b = navigator.userAgent.toLowerCase();
    if (b.match(/MicroMessenger/i) == "micromessenger") {
        return true
    } else {
        return false
    }
};