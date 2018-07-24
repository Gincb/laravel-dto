<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-24
 * Time: 20:42
 */

namespace App\DTO;


class CategoriesDTO extends BaseDTO
{
    private $collectionData;

    public function __construct()
    {
        $this->collectionData = collect();
    }

    /**
     * @param CategoryDTO $categoryDTO
     * @return CategoriesDTO
     */
    public function setArticle(CategoryDTO $categoryDTO): CategoriesDTO
    {
        $this->collectionData->push($categoryDTO);

        return $this;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return[
            'data' => $this->collectionData,
        ];
    }
}