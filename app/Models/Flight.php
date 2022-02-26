<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = ['type','code','departure_id','destination_id','departure_time','arrival_time','airline_id'];


    public function airline(){
        return $this->hasOne(Airline::class,'id','airline_id');
    }

    public function departure(){
        return $this->hasOne(Airport::class,'id','departure_id');

    }
    public function destination(){
        return $this->hasOne(Airport::class,'id','destination_id');

    }
}
