<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TestTrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array
     */
    public function hosts()
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
