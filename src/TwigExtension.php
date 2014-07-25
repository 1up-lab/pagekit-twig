<?php

namespace Oneup\PagekitTwig;

use Oneup\PagekitTwig\Provider\TwigProvider;
use Pagekit\Extension\Extension;
use Pagekit\Framework\Application;
use Pagekit\Hello\Event\HelloListener;
use Pagekit\System\Event\LinkEvent;
use Pagekit\Widget\Event\RegisterWidgetEvent;

class TwigExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        parent::boot($app);

        $app->register(new TwigProvider());
    }

    public function enable()
    {
        // do nothing
    }

    public function disable()
    {
        // do nothing
    }

    public function uninstall()
    {
        // do nothing
    }
}
