<?php

namespace App\Repositories;

use App\Models\Posts;
use InfyOm\Generator\Common\BaseRepository;

class PostsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'category_id',
        'thumbnail',
        'description',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Posts::class;
    }
}
