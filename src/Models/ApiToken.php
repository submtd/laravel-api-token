<?php

namespace Submtd\LaravelApiToken\Models;

use Carbon\Carbon;
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
        'name',
        'token',
        'token_expires_at',
        'refresh',
        'refresh_expires_at',
        'last_used_at',
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
     * Dates.
     * @var array
     */
    protected $dates = [
        'token_expires_at',
        'refresh_expires_at',
        'last_used_at',
    ];

    /**
     * Boot method.
     * - add uuid.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (! $model->name) {
                $model->name = 'Token created at '.Carbon::now()->toIso8601String();
            }
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
