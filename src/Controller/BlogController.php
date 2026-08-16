<?php
namespace App\Controller;

use App\Request\BlogRequest;
use App\Response\BlogResponse;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_list', methods: ['POST'])]
    #[OA\Post(
        summary: '创建博客',
        description: '接收 JSON 请求体并创建一篇博客',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: new Model(type: BlogRequest::class))
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: '创建成功，返回博客数据',
                content: new OA\JsonContent(ref: new Model(type: BlogResponse::class))
            ),
            new OA\Response(
                response: 400,
                description: '参数校验失败',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'err_msg', type: 'string', example: 'title: This value should not be blank.'),
                    ]
                )
            ),
        ]
    )]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $jsonData = $request->getContent();
        $blog = $serializer->deserialize($jsonData, BlogRequest::class, 'json');

        $errors = $validator->validate($blog);
        if (count($errors) > 0) {
            $violation = $errors[0];
            return new JsonResponse(['err_msg' => $violation->getPropertyPath() . ': ' . $violation->getMessage()]);
        }

        $res = new BlogResponse();
        $res->title = $blog->title;
        $res->content = $blog->content;
        $res->id = 1;

        $response = new JsonResponse($res);
        return $response;
    }
}