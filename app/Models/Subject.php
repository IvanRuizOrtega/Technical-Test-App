<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UsingUuid;

class Subject extends Model
{
    use HasFactory, UsingUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function scopeSearch($query, $data)
    {
        if (trim($data) != "") 
        {
            $query->where("subjects.name","LIKE","%$data%")
                ->orWhere("subjects.created_at","LIKE","%$data%")
                ->orWhere("subjects.updated_at","LIKE","%$data%");
        }
    }
}
