<?php

namespace App\Repositories;

use App\Models\SectionDetails;
use InfyOm\Generator\Common\BaseRepository;

class SectionDetailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'section_id',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SectionDetails::class;
    }
}
