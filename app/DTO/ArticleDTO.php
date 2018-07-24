<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 19:42
 */

declare(strict_types = 1);

namespace App\DTO;

class ArticleDTO extends BaseDTO
{
    private $articleId;
    private $title;
    private $description;
    private $slug;

    private function getArticleId()
    {
        return $this->articleId;
    }

    public function setArticleId($articleId): ArticleDTO
    {
        $this->articleId = $articleId;

        return $this;
    }

    private function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): ArticleDTO
    {
        $this->title = $title;

        return $this;
    }

    private function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): ArticleDTO
    {
        $this->description = $description;

        return $this;
    }

    private function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): ArticleDTO
    {
        $this->slug = $slug;

        return $this;
    }

    protected function jsonData(): array
    {
        return [
            'author_id' => $this->getArticleId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'slug' => $this->getSlug(),
        ];
    }


}