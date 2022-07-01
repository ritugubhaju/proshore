<?php

namespace App\Models\Event;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Sluggable;

    protected $dates = ['start_date','end_date'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [

        'slug',
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be typecast into boolean.
     *
     * @var array
     */

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $query
     * @param bool $type
     * @return mixed
     */


    /**
     * @param $query
     * @param bool $type
     * @return mixed
     */

}
