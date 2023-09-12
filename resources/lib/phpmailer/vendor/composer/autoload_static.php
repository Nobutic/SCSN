<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf86e1b697c8ed62cad9b72ccabbb4f12
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf86e1b697c8ed62cad9b72ccabbb4f12::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf86e1b697c8ed62cad9b72ccabbb4f12::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf86e1b697c8ed62cad9b72ccabbb4f12::$classMap;

        }, null, ClassLoader::class);
    }
}
