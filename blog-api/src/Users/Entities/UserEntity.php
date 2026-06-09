<?php

namespace Assegaiphp\BlogApi\Users\Entities;

use Assegai\Orm\Attributes\Columns\Column;
use Assegai\Orm\Attributes\Columns\EmailColumn;
use Assegai\Orm\Attributes\Columns\PasswordColumn;
use Assegai\Orm\Attributes\Columns\PrimaryGeneratedColumn;
use Assegai\Orm\Attributes\Entity;
use Assegai\Orm\Attributes\Relations\OneToMany;
use Assegai\Orm\Queries\Sql\ColumnType;
use Assegai\Orm\Traits\ChangeRecorderTrait;
use Assegaiphp\BlogApi\Posts\Entities\PostEntity;

#[Entity(table: 'users')]
class UserEntity
{
  use ChangeRecorderTrait;
  
  #[PrimaryGeneratedColumn]
  public int $id = 0;

  #[EmailColumn]
  public string $email = '';

  #[PasswordColumn]
  public string $password = '';

  #[Column(name: 'first_name', type: ColumnType::VARCHAR, lengthOrValues: 255)]
  public string $firstName = '';

  #[Column(name: 'last_name', type: ColumnType::VARCHAR, lengthOrValues: 255)]
  public string $lastName = '';

  #[OneToMany(PostEntity::class, 'id', 'author')]
  public array $posts = [];
}