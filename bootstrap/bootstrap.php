<?php

return [
    'Hsyngkby\Support\Bootstrap\DetectEnvironment',     //Environment i tespit et
    'Hsyngkby\Support\Bootstrap\SetFolderStructure',    //klasor yapısını .env dosyasından oku ve $app ye set et her biri için function var
    'Hsyngkby\Support\Bootstrap\LoadConfiguration',     //Config Class'ını set et ver config klasorundeki configleri yükle.
    'Hsyngkby\Support\Bootstrap\ConfigureLogging',      //Log sistemini oluştur.
//    'Hsyngkby\Support\Bootstrap\HandleExceptions',
    'Hsyngkby\Support\Bootstrap\RegisterFacades',       //Facades leri yükle
    'Hsyngkby\Support\Bootstrap\RegisterCoreProviders', //Core Un Providerları
    'Hsyngkby\Support\Bootstrap\RegisterProviders',     //Provider ları register et ve config veya herlper dosyaları varsa yükle
    'Hsyngkby\Support\Bootstrap\BootProviders',         //Provider ların boot functionlarını çalıştır
    'Hsyngkby\Support\Bootstrap\CacheConfigfile'        //Config dosyalarını ayrı ayrı okumak yerine cache yapacak
];