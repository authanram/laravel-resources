<?php

namespace Authanram\Resources\Entities;

class FlashMessage
{
    public string $classAttribute;

    public string $text;

    public ?string $caption;

    public function __construct(string $variant, string $text, ?string $caption = null)
    {
        $padding = theme('padding');

        // @todo use theme
        $this->classAttribute = "bg-$variant-100 text-$variant-700 $padding";

        $this->text = $text;

        $this->caption = $caption;
    }

    public function highlight(string $cssClasses = 'font-semibold'): string
    {
        return sprintf($this->text, '<span class="' . $cssClasses . '">', '</span>');
    }

    public static function make(string $variant, string $text, ?string $caption = null): self
    {
        return new self($variant, $text, $caption);
    }
}
