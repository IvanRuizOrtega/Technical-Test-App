<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UsingUuid;

class Student extends Model
{
    use HasFactory, UsingUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'identification',
        'identification_type_id',
        'course_id'
    ];

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeSearch($query, $data)
    {
        if (trim($data) != "") 
        {
            $query->where("name","LIKE","%$data%")
                ->orWhere("email","LIKE","%$data%")
                ->orWhere("identification","LIKE","%$data%")
                ->orWhere("created_at","LIKE","%$data%")
                ->orWhere("updated_at","LIKE","%$data%");
        }
    }

}
