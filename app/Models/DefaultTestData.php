<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultTestData extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'default_name',
        'max_value',
        'min_value',
    ];

    public function test(){
        return $this->belongsTo(Test::class);
    }
}
