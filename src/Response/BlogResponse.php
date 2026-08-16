<?php
namespace App\Response;
use OpenApi\Attributes as OA;

#[OA\Schema(description: '博客响应')]
class BlogResponse{

    #[OA\Property(description: '标题', example: 'Hello Symfony')]
    public string $title;

    #[OA\Property(description: '内容', example: 'This is the blog content.')]
    public string $content;

    #[OA\Property(description: 'ID', example: 1)]
    public int $id;
}