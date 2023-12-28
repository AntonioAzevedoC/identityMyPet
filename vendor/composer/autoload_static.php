<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1bc1a6bf8712042d84c7ff1a0decbabe
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chillerlan\\QRCode\\' => 18,
        ),
        'U' => 
        array (
            'Usuario\\SistemaTcc\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chillerlan\\QRCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-qrcode/src',
        ),
        'Usuario\\SistemaTcc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1bc1a6bf8712042d84c7ff1a0decbabe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1bc1a6bf8712042d84c7ff1a0decbabe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1bc1a6bf8712042d84c7ff1a0decbabe::$classMap;

        }, null, ClassLoader::class);
    }
}
