<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number_of_winners',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function winners()
    {
        return $this->belongsToMany(User::class, 'raffle_winner', 'user_id', 'raffle_id');
    }

    public function isComplete()
    {
        return $this->number_of_winners === $this->winners->count();
    }
}
