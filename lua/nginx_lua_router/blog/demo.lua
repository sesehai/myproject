local demo = {}

function demo.foo(...)
  -- print("demo.foo called")
  ngx.say("demo.foo called")
end

-- blog列表
function demo.list()
    local apiproxy = require "lib.apiproxy"
    local apitool = require "lib.apitool"
    -- blog列表
    local listUrl = "http://www.xxx.com/blog/list?"
    local request_uri = apiproxy.getData()

    local request_url = listUrl..request_uri
    local ok, code, _, _, body = apitool.loadData(request_url, "", "GET")
    local _key = ngx.var.arg__key
    local urls = [[{"name":"blog列表","url":"]]..request_url..[["},{"name":"blog列表1","url":""}]]
    local result = apitool.filterData(ok, code, body, _key, urls)

    ngx.say(result)
end

return demo