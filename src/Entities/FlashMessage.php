<?php

namespace Authanram\Resources\Entities;

class FlashMessage
{
    public string $variant;

    public string $text;

    public ?string $caption;

    public function __construct(string $variant, string $text, ?string $caption = null)
    {
        $this->variant = $variant;

        $this->text = $text;

        $this->caption = $caption;
    }

    public function highlight(string $theme = ''): string
    {
        return sprintf($this->text, '<span class="' . $theme . '">', '</span>');
    }

    public static function make(string $variant, string $text, ?string $caption = null): self
    {
        return new self($variant, $text, $caption);
    }
}
