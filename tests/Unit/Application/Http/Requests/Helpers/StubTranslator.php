<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests\Helpers;

use Illuminate\Contracts\Translation\Translator;

final class StubTranslator implements Translator
{
    public function choice($key, $number, array $replace = [], $locale = null): string
    {
        return $key;
    }

    public function get($key, array $replace = [], $locale = null): string
    {
        return $key;
    }

    public function getLocale(): string
    {
        return 'en';
    }

    public function setLocale($locale): void
    {
    }
}
