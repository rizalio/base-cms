<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Posts
 * @package App\Models
 * @version March 9, 2017, 6:59 am UTC
 */
class Posts extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'category_id',
        'thumbnail',
        'description',
        'status',
        'gen_id',
        'lang'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'category_id' => 'integer',
        'thumbnail' => 'string',
        'description' => 'string',
        'status' => 'string',
        'gen_id' => 'string',
        'lang' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function category() {
        return $this->belongsTo('App\Models\Categories');
    }
    
}
