<?php

namespace eLife\Patterns\ViewModel;

use Assert\Assertion;
use eLife\Patterns\ArrayAccessFromProperties;
use eLife\Patterns\ArrayFromProperties;
use eLife\Patterns\SimplifyAssets;
use eLife\Patterns\ViewModel;
use Traversable;

final class CompactForm implements ViewModel
{
    use ArrayAccessFromProperties;
    use ArrayFromProperties;
    use SimplifyAssets;

    private $formAction;
    private $formId;
    private $formMethod;
    private $label;
    private $inputType;
    private $inputName;
    private $inputValue;
    private $inputPlaceholder;
    private $ctaText;
    private $hiddenFields;
    private $honeypot;

    public function __construct(Form $form, Input $input, string $ctaText, array $hiddenFields = [], Honeypot $honeypot = null)
    {
        Assertion::notBlank($ctaText);
        Assertion::allIsInstanceOf($hiddenFields, HiddenField::class);

        $this->formAction = $form['action'];
        $this->formId = $form['id'];
        $this->formMethod = $form['method'];
        $this->label = $input['label'];
        $this->inputType = $input['type'];
        $this->inputName = $input['name'];
        $this->inputValue = $input['value'];
        $this->inputPlaceholder = $input['placeholder'];
        $this->ctaText = $ctaText;
        $this->hiddenFields = $hiddenFields;
        $this->honeypot = $honeypot;
    }

    public function getTemplateName() : string
    {
        return 'resources/templates/compact-form.mustache';
    }

    public function getStyleSheets() : Traversable
    {
        yield 'resources/assets/css/compact-form.css';
    }
}
