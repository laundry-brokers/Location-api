<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = ['name_city', 'id_state'];
    public $timestamp = true;

    public static function records() {
        return self::join('states', function($join) {
            return $join->on('states.id', '=', 'cities.id_state');
        })
        ->get();
    }

    public function state() {
        return $this->belongsTo(State::class, 'id_state');
    }
}
