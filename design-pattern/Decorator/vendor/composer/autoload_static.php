<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0cefef35c423add006a3885e97fce50b
{
    public static $classMap = array (
        'BasicInspection' => __DIR__ . '/../..' . '/index.php',
        'CarService' => __DIR__ . '/../..' . '/index.php',
        'ComposerAutoloaderInit0cefef35c423add006a3885e97fce50b' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit0cefef35c423add006a3885e97fce50b' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'OilChange' => __DIR__ . '/../..' . '/index.php',
        'TireRotation' => __DIR__ . '/../..' . '/index.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0cefef35c423add006a3885e97fce50b::$classMap;

        }, null, ClassLoader::class);
    }
}