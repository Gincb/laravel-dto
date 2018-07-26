<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 20:21
 */

declare(strict_types = 1);

namespace App\DTO;

class CategoryDTO extends BaseDTO
{
    private $categoryId;
    private $title;
    private $slug;

    private function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId): CategoryDTO
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    private function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): CategoryDTO
    {
        $this->title = $title;

        return $this;
    }

    private function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug($slug): CategoryDTO
    {
        $this->slug = $slug;

        return $this;
    }

    protected function jsonData(): array
    {
        return [
            'id' => $this->getCategoryId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
        ];
    }
}