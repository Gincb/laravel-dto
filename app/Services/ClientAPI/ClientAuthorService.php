<?php

/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-08-01
 * Time: 20:47
 */

namespace App\Services\ClientAPI;

use App\Author;

/**
 * Class ClientAuthorService
 * @package App\Services\ClientAPI
 */
class ClientAuthorService
{
    /**
     * @param \stdClass $data
     * @return Author
     */
    public function saveAuthorFromObject(\stdClass $data): Author
    {
        return Author::updateOrCreate(
            [
                'first_name'=>$data->first_name,
                'last_name'=>$data->last_name,
            ],
            [
                'reference_author_id'=>$data->author_id,
            ]
        );
    }

}