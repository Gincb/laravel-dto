<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-25
 * Time: 18:54
 */

namespace App\DTO;


use App\DTO\interfaces\ArticleDTOInterface;
use Illuminate\Support\Collection;

class ArticleFullDTO extends BaseDTO implements ArticleDTOInterface
{
    /**
     * @var ArticleDTO
     */
    private $articleDTO;
    /**
     * @var AuthorDTO
     */
    private $authorDTO;
    /**
     * @var Collection
     */
    private $categoriesDTO;

    /**
     * ArticleFullDTO constructor.
     * @param ArticleDTO $articleDTO
     * @param AuthorDTO $authorDTO
     * @param CategoriesDTO $categories
     */
    public function __construct(ArticleDTO $articleDTO, AuthorDTO $authorDTO, CategoriesDTO $categoriesDTO)
    {
        $this->articleDTO = $articleDTO;
        $this->authorDTO = $authorDTO;
        $this->categoriesDTO = $categoriesDTO;
    }

    protected function jsonData(): array
    {
        return[
            'article' => $this->articleDTO,
            'author' => $this->authorDTO,
            'categories' => collect($this->categoriesDTO)->get('data'),
        ];
    }
}