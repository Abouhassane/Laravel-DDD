<?php

declare(strict_types=1);

namespace App\Application\Rules\Project;

use App\Domain\Project\Project;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class IsValidProjectStatus implements InvokableRule, DataAwareRule
{
    protected array $data = [];

    /**
     * @param string  $attribute
     * @param mixed   $value
     * @param Closure $fail
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if ($this->passes($value)) {
            return;
        }

        $fail($this->failMessage());
    }

    /**
     * @param array $data
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    private function passes($value): bool
    {
        return in_array($value, Project::STATUSES, true);
    }

    private function failMessage(): string
    {
        return trans('custom_validation.project.status.invalid');
    }
}
