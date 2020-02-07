<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = [
        'name',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function districts(){
        return $this->hasMany(District::class);
    }

    public function addDistrictsAttribute($districtName) : District{
        $district = District::firstOrNew([
            'name' => $districtName,
            'city_id' => $this->id,
        ]);
        $district->city_id = $this->id;
        $district->save();
        return $district;
    }
}
