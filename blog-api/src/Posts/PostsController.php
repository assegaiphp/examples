<?php

namespace Assegaiphp\BlogApi\Posts;

use Assegai\Core\Attributes\Controller;
use Assegai\Core\Attributes\Http\Body;
use Assegai\Core\Attributes\Http\Delete;
use Assegai\Core\Attributes\Http\Get;
use Assegai\Core\Attributes\Http\Post;
use Assegai\Core\Attributes\Http\Put;
use Assegai\Core\Attributes\Param;
use Assegai\Core\Exceptions\Http\NotFoundException;
use Assegai\Orm\Exceptions\ClassNotFoundException;
use Assegai\Orm\Exceptions\ContainerException;
use Assegai\Orm\Exceptions\EmptyCriteriaException;
use Assegai\Orm\Exceptions\GeneralSQLQueryException;
use Assegai\Orm\Exceptions\IllegalTypeException;
use Assegai\Orm\Exceptions\ORMException;
use Assegai\Orm\Exceptions\SaveException;
use Assegai\Orm\Queries\QueryBuilder\Results\DeleteResult;
use Assegai\Orm\Queries\QueryBuilder\Results\InsertResult;
use Assegai\Orm\Queries\QueryBuilder\Results\UpdateResult;
use Assegai\Orm\Results\FindResult;
use Assegaiphp\BlogApi\Posts\DTOs\CreatePostDTO;
use Assegaiphp\BlogApi\Posts\DTOs\UpdatePostDTO;
use Assegaiphp\BlogApi\Posts\Entities\PostEntity;
use DateInvalidTimeZoneException;
use DateMalformedStringException;
use ReflectionException;
use Throwable;

#[Controller('posts')]
readonly class PostsController
{
    /**
     * PostsController constructor.
     *
     * @param PostsService $postsService
     */
    public function __construct(private PostsService $postsService)
    {
    }

    /**
     * Finds all posts.
     *
     * @return FindResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    #[Get]
    public function findAll(): FindResult
    {
        return $this->postsService->findAll();
    }

    /**
     * Finds Posts by ID.
     *
     * @param int $id
     * @return object<PostEntity>
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     * @throws NotFoundException
     */
    #[Get(':id')]
    public function findById(#[Param('id')] int $id): object
    {
        return $this->postsService->findById($id);
    }

    /**
     * Creates a new Post.
     *
     * @param CreatePostDTO $createPostDTO
     * @return InsertResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws ORMException
     * @throws ReflectionException
     * @throws EmptyCriteriaException
     * @throws IllegalTypeException
     * @throws SaveException
     */
    #[Post]
    public function create(#[Body] CreatePostDTO $createPostDTO): InsertResult
    {
        return $this->postsService->create($createPostDTO);
    }

    /**
     * Updates Post by ID.
     *
     * @param int $id
     * @param UpdatePostDTO $updatePostDTO
     * @return UpdateResult
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    #[Put(':id')]
    public function updateById(
        #[Param('id')] int    $id,
        #[Body] UpdatePostDTO $updatePostDTO
    ): UpdateResult
    {
        return $this->postsService->updateById($id, $updatePostDTO);
    }

    /**
     * Deletes Post by ID.
     *
     * @param int $id
     * @return DeleteResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     * @throws ContainerException
     * @throws \Assegai\Orm\Exceptions\NotFoundException
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedStringException
     */
    #[Delete(':id')]
    public function deleteById(#[Param('id')] int $id): DeleteResult
    {
        return $this->postsService->deleteById($id);
    }
}