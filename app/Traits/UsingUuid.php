<?php 

namespace App\Traits;

use Illuminate\Support\Str;

trait UsingUuid {

	protected static function bootUsingUuid()
    {
        static::creating(function ($model) 
            {
                if (! $model->getKey()) 
                {
                    $model->{$model->getKeyName()} = (string) Str::uuid();
                }
            }
        );
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
    
}