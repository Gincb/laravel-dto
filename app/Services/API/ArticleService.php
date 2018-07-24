<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 17:48
 */

declare(strict_types = 1);

namespace App\Services\API;

use App\DTO\ArticleDTO;
use App\DTO\ArticlesDTO;
use App\DTO\PaginatorDTO;
use App\Exceptions\ArticleException;
use App\Article;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;
/**
 * Class ArticleService
 * @package App\Services\API
 */
class ArticleService extends ApiService
{
    /**
     * @return PaginatorDTO
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(): PaginatorDTO
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::paginate(self::PER_PAGE);

        if ($articles->isEmpty()) {
            throw ArticleException::noData();
        }

        $articlesDTO = new ArticlesDTO();

        foreach ($articles as $article){
            $articlesDTO->setArticle(
                (new ArticleDTO())
                    ->setArticleId($article->id)
                    ->setTitle($article->title)
                    ->setDescription($article->description)
                    ->setSlug($article->slug)
            );
        }

        return new PaginatorDTO(
            $articles->currentPage(),
            collect($articlesDTO)->get('data'),
            $articles->lastPage(),
            $articles->total(),
            $articles->perPage(),
            $articles->nextPageUrl(),
            $articles->previousPageUrl()
        );
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::with(['author', 'categories'])->paginate(self::PER_PAGE);

        if ($articles->isEmpty()) {
            throw ArticleException::noData();
        }

        return $articles;
    }

    public function getById(int $articleId): ArticleDTO
    {
        $article = Article::findOrFail($articleId);

        $dto = new ArticleDTO();

        return $dto->setArticleId($article->id)
            ->setTitle($article->title)
            ->setDescription($article->description)
            ->setSlug($article->slug);
    }
}