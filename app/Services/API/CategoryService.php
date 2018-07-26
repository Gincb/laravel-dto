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
use App\DTO\CategoriesDTO;
use App\DTO\CategoryDTO;
use App\DTO\PaginatorDTO;
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
     * @return PaginatorDTO
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(): PaginatorDTO
    {
        /** @var LengthAwarePaginator $categories */
        $categories = Category::paginate(self::PER_PAGE);

        if ($categories->isEmpty()) {
            throw CategoryException::noData();
        }

        $categoriesDTO = new CategoriesDTO();

        foreach ($categories as $category){
            $categoriesDTO->setCategoryData(
                (new CategoryDTO())
                    ->setCategoryId($category->id)
                    ->setTitle($category->title)
                    ->setSlug($category->slug)
            );
        }

        return new PaginatorDTO(
            $categories->currentPage(),
            collect($categoriesDTO)->get('data'),
            $categories->lastPage(),
            $categories->total(),
            $categories->perPage(),
            $categories->nextPageUrl(),
            $categories->previousPageUrl()
        );
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