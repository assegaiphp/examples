<?php

namespace Assegaiphp\BlogApi\Users;

use Assegai\Core\Attributes\Controller;
use Assegai\Core\Attributes\Http\Body;
use Assegai\Core\Attributes\Http\Delete;
use Assegai\Core\Attributes\Http\Get;
use Assegai\Core\Attributes\Http\Post;
use Assegai\Core\Attributes\Http\Put;
use Assegai\Core\Attributes\Param;
use Assegai\Core\Exceptions\Http\NotFoundException;
use Assegai\Orm\Exceptions\ClassNotFoundException;
use Assegai\Orm\Exceptions\EmptyCriteriaException;
use Assegai\Orm\Exceptions\GeneralSQLQueryException;
use Assegai\Orm\Exceptions\IllegalTypeException;
use Assegai\Orm\Exceptions\ORMException;
use Assegai\Orm\Exceptions\SaveException;
use Assegai\Orm\Queries\QueryBuilder\Results\DeleteResult;
use Assegai\Orm\Queries\QueryBuilder\Results\InsertResult;
use Assegai\Orm\Queries\QueryBuilder\Results\UpdateResult;
use Assegai\Orm\Results\FindResult;
use Assegaiphp\BlogApi\Users\DTOs\CreateUserDTO;
use Assegaiphp\BlogApi\Users\DTOs\UpdateUserDTO;
use ReflectionException;
use Throwable;

#[Controller('users')]
readonly class UsersController
{
    /**
     * UsersController constructor.
     *
     * @param UsersService $usersService
     */
    public function __construct(private UsersService $usersService)
    {
    }

    /**
     * Finds all users.
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
        return $this->usersService->findAll();
    }

    /**
     * Finds Users by ID.
     *
     * @param int $id
     * @return object
     * @throws ClassNotFoundException
     * @throws GeneralSQLQueryException
     * @throws NotFoundException
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    #[Get(':id')]
    public function findById(#[Param('id')] int $id): object
    {
        return $this->usersService->findById($id);
    }

    /**
     * Creates a new User.
     *
     * @param CreateUserDTO $createUserDTO
     * @return InsertResult
     * @throws ClassNotFoundException
     * @throws EmptyCriteriaException
     * @throws GeneralSQLQueryException
     * @throws IllegalTypeException
     * @throws ORMException
     * @throws ReflectionException
     * @throws SaveException
     */
    #[Post]
    public function create(#[Body] CreateUserDTO $createUserDTO): InsertResult
    {
        return $this->usersService->create($createUserDTO);
    }

    /**
     * Updates User by ID.
     *
     * @param int $id
     * @param UpdateUserDTO $updateUserDTO
     * @return UpdateResult
     * @throws ORMException
     * @throws ReflectionException
     * @throws Throwable
     */
    #[Put(':id')]
    public function updateById(
        #[Param('id')] int    $id,
        #[Body] UpdateUserDTO $updateUserDTO
    ): UpdateResult
    {
        return $this->usersService->updateById($id, $updateUserDTO);
    }

    /**
     * Deletes User by ID.
     *
     * @param int $id
     * @return DeleteResult
     */
    #[Delete(':id')]
    public function deleteById(#[Param('id')] int $id): DeleteResult
    {
        return $this->usersService->deleteById($id);
    }
}