<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class TitleModel extends Model
{
    protected function getFields(): array
    {
        return [
            'title_id'      =>new Field(new NumberValidator(), false),
            'category_id'   =>new Field(new NumberValidator()),
            'title_name'    =>new Field(new StringValidator()),
            'school_class'  =>new Field(new StringValidator()),

        ];
    }

    public function getAllByCategoryId(int $categoryId): array
    {
        return $this->getAllByFieldName('category_id', $categoryId);
    }
}