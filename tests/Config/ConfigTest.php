<?php

class ConfigTest extends TestCase
{

    public function testConfigIsLoaded()
    {
        pre('###################### ConfigTest START ######################');

        $this->assertTrue($var = $this->app->has('config'));

        $result['Config is Loaded'] = $var;

        $config = $this->app->get('config');

        $config->set('key', 'value');
        $this->assertArrayHasKey('key', $config);

        $result['Config Single Setter Getter'] = true;

        $config->set('key.value', 'value');
        $this->assertEquals($config['key.value'], 'value');

        $result['Config Dot Setter Getter'] = TRUE;

        $config->loadConfigurationFiles($this->app,__DIR__.'/config_files');

        $result['Config Load Dir'] = true;

        //config1 dosyası yüklendimi
        $this->assertArrayHasKey('config1',$config);

        //config2 dosyası yüklendimi
        $this->assertArrayHasKey('config2',$config);

        $result["Config Check Files Is Loaded"] = array_keys($config->toArray());
        $result["Config Check 'config1'"] = $config['config1'];
        $result["Config Check 'config2'"] = $config['config2'];

        //değerler doğrumu
        $this->assertEquals($config['config1.file'], 'config1');
        $this->assertEquals($config['config2.file'], 'config2');

        $result["Config Check Value 'config2.file'"] = $config['config2.file'];

        pre($result);

        pre('###################### ConfigTest FINISH ######################');
        pre('');
        pre('');
    }

}
