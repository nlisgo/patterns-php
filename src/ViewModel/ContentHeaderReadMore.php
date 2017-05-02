<?php

namespace eLife\Patterns\ViewModel;

use Assert\Assertion;
use eLife\Patterns\ArrayAccessFromProperties;
use eLife\Patterns\ArrayFromProperties;
use eLife\Patterns\ComposedAssets;
use eLife\Patterns\ViewModel;
use Traversable;

final class ContentHeaderReadMore implements ViewModel
{
    use ArrayAccessFromProperties;
    use ArrayFromProperties;
    use ComposedAssets;

    private $title;
    private $longTitle;
    private $url;
    private $hasSubjects;
    private $subjects;
    private $authorLine;
    private $meta;

    public function __construct(
        string $title,
        string $url,
        array $subjects = [],
        string $authorLine = null,
        Meta $meta = null
    ) {
        Assertion::notBlank($title);
        Assertion::notBlank($url);
        Assertion::allIsInstanceOf($subjects, Link::class);

        $this->title = $title;
        if (strlen(strip_tags($title)) >= 20) {
            $this->longTitle = true;
        }
        $this->url = $url;
        if ($subjects) {
            $this->hasSubjects = true;
            $this->subjects = $subjects;
        }
        $this->authorLine = $authorLine;
        $this->meta = $meta;
    }

    public function getTemplateName() : string
    {
        return 'resources/templates/content-header-read-more.mustache';
    }

    protected function getLocalStyleSheets() : Traversable
    {
        yield 'resources/assets/css/content-header.css';
    }

    protected function getComposedViewModels() : Traversable
    {
        yield $this->meta;
    }
}
