<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = [
        'title', 
        'author',
        'description',
    ];
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows')->withPivot('borrow_date', 'return_date');
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
