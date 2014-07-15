-- nginx + lua 实现入口文件，实现路由功能
-- http://www.xxx.com/?luamod=main&mod=blog&ctl=demo&act=foo
-- nginx config:
-- if ($request_uri ~ luamod=main){
--    content_by_lua_file "/www/lua/main.lua";
-- }

ngx.header.content_type = "text/html;charset=utf-8"

--组装提交数据
-- GET数据
local args_get = ngx.req.get_uri_args()
for key, val in pairs(args_get) do
    if type(val) == "string" then
        if key == "mod" then
            request_mod = val
        elseif key == "ctl" then
            request_ctl = val
        elseif key == "act" then
            request_act = val
        end
    end
end

local modulename = request_mod.."."..request_ctl
-- 支持的模块列表
local switch = {
    ["mob.demo"] = function()
        return require "mob.demo"
    end,
    ["mob.page"] = function()
        return require "mob.page"
    end
}

local moduleObj = {}
local getmodule = switch[modulename]
if (getmodule) then
    moduleObj = getmodule()
else
    moduleObj = nil
end

if moduleObj ~= nil and moduleObj[request_act] ~= nil then
    moduleObj[request_act]()
else
    ngx.say("Bad Request!")
    ngx.exit(200)
end