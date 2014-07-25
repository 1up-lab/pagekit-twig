<?php

namespace Oneup\PagekitTwig\Provider;

use Oneup\PagekitTwig\Twig\Loader;
use Oneup\PagekitTwig\Twig\Engine;
use Pagekit\Framework\Application;
use Pagekit\Framework\ServiceProviderInterface;
use Pagekit\Framework\Templating\TemplateNameParser;
use Twig_Environment;

class TwigProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $loader = new Loader($app['tmpl.parser']);
        $twig = new Twig_Environment($loader, [
            'cache' => $app['path'] . '/app/cache/templates',
            'debug' => true
        ]);

        /** @var TemplateNameParser $parser */
        $parser = $app['tmpl.parser'];
        $parser->addEngine('twig', '.twig');

        $app['tmpl']->addEngine(new Engine($twig, $app['tmpl.parser']));
    }

    public function boot(Application $app)
    {
        // will this ever be called ?
    }
}