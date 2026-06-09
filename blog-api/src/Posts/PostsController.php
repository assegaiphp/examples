<?php

namespace Assegaiphp\BlogApi\Posts;

use Assegai\Core\Attributes\Controller;
use Assegai\Core\Attributes\Http\Body;
use Assegai\Core\Attributes\Http\Get;
use Assegai\Core\Attributes\Http\Post;
use Assegai\Core\Attributes\Http\Put;
use Assegai\Core\Attributes\Http\Delete;
use Assegai\Core\Attributes\Param;
use Assegaiphp\BlogApi\Posts\DTOs\CreatePostDTO;
use Assegaiphp\BlogApi\Posts\DTOs\UpdatePostDTO;

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
   * @return string
   */
  #[Get]
  public function findAll(): string
  {
    return $this->postsService->findAll();  
  }
  
  /**
   * Finds Posts by ID. 
   * 
   * @param int $id
   * @return string
   */
  #[Get(':id')]
  public function findById(#[Param('id')] int $id): string
  {
    return $this->postsService->findById($id);
  }
  
  /**
   * Creates a new Post.
   * 
   * @param CreatePostDTO $createPostDTO 
   * @return string
   */
  #[Post]
  public function create(#[Body] CreatePostDTO $createPostDTO): string
  {
    return $this->postsService->create($createPostDTO);
  }
  
  /**
   * Updates Post by ID.
   * 
   * @param int $id
   * @param UpdatePostDTO $updatePostDTO
   * @return string
   */
  #[Put(':id')]
  public function updateById(
    #[Param('id')] int $id,
    #[Body] UpdatePostDTO $updatePostDTO
  ): string
  {
    return $this->postsService->updateById($id, $updatePostDTO);
  }
  
  /**
   * Deletes Post by ID.
   * 
   * @param int $id
   * @return string
   */
  #[Delete(':id')]
  public function deleteById(#[Param('id')] int $id): string
  {
    return $this->postsService->deleteById($id);
  }
}