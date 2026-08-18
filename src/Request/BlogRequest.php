<?php
namespace App\Request;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

#[OA\Schema(description: '博客请求')]
class BlogRequest{

    #[OA\Property(description: '标题', example: 'Hello Symfony')]
    #[Assert\NotBlank]
    public string $title;

    #[OA\Property(description: '内容', example: 'This is the blog content.')]
    public string $content;

    #[OA\Property(description: '老师对象')]
    public ?Teacher $teacher = null;

    /** @var Child[] */
    #[OA\Property(
        description: '学生数组',
        type: 'array',
        items: new OA\Items(ref: new Model(type: Child::class)),
        example: [['sname' => '小孩']]
    )]
    public array $children = [];
}