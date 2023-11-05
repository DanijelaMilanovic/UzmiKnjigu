<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class TypeOfUserModel extends Model
{
    protected function getFields(): array
    {
        return [
            'type_id'     =>new Field(new NumberValidator(), false),
            'type_name'   =>new Field(new StringValidator()),
        ];
    }

    public function getAllByTypeId(int $typeId): array
    {
        return $this->getAllByFieldName('type_id', $typeId);
    }
}