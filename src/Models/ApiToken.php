<?php

namespace Submtd\LaravelApiToken\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    /**
     * Fillable attributes.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'token',
        'token_expires_at',
        'refresh',
        'refresh_expires_at',
    ];

    /**
     * Hidden attributes.
     * @var array
     */
    protected $hidden = [
        'token',
        'refresh',
    ];

    /**
     * Boot method.
     * - add uuid.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Belongs to user.
     */
    public function user()
    {
        return $this->belongsTo(config('api-token.user_model', config('auth.providers.users.model', '\App\User')));
    }
}
