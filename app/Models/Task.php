<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Deleting all cards connected to the task
        self::deleting(function ($task) {
           $task->cards->each->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function cardsCompleted()
    {
        return $this->cards()->where('is_complete', '=', 1);
    }

}
