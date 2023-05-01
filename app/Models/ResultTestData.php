<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultTestData extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'default_name',
        'read_value',
        'result',
    ];

    public function result(){
        return $this->belongsTo(Result::class);
    }
}
