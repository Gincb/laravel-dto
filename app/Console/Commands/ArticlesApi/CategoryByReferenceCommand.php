<?php

namespace App\Console\Commands\ArticlesApi;

use App\Category;
use GuzzleHttp\Client;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        try {
            $client = new Client();

            $response = $client->get($this->getCallUrl());

            $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

            if (!$data->success) {
                $this->error($data->message);
                exit();
            }

            $category = Category::updateOrCreate(
                ['slug' => $data->data->slug],
                ['title' => $data->data->title, 'reference_category_id' => $data->data->category_id]
            );

            $this->info('Category', $category->title, 'uploaded or created successfully');

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
