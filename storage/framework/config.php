{"app":{"timezone":"UTC","security":{"key":"KhXLj7rAiVEphYtTzn4SUNF1RdARjz5e","mode":"cbc","chipher":"rijndael-256","padding":""},"providers":["Hsyngkby\\Cache\\CacheServiceProvider","Hsyngkby\\Events\\EventsServiceProvider","Hsyngkby\\Database\\DatabaseServiceProvider","Hsyngkby\\Cookie\\CookieServiceProvider"],"aliases":{"Config":"Hsyngkby\\Support\\Facades\\Config","Log":"Hsyngkby\\Support\\Facades\\Log","Cache":"Hsyngkby\\Support\\Facades\\Cache","Events":"Hsyngkby\\Support\\Facades\\Events"}},"logger":{"adapters":{"file_adapter":{"enable":true,"file":"logs\/app.log"},"stream_adapter":{"enable":false,"stream":"php:\/\/stdout"},"firephp":{"enable":false}}},"cache":{"frontend":"Json","backend":"File","frontend_modules":{"Msgpack":{"lifetime":86400},"Data":{"lifetime":86400},"Igbinary":{"lifetime":86400},"Base64":{"lifetime":86400},"Json":{"lifetime":86400},"Output":{"lifetime":86400},"None":{"lifetime":86400}},"backend_modules":{"File":{"prefix":null,"cacheDir":"\/home\/vagrant\/developer\/php\/phalcon\/storage\/framework\/cache\/"},"Memcache":{"prefix":null,"host":"127.0.0.1","port":11211,"persistent":false,"statsKey":"_PHCM"},"Apc":{"prefix":null},"Mongo":{"prefix":null,"server":"mongodb:\/\/localhost","db":"caches","collection":"images"},"Xcache":{"prefix":null},"Database":{"db":"current_db_connection","table":"cache_data"},"Redis":{"host":"127.0.0.1","port":6379},"Libmemcached":{"tracking":true,"servers":[{"host":"127.0.0.1","post":"11211","weight":1}],"statsKey":"_PHCM"},"Memory":[],"Wincache":[]}},"db":{"adapter":"mysql","mysql":{"host":"localhost","dbname":"homestead","username":"homestead","password":"secret","charset":"utf8"}},"cookie":{"useEncryption":false},"last_cached_time":"02.02.2015 20:34:20"}