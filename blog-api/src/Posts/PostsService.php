<?php

namespace Assegaiphp\BlogApi\Posts;

use Assegai\Core\Attributes\Injectable;
use Assegaiphp\BlogApi\Posts\DTOs\CreatePostDTO;
use Assegaiphp\BlogApi\Posts\DTOs\UpdatePostDTO;

#[Injectable]
class PostsService
{
  /**
   * Finds all posts.
   * 
   * @return string
   */
  public function findAll(): string
  {
    return 'This action returns all posts!';
  }
  
  /**
   * Finds Posts by ID. 
   * 
   * @param int $id
   * @return string
   */
  public function findById(int $id): string
  {
    return "This action returns the #$id post!";
  }
  
  /**
   * Creates a new Post.
   * 
   * @param CreatePostDTO $createPostDTO
   * @return string
   */
  public function create(CreatePostDTO $createPostDTO): string
  {
    return 'This action creates a new post!';
  }

  /**
   * Updates a Post.
   * 
   * @param int $id
   * @param UpdatePostDTO $updatePostDTO
   * @return string
   */
  public function updateById(int $id, UpdatePostDTO $updatePostDTO): string
  {
    return "This action updates the #$id post!";
  }
  
  /**
   * Removes a(n) Post.
   * 
   * @param int $id
   * @return string
   */
  public function deleteById(int $id): string
  {
    return "This action deletes #$id post!";
  }
}