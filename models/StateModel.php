<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class StateModel extends Model
{
    protected function getFields(): array
    {
        return [
            'state_id'      =>new Field(new NumberValidator(), false),
            'state_name'    =>new Field(new StringValidator()),
        ];
    }

    public function getAllByStateId(int $stateId): array
    {
        return $this->getAllByFieldName('state_id', $stateId);
    }
}