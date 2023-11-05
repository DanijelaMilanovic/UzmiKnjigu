<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class CategoryModel extends Model
{
    protected function getFields(): array
    {
        return [
            'category_id'   =>new Field(new NumberValidator(), false),
            'category_name' =>new Field((new StringValidator())->setMaxLength(45))
        ];
    }

    public function getAllByCategoryId(int $categoryId): array
    {
        return $this->getAllByFieldName('category_id', $categoryId);
    }
}