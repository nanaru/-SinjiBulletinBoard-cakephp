<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Exception\ApplicationException;
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
    #[OA\PathParameter(required: true, name:'id', schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: '200', description: 'The data', content: [new OA\JsonContent(required: ['name'], properties: [new OA\Property(property: 'name', type:'string', description:'ユーザ名')])])]
    public function show($id): void
    {
        // $input = new UserShowInput($id);
        // $res   = $this->user_service->show($input);
        $this->set('task', ['id' => 1]);
        $this->viewBuilder()->setOption('serialize', ['task']);
    }
}
