<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function default_test_data(){
        return $this->hasMany(DefaultTestData::class);
    }
}
