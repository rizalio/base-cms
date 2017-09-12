<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SectionDetails
 * @package App\Models
 * @version March 7, 2017, 6:14 am UTC
 */
class SectionDetails extends Model
{
    use SoftDeletes;

    public $table = 'section_details';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'section_id',
        'content',
        'lang',
        'gen_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'section_id' => 'integer',
        'content' => 'string',
        'lang' => 'integer',
        'gen_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function localization() {
        return $this->belongsTo('\App\Models\Localization', 'lang');
    }

}
