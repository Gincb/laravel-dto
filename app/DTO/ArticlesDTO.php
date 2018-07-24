<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-24
 * Time: 18:59
 */

namespace App\DTO;


class ArticlesDTO extends BaseDTO
{

    private $collectionData;

    public function __construct()
    {
        $this->collectionData = collect();
    }

    /**
     * @param ArticleDTO $articleDTO
     * @return ArticlesDTO
     */
    public function setArticle(ArticleDTO $articleDTO): ArticlesDTO
    {
        $this->collectionData->push($articleDTO);

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