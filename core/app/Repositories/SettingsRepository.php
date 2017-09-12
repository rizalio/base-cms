<?php

namespace App\Repositories;

use App\Models\Settings;
use InfyOm\Generator\Common\BaseRepository;

class SettingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'display_name',
        'value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Settings::class;
    }
}
