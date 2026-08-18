<?php
namespace App\Request;
use OpenApi\Attributes as OA;

class Child
{
    #[OA\Property(description: '名字', example: '小孩')]
    public string $sname = '';
}
