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

    /**
     * Get the source for a given template handle.
     *
     * @param string $name
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getSource($name)
    {
        $template = $this->nameParser->parse($name);

        if (!file_exists($path = $template->getPath())) {
            throw new \InvalidArgumentException(sprintf('The template "%s" does not exist.', $name));
        }

        return file_get_contents($template->getPath());
    }

    /**
     * Get the cache key for a given template handle.
     *
     * Will just return the template name, as it is
     * unique anyways.
     *
     * @param string $name
     * @return string
     */
    public function getCacheKey($name)
    {
        return $name;
    }

    /**
     * Check if this template is still fresh.
     *
     * @param string $name
     * @param int $time
     * @return bool
     */
    public function isFresh($name, $time)
    {
        $template = $this->nameParser->parse($name);
        return filemtime($template->getPath()) < $time;
    }
}