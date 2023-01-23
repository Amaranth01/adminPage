<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\CoreExtension;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private static ?Environment $twigInstance = null;
    private static ?FilesystemLoader $twigLoader = null;

    public function render(...$params): void
    {
        try {
            echo self::getTwig()->render(...$params);
        }
        catch (LoaderError $e) {
            echo self::getTwig()->render('error/404.html.twig');
        }

        catch(RuntimeError | SyntaxError $e) {
            echo self::getTwig()->render('error/500.html.twig');
        }
    }

    /**
     * return Twig instance
     * @return Environment|null
     */
    public function getTwig(): Environment
    {
        if (null === self::$twigInstance) {
            if (null === self::$twigLoader) {
                self::$twigLoader = new FilesystemLoader('../templates');
            }
            //Instanciationdu moteur de template en lui passant le liader en paramètre (version sans cache).
            self::$twigInstance = new Environment(self::$twigLoader, [
                'debug' => true,
                'strict_variables' => true,
                'cache' => '../var/cache',
            ]);
            //Chargement de l'extension de debug
            self::$twigInstance->addExtension(new DebugExtension());
            self::$twigInstance->getExtension(CoreExtension::class)->setNumberFormat(2, ',', ' ');
        }
        return self::$twigInstance;
    }

    public function getTwigLoader(): FilesystemLoader
    {
        return self::$twigLoader;
    }
}