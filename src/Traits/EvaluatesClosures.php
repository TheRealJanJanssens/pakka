<?php

namespace TheRealJanJanssens\Pakka\Traits;

use Closure;

trait EvaluatesClosures
{
    public function evaluate($value)
    {
        if ($value instanceof Closure) {
            return app()->call($value);
        }

        return $value;
    }

    // FILAMENTS Evaluation scripts

    // protected string $evaluationIdentifier;

    // protected array $evaluationParametersToRemove = [];

    // public function evaluate($value, array $parameters = [], array $exceptParameters = [])
    // {
    //     $this->evaluationParametersToRemove = $exceptParameters;

    //     if ($value instanceof Closure) {
    //         return app()->call(
    //             $value,
    //             array_merge(
    //                 isset($this->evaluationIdentifier) ? [$this->evaluationIdentifier => $this] : [],
    //                 $this->getDefaultEvaluationParameters(),
    //                 $parameters,
    //             ),
    //         );
    //     }

    //     return $value;
    // }

    // protected function getDefaultEvaluationParameters(): array
    // {
    //     return [];
    // }

    // protected function resolveEvaluationParameter(string $parameter, Closure $value)
    // {
    //     if ($this->isEvaluationParameterRemoved($parameter)) {
    //         return null;
    //     }

    //     return $value();
    // }

    // protected function isEvaluationParameterRemoved(string $parameter): bool
    // {
    //     return in_array($parameter, $this->evaluationParametersToRemove);
    // }
}
