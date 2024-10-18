<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Book;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book as EloquentBook;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\BookMapper;

final class BookEloquentRepository implements BookRepository
{
    /**
     * @param Book $book
     *
     * @return Book
     */
    public function create(Book $book): Book
    {
        $eloquentBook = BookMapper::toEloquentModel($book);
        $eloquentBook->save();

        return BookMapper::toDomainEntity($eloquentBook);
    }

    /**
     * @return array<Book>
     */
    public function getAll(): array
    {
        $books = EloquentBook::with(['author'])
            ->get()
            ->all();

        if (empty($books)) {
            return [];
        }

        return BookMapper::toManyDomainEntities($books);
    }

    /**
     * @param string $authorId
     *
     * @return array<Book>
     */
    public function getBooksByAuthorId(string $authorId): array
    {
        $eloquentBooks = EloquentBook::where(['author_id' => $authorId])
            ->with(['author'])
            ->get()
            ->all();

        if (empty($eloquentBooks)) {
            return [];
        }

        return BookMapper::toManyDomainEntities($eloquentBooks);
    }

    public function getBookById(string $bookId): Book
    {
        $eloquentBook = EloquentBook::where(['id' => $bookId])->first();

        return BookMapper::toDomainEntity($eloquentBook);
    }
}
