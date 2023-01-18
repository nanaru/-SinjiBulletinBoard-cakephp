<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Exception\ApplicationException;
use App\Response\Error\ValidationErrorResponse;
use App\Request\ShowUserRequest;
use OpenApi\Attributes as OA;

class UserController extends AppController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(path: '/api/users/{id}', tags: ['User'])]
    #[OA\PathParameter(ref: '#/components/parameters/ShowUserRequest_id')]
    #[OA\Response(response: '200', description: 'The data', content: [new OA\JsonContent(required: ['name'], properties: [new OA\Property(property: 'name', type:'string', description:'ユーザ名')])])]
    #[OA\Response(response: '400', description: 'The error', content: [new OA\JsonContent(ref: '#/components/responses/ValidationErrorResponse')])]
    public function show(int $id): void
    {
        $requestForm = new ShowUserRequest();
        if (!$requestForm->execute(['id' => $id])) {
            ValidationErrorResponse::error($this, $requestForm->getErrors());

            return;
        }
        // $input = new UserShowInput($id);
        // $res   = $this->user_service->show($input);
        $this->set('task', ['id' => 1]);
        $this->viewBuilder()->setOption('serialize', ['task']);
    }
}
