local apitool = {}

-- 取回数据
function apitool.loadData(request_url, request_data, method, timeout)
    local http = require "resty.http"
    local hc = http:new()
    local ok, code, headers, status, body = hc:request {
        url = request_url,
        --- proxy = "http://127.0.0.1:8888",
        timeout = timeout or 2000,
        method = method, -- POST or GET
        -- add post content-type and cookie
        headers = {["Content-Type"] = "application/x-www-form-urlencoded" },
        body = request_data,
    }

    return ok, code, headers, status, body
end

-- 封装数据
function apitool.filterData(ok, code, body, _key, urls)
    local result = ""
    local result_header = ""
    local result_body = ""
    if ok and code == 200 then
        if body ~= nil and body ~= "" then
            result_header = '{"status":"1"}'
            result_body = '{"result":'..body..'}'
        else
            result_header = '{"status":"2"}'
            result_body = '{"result":{}}'
        end
    else 
        result_header = '{"status":"2"}'
        result_body = '{"result":{}}'
    end

    if _key ~= "" and _key ~= nil then
        result = '{"header":'..result_header..',"body":'..result_body..',"apiinfo":['..urls..']}'
    else
        result = '{"header":'..result_header..',"body":'..result_body..'}'
    end

    return result
end

return apitool