<?php namespace Hsyngkby\Testing;

trait HelperTrait
{

    protected function pre($key,$item=null)
    {
        if (is_null($item)){
            fwrite(STDOUT, print_r($key, 1));
        }
        if (is_array($item)){
            fwrite(STDOUT,array_get($item,$key,"ERROR : $key is not defined"));
        }
    }

}