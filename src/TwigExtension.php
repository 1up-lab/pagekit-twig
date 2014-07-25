<?php

namespace Oneup\PagekitTwig;

use Oneup\PagekitTwig\Provider\TwigProvider;
use Pagekit\Extension\Extension;
use Pagekit\Framework\Application;

class TwigExtension extends Extension
{
    /**
     * Registers the TwigProvider, so it will be
     * properly loaded.
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {
        parent::boot($app);

        $app->register(new TwigProvider());
    }

    public function enable()
    {
    }

    public function disable()
    {
    }

    public function uninstall()
    {
    }
}
