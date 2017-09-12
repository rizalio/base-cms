<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sections
 * @package App\Models
 * @version March 6, 2017, 8:16 am UTC
 */
class Sections extends Model
{
    use SoftDeletes;

    public $table = 'sections';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'namespace',
        'display_name',
        'content',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'namespace' => 'string',
        'display_name' => 'string',
        'content' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function section_details() {
        return $this->hasMany('App\Models\SectionDetails', 'section_id');
    }
    
}
