<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle');
    }

    public function checkSheets()
    {
        return $this->belongsToMany('App\Models\CheckSheet','label_check_sheet');
    }
}
