<?php

namespace Assegaiphp\BlogApi\Users;

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
use Assegaiphp\BlogApi\Users\DTOs\CreateUserDTO;
use Assegaiphp\BlogApi\Users\DTOs\UpdateUserDTO;
use Assegaiphp\BlogApi\Users\Entities\UserEntity;
use DateInvalidTimeZoneException;
use DateMalformedStringException;
use ReflectionException;
use RuntimeException;
use Throwable;

#[Injectable]
readonly class UsersService
{
    public function __construct(
        #[InjectRepository(UserEntity::class)]
        private Repository  $usersRepository
    )
    {
    }

    /**
     * Finds Users by ID.
     *
     * @param int $id
     * @param array $columns
     * @return object
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundHttpException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function findById(int $id, array $columns = []): object
    {
        $findResult = $this->findAll(filters: ['id' => $id], columns: $columns);

        if ($findResult->isEmpty()) {
            throw new NotFoundHttpException("User with ID $id not found.");
        }

        return $findResult->getFirst();
    }

    /**
     * Finds all users.
     *
     * @param array $filters
     * @param array $columns
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

        $result = $this->usersRepository->find($options);

        if ($result->isError()) {
            throw $result->getLatestError();
        }

        return $result;
    }

    /**
     * Creates a new User.
     *
     * @param CreateUserDTO $createUserDTO
     * @return InsertResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws ORMException
     * @throws ReflectionException
     * @throws EmptyCriteriaException
     * @throws IllegalTypeException
     * @throws SaveException
     */
    public function create(CreateUserDTO $createUserDTO): InsertResult
    {
        $user = $this->usersRepository->create($createUserDTO);
        $options = new InsertOptions();

        $saveResult = $this->usersRepository->save($user, $options);

        if ($saveResult->isError()) {
            throw $saveResult->getLatestError();
        }

        if (!$saveResult instanceof InsertResult) {
            throw new RuntimeException("Expected an instance of InsertResult, got " . get_class($saveResult));
        }

        return $saveResult;
    }

    /**
     * Updates a User.
     *
     * @param int $id
     * @param UpdateUserDTO $updateUserDTO
     * @return UpdateResult
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    public function updateById(int $id, UpdateUserDTO $updateUserDTO): UpdateResult
    {
        $updateOptions = new UpdateOptions();

        $result = $this->usersRepository->update(['id' => $id], $updateUserDTO, $updateOptions);

        if ($result->isError()) {
            throw $result->getLatestError();
        }

        return $result;
    }

    /**
     * Removes a(n) User.
     *
     * @param int $id
     * @return DeleteResult
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundOrmException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     * @throws ContainerException
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedStringException
     */
    public function deleteById(int $id): DeleteResult
    {
        $user = $this->findById($id);

        $removeOptions = new RemoveOptions();

        $result = $this->usersRepository->softRemove($user, $removeOptions);

        if ($result->isError()) {
            throw $result->getLatestError();
        }

        return new DeleteResult(
            raw: $result->getRaw(),
            affected: $result->getTotalAffectedRows(),
            errors: $result->getErrors()
        );
    }
}