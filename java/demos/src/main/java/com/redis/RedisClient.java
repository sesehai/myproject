package com.redis;

import redis.clients.jedis.*;

/**
 * redis 测试类
 * Created by ziying on 2017/10/12.
 */
public class RedisClient {
    private Jedis jedis;//客户端连接
    private JedisPool jedisPool;//连接池

    public RedisClient()
    {
        initialPool();
        jedis = jedisPool.getResource();
    }

    /**
     * 初始化连接池池
     */
    private void initialPool()
    {
        // 池基本配置
        JedisPoolConfig config = new JedisPoolConfig();
        config.setMaxActive(20);
        config.setMaxIdle(5);
        config.setMaxWait(1000l);
        config.setTestOnBorrow(false);

        // redis 没有密码
        // jedisPool = new JedisPool(config,"127.0.0.1",6379);
        // redis 有密码
        jedisPool = new JedisPool(config,"127.0.0.1", 6379, 10000, "wwww");
    }

    private void lPush(String key, String val) {
        jedis.lpush(key, val);
    }

    private void rPop(String key){
        jedis.rpop(key);
    }

    private void del(String key){
        jedis.del(key);
    }

    public static void main(String[] args) {
        RedisClient redisClient = new RedisClient();
        String lpushKey = "testLpush";
        //获取开始时间
        long startTime = System.currentTimeMillis();
        for (int i = 1; i<=5000; i++){
            redisClient.lPush(lpushKey, "val_" + i);
        }
        //获取结束时间
        long endTime = System.currentTimeMillis();
        String info = "程序运行时间：" + (endTime - startTime) + "ms";
        redisClient.del(lpushKey);
        //输出程序运行时间
        System.out.println(info);
    }
}
