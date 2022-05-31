<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit29a018de8d1a57c6899b0199371b272d
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Countpay\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Countpay\\' => 
        array (
            0 => __DIR__ . '/..' . '/countpay/php-classes/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit29a018de8d1a57c6899b0199371b272d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit29a018de8d1a57c6899b0199371b272d::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit29a018de8d1a57c6899b0199371b272d::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit29a018de8d1a57c6899b0199371b272d::$classMap;

        }, null, ClassLoader::class);
    }
}