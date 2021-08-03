<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckSheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle');
    }
    
    public function labels()
    {
        return $this->belongsToMany('App\Models\Label','label_check_sheet');
    }
    
}
