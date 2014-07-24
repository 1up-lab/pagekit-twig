<?php

namespace Oneup\Twig\Provider;

use Oneup\Twig\Engine\Engine;
use Pagekit\Framework\Application;
use Pagekit\Framework\ServiceProviderInterface;
use Pagekit\Framework\Templating\TemplateNameParser;
use Twig_Environment;

class TwigProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        // TODO $app['path'] . '/app/cache/templates');
        $loader = new \Twig_Loader_String();
        $twig = new Twig_Environment($loader);

        $parser = $app['tmpl.parser'];
        $parser->addEngine('twig', '.twig');

        $app['tmpl']->addEngine(new Engine($twig, $app['tmpl.parser']));
    }

    public function boot(Application $app)
    {
        // will this ever be called ?
    }
}