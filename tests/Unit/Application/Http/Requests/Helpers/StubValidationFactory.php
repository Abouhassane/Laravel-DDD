<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests\Helpers;

use Illuminate\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\Validator;

final class StubValidationFactory implements Factory
{
    public function extend($rule, $extension, $message = null): void
    {
    }

    public function extendImplicit($rule, $extension, $message = null): void
    {
    }

    public function make(array $data, array $rules, array $messages = [], array $customAttributes = []): Validator
    {
        $translator = new StubTranslator();

        $container = new Container();
        $container->offsetSet(Translator::class, $translator);
        $container->offsetSet('translator', $translator);

        Container::setInstance($container);

        $stubValidator = new StubValidator($data, $rules);
        $stubValidator->setContainer($container);
        $stubValidator->addExtensions($this->customExtensions());

        return $stubValidator;
    }

    public function replacer($rule, $replacer): void
    {
    }

    private function customExtensions(): array
    {
        return [];
    }
}
