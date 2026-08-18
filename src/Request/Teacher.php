<?php
namespace App\Request;
use OpenApi\Attributes as OA;

class Teacher
{
    #[OA\Property(description: '名字', example: '大老师2')]
    public string $tname = '';
}
