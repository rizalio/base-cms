<?php

namespace App\Repositories;

use App\Models\Localization;
use InfyOm\Generator\Common\BaseRepository;

class LocalizationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'dir',
        'is_active',
        'namespace'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Localization::class;
    }
}
