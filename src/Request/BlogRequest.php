<?php
namespace App\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

#[OA\Schema(description: '博客请求')]
class BlogRequest{

    #[OA\Property(description: '标题', example: 'Hello Symfony')]
    #[Assert\NotBlank]
    public string $title;

    #[OA\Property(description: '内容', example: 'This is the blog content.')]
    public string $content;
}