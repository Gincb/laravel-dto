<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-08-02
 * Time: 18:26
 */

namespace App\Services\ClientAPI;


use App\Category;

/**
 * Class ClientCategoryService
 * @package App\Services\ClientAPI
 */
class ClientCategoryService
{
    /**
     * @param \stdClass $data
     * @return Category
     */
    public function saveCategoryFromObject(\stdClass $data): Category
    {
        return Category::updateOrCreate(
            ['slug' => $data->slug],
            [
                'title' => $data->title,
                'reference_category_id' => $data->category_id
            ]
        );
    }

    /**
     * @param array $categories
     * @return array
     */
    public function getIdsFromObjects(array $categories = []): array
    {
        $ids = [];

        foreach ($categories as $category){
            $ids[] = $this->saveCategoryFromObject($category)->id;
        }

        return $ids;
    }
}