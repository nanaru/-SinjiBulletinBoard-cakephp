<?php
declare(strict_types=1);

namespace App\Request;

use Cake\Form\Form;
use Cake\Validation\Validator;
use OpenApi\Attributes as OA;

/**
 * ShowUserRequest
 */
class ShowUserRequest extends Form
{

    #[OA\PathParameter(required:true, parameter: 'ShowUserRequest_id', name: 'id', description: 'ユーザID', schema: new OA\Schema(type:'integer'))]
    private int $id;

    /**
     * @param \Cake\Validation\Validator $validator Validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->requirePresence('id')
            ->notEmptyString('id');

        return $validator;
    }

    /**
     * @param array $data data
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        $this->id = $data['id'];

        return true;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}
