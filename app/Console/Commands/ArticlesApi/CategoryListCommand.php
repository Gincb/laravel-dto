<?php

namespace App\Console\Commands\ArticlesApi;

use App\Category;
use GuzzleHttp\Client;

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

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(): void
    {
        try {
            $client = new Client();

            $response = $client->request('GET', $this->getCallUrl());

            $result = \GuzzleHttp\json_decode($response->getBody()->getContents());

            if(!$result->success){
                $this->error($result->messeges);
                exit();
            }
            foreach($result->data->data as $row){
                $category = $this->saveData($row);
                $this->info('Category ', $category->title, ' update or created successfully');
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

    /**
     * @param \stdClass $row
     * @return Category
     */
    private function saveData(\stdClass $row): Category
    {
        return Category::updateOrCreate(
            ['slug'=>$row->slug],
            ['title'=>$row->title,'reference_category_id' => $row->category_id]
        );
    }
}
