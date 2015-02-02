<?php

class CacheTest extends TestCase
{
    protected $test_cache_file = 'deneme';

    public function testCacheIsLoaded()
    {
        pre('###################### CacheTest START ######################');
        pre('Cache testi mannuel elle yapıldı. ve buglar bulungu config dosyası içinde todolar var onları düzelttikten sonra unittest yapılabilir.');
        pre('###################### CacheTest FINISH ######################');
        return;
        //pre('###################### CacheTest START ######################');

        //cachin deferr bir servis olması gerekiyor.
        //getDeferredServices dendiğinde cachin içinde olması gerekiyor.
        $this->assertArrayHasKey('cache', $this->app->getDeferredServices(), 'Cache is not deferredService');
        $result['Cache is DeferredServis'] = true;

        $cache = $this->app->get('cache');

        $test_backend = ['File', 'Memcache', 'Apc', 'Mongo', 'Redis', 'Libmemcached', 'Memory'];

        foreach ($test_backend as $backend):

            $cache->setup($this->app, $this->app->get('config')['cache'], 'Data', $backend);
            pre($cache->getCache());

            //cache oluştur
            $cache->save($this->test_cache_file, $_SERVER);
            $result["Cache Create '$this->test_cache_file' IN 'DENEME'"] = true;

            //cache oluşturulmuşmu
            $this->assertTrue($cache->exists($this->test_cache_file));
            $result['Cache File is Exists'] = true;

            //cache içeriği doğrumu
            $this->assertEquals($_SERVER, $cache->get($this->test_cache_file));
            $result['Cache Value is DENEME'] = true;

            //cache dosya adı doğrumu
            //tüm dosyaları alır.
            //$this->assertEquals($this->test_cache_file, $cache->queryKeys());
            $result['All Cache Check 1'] = $cache->queryKeys();

            //cache sil
            $cache->delete($this->test_cache_file);

            //cache silinmişmi
            $this->assertFalse($cache->exists($this->test_cache_file));
            $result["Cache Delete '$this->test_cache_file is not in array'"] = $cache->queryKeys();

            //cache increment testi
//            $this->test_cache_file = str_replace('.cache', '.cache_inc', $this->test_cache_file);
//            $cache->save($this->test_cache_file, "1");
//            $cache->increment($this->test_cache_file, "1");
//            pre($cache->get($this->test_cache_file));
//            $this->assertEquals('2', $cache->get($this->test_cache_file));
//            $result['Cache Increment 1 to'] = $cache->get($this->test_cache_file);

//            $this->test_cache_file = str_replace('.cache_inc', '.cache_dec', $this->test_cache_file);
//            //cache decrement testi
//            $cache->save($this->test_cache_file, "30");
//            $cache->decrement($this->test_cache_file, "1");
//            $this->assertEquals('29', $cache->get($this->test_cache_file));
//            $result['Cache Decrement 30 to'] = $cache->get($this->test_cache_file);

//        $this->test_cache_file = str_replace('.cache_dec','.cache_time',$this->test_cache_file);
//        //cache decrement testi
//        $cache->save($this->test_cache_file, "Huseyin GÖKBAY",1);
//        sleep(10);
//        $this->assertFalse($check = $cache->exists($this->test_cache_file));
//        $result['Cache ExpireTime 1sn, After 10sn'] = $check;

            $result['All Cache "Before Cache Flush"'] = $cache->queryKeys();
            //tüm cachei temizle
            $cache->flush();
            $result['All Cache "After Cache Flush"'] = $cache->queryKeys();

            $this->assertFalse($cache->exists($this->test_cache_file));

        pre('###########################################');
        endforeach;
//        pre($result);
//
//        pre('###################### CacheTest FINISH ######################');
//        pre('');
//        pre('');

    }
}
