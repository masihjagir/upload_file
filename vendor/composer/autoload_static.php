<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita30edf059e6873278e3fc89bd2c4f09b
{
    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'Upload' => 
            array (
                0 => __DIR__ . '/..' . '/codeguy/upload/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInita30edf059e6873278e3fc89bd2c4f09b::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
