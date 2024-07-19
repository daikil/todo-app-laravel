<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * リクエストのnameなどの属性名を再定義するメソッド
     *
     * @return array<string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'フォルダ名',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * リクエストの内容に基づいた権限チェックを行うメソッド
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // 返り値にtrueを指定する（リクエストを受け付ける）
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * バリデーションルールを定義するメソッド
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // タイトルの入力欄を入力必須に定義する
            'title' => 'required|max:20',
        ];
    }
}
