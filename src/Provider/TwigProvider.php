<?php

namespace Oneup\PagekitTwig\Provider;

use Oneup\PagekitTwig\Twig\Loader;
use Oneup\PagekitTwig\Twig\Engine;
use Pagekit\Framework\Application;
use Pagekit\Framework\ServiceProviderInterface;
use Pagekit\Framework\Templating\TemplateNameParser;
use Symfony\Component\Templating\DelegatingEngine;
use Twig_Environment;

class TwigProvider implements ServiceProviderInterface
{
    /**
     * Register the Twig environment.
     *
     * Not only is the twig environment created, but it is
     * also registered in the delegating engine. Furthermore
     * the extension .twig is registered, so the parser
     * knows that this is a supported format.
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $loader = new Loader($app['tmpl.parser']);
        $twig = new Twig_Environment($loader, [
            'cache' => $app['path'] . '/app/cache/templates/twig',
            'debug' => true
        ]);

        /** @var TemplateNameParser $parser */
        $parser = $app['tmpl.parser'];
        $parser->addEngine('twig', '.twig');

        /** @var DelegatingEngine $delegatingEngine */
        $delegatingEngine = $app['tmpl'];
        $delegatingEngine->addEngine(new Engine($twig, $app['tmpl.parser']));
    }

    public function boot(Application $app)
    {
    }
}