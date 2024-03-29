<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c97955ccf378f9122ff6ef84e19599a
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Ijiolao\\RateLimiter\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ijiolao\\RateLimiter\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c97955ccf378f9122ff6ef84e19599a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c97955ccf378f9122ff6ef84e19599a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4c97955ccf378f9122ff6ef84e19599a::$classMap;

        }, null, ClassLoader::class);
    }
}
