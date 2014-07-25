<?php

namespace Oneup\PagekitTwig\Twig;

use Symfony\Component\Templating\TemplateNameParserInterface;

class Loader implements \Twig_LoaderInterface
{
    protected $nameParser;

    public function __construct(TemplateNameParserInterface $nameParser)
    {
        $this->nameParser = $nameParser;
    }

    public function getSource($name)
    {
        $template = $this->nameParser->parse($name);

        if (!file_exists($path = $template->getPath())) {
            throw new \InvalidArgumentException(sprintf('The template "%s" does not exist.', $name));
        }

        return file_get_contents($template->getPath());
    }

    public function getCacheKey($name)
    {
        return $name;
    }

    public function isFresh($name, $time)
    {
        $template = $this->nameParser->parse($name);
        return filemtime($template->getPath()) < $time;
    }
}