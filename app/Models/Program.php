<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['title','aim','message','user_id'];

    public function course(): BelongsToMany
    {
        return $this->BelongsToMany(Course::class,'program_course');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'program_user');
    }
}
