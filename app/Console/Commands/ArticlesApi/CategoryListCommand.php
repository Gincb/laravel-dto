<?php

namespace App\Console\Commands\ArticlesApi;

use App\Services\ClientAPI\ClientCategoryService;

/**
 * Class CategoryListCommand
 * @package App\Console\Commands\ArticlesApi
 */
class CategoryListCommand extends ArticleBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:categories-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get categories paginator list';

    /** @var ClientCategoryService */
    private $clientCategoryService;

    /**
     * CategoryListCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->clientCategoryService = app()->make(ClientCategoryService::class);
    }

    /**
     * Execute the console command.
     *
     * @param string|null $url
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(string $url = null): void
    {
        try {
            $response = $this->client->get(($url) ? $url : $this->getCallUrl());

            $result = json_decode($response->getBody()->getContents());

            $this->checkSuccess($result);

            foreach($result->data->data as $row){
                $category = $this->clientCategoryService->saveCategoryFromObject($row);
                $this->info('Category '. $category->title. ' updated or created successfully');
            }

            if($url = $result->data->next_page_url){
                $this->handle($url);
            }

        }catch (\Throwable $exception){
            $this->error($exception->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getCallUrl(): string
    {
        return strtr(':url/category', [
            ':url' => parent::getCallUrl(),
        ]);
    }
}
