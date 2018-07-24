<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 17:50
 */

declare(strict_types = 1);
namespace App\Services\API;
use App\Category;
use App\DTO\CategoryDTO;
use App\Exceptions\CategoryException;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;
/**
 * Class CategoryService
 * @package App\Services\API
 */
class CategoryService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $categories */
        $categories = Category::paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($categories->isEmpty()) {
            throw CategoryException::noData();
        }
        return $categories;
    }

    public function getById(int $categoryId): CategoryDTO
    {
        $category = Category::findOrFail($categoryId);

        $dto = new CategoryDTO();

        return $dto->setCategoryId($category->id)
            ->setTitle($category->title)
            ->setSlug($category->slug);
    }
}