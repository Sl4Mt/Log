<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteef0933bd63f087fb2fa8a903f7abacd
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'L' => 
        array (
            'LOG\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'LOG\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteef0933bd63f087fb2fa8a903f7abacd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteef0933bd63f087fb2fa8a903f7abacd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
