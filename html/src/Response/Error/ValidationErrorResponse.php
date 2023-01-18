<?php
declare(strict_types=1);

namespace App\Response\Error;

use Cake\Collection\Collection;
use Cake\Controller\Controller;
use Cake\Form\Form;
use Cake\Utility\Hash;

/**
 * ValidationErrorResponse
 *
 * @OA\Response(
 *   response="ValidationErrorResponse",
 *   description="バリデーションエラー",
 *   @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse"),
 * )
 * @OA\Schema(
 *   description="バリデーションエラーレスポンス情報",
 *   type="object",
 * )
 */
class ValidationErrorResponse extends Form
{
    /**
     * @OA\Property(
     *   property="errors",
     *   type="array",
     *   description="エラー一覧情報",
     *   @OA\Items(ref="#/components/schemas/ErrorDetail"),
     * )
     * @var \App\Response\Error\ErrorDetail[]
     */
    private $errors = [];

    /**
     * @param array $data data
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        $errors = Hash::flatten($data);
        $this->errors = (new Collection($errors))->map(function (string $value, string $key) {
            $errorDetail = new ErrorDetail();
            $errorDetail->execute([
                'key' => $key,
                'message' => $value,
            ]);

            return $errorDetail;
        })->toList();

        return true;
    }

    /**
     * @param \Cake\Controller\Controller $controller controller
     * @return void
     */
    public function response(Controller $controller): void
    {
        $errors = (new Collection($this->errors))->map(function (ErrorDetail $errorDetail) {
            return $errorDetail->toArray();
        })->toList();

        $controller->setResponse($controller->getResponse()->withStatus(400));
        $controller->set('errors', $errors);
        $controller->viewBuilder()->setOption('serialize', ['errors']);
    }

    /**
     * @param \Cake\Controller\Controller $controller controller
     * @param array $errors errors
     * @return void
     */
    public static function error(Controller $controller, array $errors): void
    {
        $errorForm = new ValidationErrorResponse();
        $errorForm->execute($errors);
        $errorForm->response($controller);
    }
}
