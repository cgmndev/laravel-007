<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\BlogPostCreated;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => BlogPostCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
