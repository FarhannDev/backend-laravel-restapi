<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_id'
    ];

    protected $incrementing = true;
    protected $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'user_id', 'id');
    }

    public function address(): HasMany
    {
        return $this->hasMany(Address::class, 'contact_id', 'id');
    }
}
