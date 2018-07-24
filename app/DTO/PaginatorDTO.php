<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-24
 * Time: 19:38
 */

namespace App\DTO;


use Illuminate\Support\Collection;

class PaginatorDTO extends BaseDTO
{
    /**
     * @var int
     */
    private $currentPage;
    /**
     * @var Collection
     */
    private $data;
    /**
     * @var int
     */
    private $lastPage;
    /**
     * @var string
     */
    private $total;
    /**
     * @var int
     */
    private $perPage;

    private $nextPageUrl;
    /**
     * @var string
     */
    private $prevPageUrl;
    /**
     * @var int
     */
    /**
     * PaginatorDTO constructor.
     * @param int $currentPage
     * @param Collection $data
     * @param int $lastPage
     * @param int $total
     * @param int $perPage
     * @param string $nextPageUrl
     * @param string $prevPageUrl
     */
    public function __construct(int $currentPage, Collection $data, int $lastPage, int $total, int $perPage, string $nextPageUrl = null, string $prevPageUrl = null)

    {
        $this->currentPage = $currentPage;
        $this->data = $data;
        $this->lastPage = $lastPage;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->nextPageUrl = $nextPageUrl;
        $this->prevPageUrl = $prevPageUrl;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'current_page' => $this->currentPage,
            'data' => $this->data,
            'last_page' => $this->lastPage,
            'total'=> $this->total,
            'per_page' => $this->perPage,
            'next_page_url' => $this->nextPageUrl,
            'prev_page_url' => $this->prevPageUrl,
        ];
    }
}