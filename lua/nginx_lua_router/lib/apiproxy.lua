local apiproxy = {}

function apiproxy.getData(...)
    local request_uri  = ''
    --组装提交数据
    local args_get = ngx.req.get_uri_args()
    for key, val in pairs(args_get) do
        if type(val) == "string" and key ~= "mod" and key ~= "ctl" and key ~= "act" and key ~= "version" and key ~= "pcode" and key ~= "luamod" and key ~= "_key" then
            request_uri = request_uri.."&"..key.."="..val
        end
    end
    request_uri = string.sub(request_uri, 2)

    return request_uri
end

function apiproxy.postData(...)
    local requset_data = ''
    --组装提交数据
    local args_post = ngx.req.get_post_args()
    for key, val in pairs(args_post) do
        if type(val) == "string" and key ~= "mod" and key ~= "ctl" and key ~= "act" and key ~= "version" and key ~= "pcode" then
            requset_data = request_uri.."&"..key.."="..val
        end
    end

    return requset_data
end

return apiproxy