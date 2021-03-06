<?php

namespace eLife\Patterns\ViewModel;

use Assert\Assertion;
use eLife\Patterns\ArrayAccessFromProperties;
use eLife\Patterns\ArrayFromProperties;
use eLife\Patterns\SimplifyAssets;
use eLife\Patterns\ViewModel;
use Traversable;

final class LeadPara implements ViewModel
{
    use ArrayAccessFromProperties;
    use ArrayFromProperties;
    use SimplifyAssets;

    protected $text;

    public function __construct(string $text, string $id = null)
    {
        Assertion::notBlank($text);

        $this->text = $text;
        $this->id = $id;
    }

    public function getStyleSheets() : Traversable
    {
        yield 'resources/assets/css/lead-para.css';
    }

    public function getTemplateName() : string
    {
        return 'resources/templates/lead-para.mustache';
    }
}
