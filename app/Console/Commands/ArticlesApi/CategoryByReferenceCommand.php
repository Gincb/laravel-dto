<?php

namespace App\Console\Commands\ArticlesApi;

use App\Services\ClientAPI\ClientCategoryService;

/**
 * Class CategoryByReferenceCommand
 * @package App\Console\Commands\ArticlesApi
 */
class CategoryByReferenceCommand extends ArticleBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:category-by-id {reference_category_id : Reference category ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get category by ID';

    /** @var ClientCategoryService  */
    private $clientCategoryService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->clientCategoryService = app()->make(ClientCategoryService::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        try {

            $response = $this->client->get($this->getCallUrl());

            $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

            $this->checkSuccess($data);

            $category = $this->clientCategoryService->saveCategoryFromObject($data->data);

            $this->info('Category '. $category->title. ' uploaded or created successfully');

        }catch(\Throwable $exception){
            $this->error($exception->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getCallUrl(): string
    {
        return strtr(':url/category/:id', [
            ':url' => parent::getCallUrl(),
            ':id' => $this->argument('reference_category_id'),
        ]); //laravel
    }
}
