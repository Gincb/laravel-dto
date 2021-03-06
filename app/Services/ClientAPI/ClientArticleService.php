<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-08-02
 * Time: 19:02
 */

declare(strict_types = 1);

namespace App\Services\ClientAPI;


use App\Article;

/**
 * Class ClientArticleService
 * @package App\Services\ClientAPI
 */
class ClientArticleService
{
    /**
     * @var ClientAuthorService
     */
    private $clientAuthorService;
    /**
     * @var ClientCategoryService
     */
    private $clientCategoryService;

    /**
     * ClientArticleService constructor.
     * @param ClientAuthorService $clientAuthorService
     * @param ClientCategoryService $clientCategoryService
     */
    public function __construct(ClientAuthorService $clientAuthorService, ClientCategoryService $clientCategoryService)
    {
        $this->clientAuthorService = $clientAuthorService;
        $this->clientCategoryService = $clientCategoryService;
    }


    /**
     * @param \stdClass $data
     * @return Article
     */
    public function saveArticleFromObject(\stdClass $data): Article
    {
        /** @var Article $article */
        $article = Article::updateOrCreate(
            ['reference_article_id' => $data->article_id],
            [
                'title' => $data->title,
                'slug' => $data->slug,
                'description' => $data->content,
                'author_id' => $this->clientAuthorService->saveAuthorFromObject($data->author)->id
            ]
        );

        $categoriesIds = $this->clientCategoryService->getIdsFromObjects($data->categories);

        $article->categories()->sync($categoriesIds);

        return $article;
    }
}