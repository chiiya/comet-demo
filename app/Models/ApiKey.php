<?php

namespace App\Models;

/**
 * App\Models\ApiKey
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $key
 * @property int apikeyable_id
 * @property string apikeyable_type
 * @property string last_ip_address
 * @property string last_used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ApiKey extends \Chrisbjr\ApiGuard\Models\ApiKey
{
    /**
     * Generate and get a new Api Key.
     *
     * @return ApiKey
     */
    public static function createKey(): ApiKey
    {
        $apiKey = new self([
            'key'             => self::generateKey(),
        ]);

        $apiKey->save();

        return $apiKey;
    }
}
