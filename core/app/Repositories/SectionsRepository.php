<?php

namespace App\Repositories;

use App\Models\Sections;
use InfyOm\Generator\Common\BaseRepository;

class SectionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'namespace',
        'display_name',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sections::class;
    }
}
