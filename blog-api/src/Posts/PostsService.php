<?php

namespace Assegaiphp\BlogApi\Posts;

use Assegai\Core\Attributes\Injectable;
use Assegai\Core\Exceptions\Http\NotFoundException as NotFoundHttpException;
use Assegai\Orm\Attributes\InjectRepository;
use Assegai\Orm\Exceptions\ClassNotFoundException;
use Assegai\Orm\Exceptions\ContainerException;
use Assegai\Orm\Exceptions\EmptyCriteriaException;
use Assegai\Orm\Exceptions\GeneralSQLQueryException;
use Assegai\Orm\Exceptions\IllegalTypeException;
use Assegai\Orm\Exceptions\NotFoundException as NotFoundOrmException;
use Assegai\Orm\Exceptions\ORMException;
use Assegai\Orm\Exceptions\SaveException;
use Assegai\Orm\Management\Options\FindOptions;
use Assegai\Orm\Management\Options\InsertOptions;
use Assegai\Orm\Management\Options\RemoveOptions;
use Assegai\Orm\Management\Options\UpdateOptions;
use Assegai\Orm\Management\Repository;
use Assegai\Orm\Queries\QueryBuilder\Results\DeleteResult;
use Assegai\Orm\Queries\QueryBuilder\Results\InsertResult;
use Assegai\Orm\Queries\QueryBuilder\Results\UpdateResult;
use Assegai\Orm\Results\FindResult;
use Assegaiphp\BlogApi\Auth\AuthService;
use Assegaiphp\BlogApi\Posts\DTOs\CreatePostDTO;
use Assegaiphp\BlogApi\Posts\DTOs\UpdatePostDTO;
use Assegaiphp\BlogApi\Posts\Entities\PostEntity;
use DateTime;
use ReflectionException;
use Throwable;

#[Injectable]
readonly class PostsService
{
    public function __construct(
        #[InjectRepository(PostEntity::class)]
        private Repository $postsRepository,
        private AuthService $authService
    )
    {
    }

    /**
     * Finds all posts.
     *
     * @param array<array-key, mixed> $filters
     * @param string[] $columns
     * @return FindResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function findAll(array $filters = [], array $columns = []): FindResult
    {
        $options = new FindOptions(relations: $columns, where: $filters);
        $result = $this->postsRepository->find($options);

        if ($result->isError()) {
            throw $result->getLatestError();
        }

        return $result;
    }

    /**
     * Finds Posts by ID.
     *
     * @param int $id
     * @param string[] $columns
     * @return object<PostEntity>
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundHttpException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function findById(int $id, array $columns = ['author']): object
    {
        $result = $this->findAll(['id' => $id], $columns);

        if ($result->isError()) {
            throw new NotFoundHttpException("Post with ID $id not found.");
        }

        return $result->getFirst();
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
    public function create(CreatePostDTO $createPostDTO): InsertResult
    {
        $post = $this->postsRepository->create($createPostDTO);
        assert($post instanceof PostEntity);
        $post->author = $this->authService->getUser();
        $insertOptions = new InsertOptions(relations: ['author']);

        $saveResult = $this->postsRepository->save($post, $insertOptions);

        if ($saveResult->isError()) {
            throw $saveResult->getLatestError();
        }

        if (!$saveResult instanceof InsertResult) {
            throw new \RuntimeException("Expected an InsertResult, got " . get_class($saveResult));
        }

        return $saveResult;
    }

    /**
     * Updates a Post.
     *
     * @param int $id
     * @param UpdatePostDTO $updatePostDTO
     * @return UpdateResult
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function updateById(int $id, UpdatePostDTO $updatePostDTO): UpdateResult
    {
        $options = new UpdateOptions();
        $updateResult = $this->postsRepository->update(['id' => $id], $updatePostDTO, $options);

        if ($updateResult->isError()) {
            throw $updateResult->getLatestError();
        }

        return $updateResult;
    }

    /**
     * Removes a(n) Post.
     *
     * @param int $id
     * @return DeleteResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundHttpException
     * @throws NotFoundOrmException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     * @throws ContainerException
     * @throws \DateInvalidTimeZoneException
     * @throws \DateMalformedStringException
     */
    public function deleteById(int $id): DeleteResult
    {
        $post = $this->findById($id);

        $removeOptions = new RemoveOptions();
        $removeResult = $this->postsRepository->softRemove($post, $removeOptions);

        if ($removeResult->isError()) {
            throw $removeResult->getLatestError();
        }

        return new DeleteResult(
            raw: $removeResult->getRaw(),
            affected: $removeResult->getTotalAffectedRows(),
            errors: $removeResult->getErrors()
        );
    }
}