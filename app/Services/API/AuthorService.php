<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 17:50
 */


declare(strict_types = 1);
namespace App\Services\API;
use App\Author;
use App\DTO\AuthorDTO;
use App\Exceptions\AuthorException;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;
/**
 * Class AuthorService
 * @package App\Services\API
 */
class AuthorService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $authors */
        $authors = Author::paginate(self::PER_PAGE, ['*'], 'page', $page);
        if ($authors->isEmpty()) {
            throw AuthorException::noData();
        }
        return $authors;
    }

    /**
     * @param int $authorId
     * @return AuthorDTO
     */
    public function getById(int $authorId): AuthorDTO
    {
        $author = Author::findOrFail($authorId);

        $dto = new AuthorDTO();

        return $dto->setAuthorId($author->id)
            ->setFirstname($author->first_name)
            ->setLastName($author->last_name);
    }
}
