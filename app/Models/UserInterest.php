<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserInterest extends Pivot
{
    use HasFactory;

    protected $table = 'users_interests';

    protected $fillable = [
        'user_id',
        'interest_id',
    ];

    protected $with = ['interest_name'];

    public function interest_name()
    {
        return $this->hasOne(Interests::class, 'id', 'interest_id');
    }
}
