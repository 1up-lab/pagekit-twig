<?php

namespace Oneup\PagekitTwig\Provider;

use Oneup\PagekitTwig\Twig\Loader;
use Oneup\PagekitTwig\Twig\Engine;
use Pagekit\Framework\Application;
use Pagekit\Framework\ServiceProviderInterface;
use Pagekit\Framework\Templating\Helper\TokenHelper;
use Pagekit\Framework\Templating\TemplateNameParser;
use Symfony\Component\Templating\DelegatingEngine;
use Twig_Environment;
use Twig_SimpleFunction;

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

        /**
         * Twig url() function.
         * {{ url('extension://system/theme/favicon.ico') }}
         */
        $twig->addFunction(new Twig_SimpleFunction('url', [$app['url'], 'to']));

        /**
         * Twig style() function.
         * {{ style('theme', 'theme://my-theme/css/theme.css') }}
         */
        if ( isset($app['view.styles']) ) {
            $twig->addFunction(new Twig_SimpleFunction('style', function ( $name, $asset = null, $dependencies = [], $options = [] ) use ( $app ) {
                $app['view.styles']->queue($name, $asset, $dependencies, $options);
            }));
        }

        /**
         * Twig script() function.
         * {{ script('jquery') }}
         */
        if (isset($app['view.scripts'])) {
            $twig->addFunction(new Twig_SimpleFunction('script', function ( $name, $asset = null, $dependencies = [], $options = [] ) use ( $app ) {
                $app['view.scripts']->queue($name, $asset, $dependencies, $options);
            }));
        }

        /**
         * Twig hasSection() function.
         * {% if ( hasSection('logo') ) %}
         *     ...
         * {% endif %}
         */
        if ( isset($app['view.sections']) ) {
            $twig->addFunction(new Twig_SimpleFunction('hasSection', [$app['view.sections'], 'has']));
        }

        /**
         * Twig token() function.
         * {{ token() }}
         */
        if (isset($app['csrf'])) {
            $twig->addFunction(new Twig_SimpleFunction('token', [new TokenHelper($app['csrf']), 'generate']));
        }

        /**
         * Twig markdown function.
         * {{ markdown('**Markdown Text**') }}
         */
        if (isset($app['markdown'])) {
            $twig->addFunction(new Twig_SimpleFunction('markdown', [$app['markdown'], 'parse']));
        }

        /**
         * Twig translator function.
         * {{ trans('Translation Key') }}
         */
        if (isset($app['translator'])) {
            $twig->addFunction(new Twig_SimpleFunction('trans', [$app['translator'], 'trans']));
        }

        /**
         * Twig section() function.
         * {{ section('head') }}
         */
        $twig->addFunction(new Twig_SimpleFunction('section', [$app['view.sections'], 'output']));
    }

    public function boot(Application $app)
    {
    }
}