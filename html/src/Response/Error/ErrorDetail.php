<?php
declare(strict_types=1);

namespace App\Response\Error;

use Cake\Form\Form;

/**
 * ErrorDetail
 *
 * @OA\Schema(
 *   description="エラー詳細情報",
 *   type="object",
 * )
 */
class ErrorDetail extends Form
{
    /**
     * @OA\Property(
     *   property="key",
     *   type="string",
     *   description="エラーキー",
     * )
     * @var string
     */
    private $key = '';

    /**
     * @OA\Property(
     *   property="message",
     *   type="string",
     *   description="エラーメッセージ",
     * )
     * @var string
     */
    private $message = '';

    /**
     * @param array $data data
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        $this->key = $data['key'];
        $this->message = $data['message'];

        return true;
    }

    /**
     * @return array{key:string, message:string}
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'message' => $this->message,
        ];
    }
}
