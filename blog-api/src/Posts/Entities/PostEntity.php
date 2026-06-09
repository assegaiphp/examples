<?php

namespace Assegaiphp\BlogApi\Posts\Entities;

use Assegai\Orm\Attributes\Columns\Column;
use Assegai\Orm\Attributes\Columns\PrimaryGeneratedColumn;
use Assegai\Orm\Attributes\Entity;
use Assegai\Orm\Attributes\Relations\ManyToOne;
use Assegai\Orm\Queries\Sql\ColumnType;
use Assegai\Orm\Traits\ChangeRecorderTrait;
use Assegaiphp\BlogApi\Users\Entities\UserEntity;

#[Entity(table: 'posts')]
class PostEntity
{
  use ChangeRecorderTrait;
  
  #[PrimaryGeneratedColumn]
  public int $id = 0;

  #[Column(type: ColumnType::VARCHAR, lengthOrValues: 255)]
  public string $title = '';

  #[Column(type: ColumnType::TEXT, lengthOrValues: 255)]
  public string $content = '';

  #[ManyToOne(UserEntity::class)]
  public UserEntity $author;
}