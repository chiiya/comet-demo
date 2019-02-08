<?php

namespace Tests\Comet;

use App\Models\ApiKey;
use Tests\TestCase;

/**
 * Trait HasHooks
 * @mixin TestCase
 */
trait HasHooks
{
    /**
     * Hook to be executed before every request.
     * You can customize the request here, e.g.:
     *      return $this->withHeaders([
     *          'X-Authorization' => abcddefg12345,
     *      ]);
     * @return $this
     */
    protected function before() {
        $apiKey = ApiKey::createKey();
        return $this->withHeader('X-Authorization', $apiKey->key);
    }

}

