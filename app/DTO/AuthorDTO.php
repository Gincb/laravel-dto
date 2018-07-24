<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-07-23
 * Time: 18:03
 */

declare(strict_types=1);

namespace App\DTO;

class AuthorDTO extends BaseDTO
{
    private $authorId;
    private $firstName;
    private $lastName;

    /**
     * @param int $authorId
     * @return AuthorDTO
     */
    public function setAuthorId(int $authorId): AuthorDTO
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @param string $firstName
     * @return AuthorDTO
     */
    public function setFirstName(string $firstName): AuthorDTO
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string $lastName
     * @return AuthorDTO
     */
    public function setLastName(string $lastName): AuthorDTO
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return int
     */
    private function getAuthorId(): int
    {
        return $this->authorId;
    }

    private function getFirstName()
    {
        return $this->firstName;
    }

    private function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return array
     */

    protected function jsonData(): array
    {
        return [
            'author_id' => $this->getAuthorId(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'full_name' => $this->getFullName(),
        ];
    }

    /**
     * @return string
     */
    private function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
}