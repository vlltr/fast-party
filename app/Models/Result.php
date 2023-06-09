<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'part_number',
        'serial_number',
        'duration'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function result_test_data()
    {
        return $this->hasMany(ResultTestData::class);
    }
}
