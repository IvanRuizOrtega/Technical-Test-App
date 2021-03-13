<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UsingUuid;

class Course extends Model
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

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function scopeSearch($query, $data)
    {
        if (trim($data) != "") 
        {
            $query->where("name","LIKE","%$data%")
                ->orWhere("created_at","LIKE","%$data%")
                ->orWhere("updated_at","LIKE","%$data%");
        }
    }
}
