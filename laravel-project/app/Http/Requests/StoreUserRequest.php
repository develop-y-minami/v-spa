<?php

namespace App\Http\Requests;

use App\Rules\AlphanumericSymbol;
use App\Constants\TableConstants;
use Illuminate\Foundation\Http\FormRequest;

/**
 * 新しいユーザーを作成するためのリクエストバリデーションクラス
 *
 * このクラスは、ユーザー登録時に必要な入力項目に対するバリデーションルールを定義しています。
 * 具体的には、ユーザー名、名前、メールアドレス、パスワードに対するバリデーションを行い、
 * 正しい形式のデータが送信されることを保証します。
 * バリデーションルールは、定数クラス `TableConstants` を利用して最大文字数などを管理し、
 * カスタムバリデーションルール `AlphanumericSymbol` を使用して半角英数字および記号を含む制約を適用します。
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * ユーザーがリクエストを実行する権限があるかどうかを判断します。
     * 現在は常に false を返しているため、認証が必要でない場合に修正が必要です。
     *
     * @return bool  ユーザーがリクエストを実行できるかどうか
     */
    public function authorize(): bool
    {
        return true; // 認証が不要なら true を返す
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * リクエストに対して適用するバリデーションルールを返します。
     * 各フィールドに対するバリデーションルールを定義します。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>  バリデーションルールの配列
     */
    public function rules(): array
    {
        return [
            // ユーザー名（username）のバリデーションルール
            'username' => [
                'required',
                'string',
                'max:' . TableConstants::USERS_USERNAME_MAX_LENGTH,
                // 半角英数字および記号を含むカスタムバリデーションルール
                new AlphanumericSymbol,
                // 編集時に現在のユーザーを除外してユニークチェック
                $this->isMethod('post') ? 'unique:users' : 'unique:users,' . $this->route('user'), 
            ],
            // 名前（name）のバリデーションルール
            'name' => 'required|string|max:' . TableConstants::USERS_NAME_MAX_LENGTH,
            
            // メールアドレス（email）のバリデーションルール
            'email' => [
                'nullable',
                'email',
                'string',
                'max:' . TableConstants::USERS_EMAIL_MAX_LENGTH,
                // 編集時に現在のメールアドレスを除外
                'unique:users,email,' . $this->route('user'),
            ],
            
            // パスワード（password）のバリデーションルール
            'password' => [
                'required',
                'string',
                'min:' . TableConstants::USERS_PASSWORD_MIN_LENGTH,
                'max:' . TableConstants::USERS_PASSWORD_MAX_LENGTH,
                // 半角英数字および記号を含むカスタムバリデーションルール
                new AlphanumericSymbol,
            ],

             // 役割コードID（role_code_id）のバリデーションルールを追加
             'role_code_id' => 'required|integer', // 数値型で必須
        ];
    }

    /**
     * バリデーションエラーメッセージをカスタマイズ
     */
    public function messages(): array
    {
        return [
            'username.required' => 'ユーザー名は必須です。',
            'username.string' => 'ユーザー名は文字列である必要があります。',
            'username.max' => 'ユーザー名は最大 ' . TableConstants::USERS_USERNAME_MAX_LENGTH . ' 文字です。',
            'username.regex' => 'ユーザー名には半角英数字および記号（!@#$%^&*()_+-=）のみを含めてください。',
            'username.unique' => 'このユーザー名は既に登録されています。',
            
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列である必要があります。',
            'name.max' => '名前は最大 ' . TableConstants::USERS_NAME_MAX_LENGTH . ' 文字です。',
            
            'email.nullable' => 'メールアドレスは任意ですが、指定する場合は正しい形式で入力してください。',
            'email.email' => 'メールアドレスは正しい形式で入力してください。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.max' => 'メールアドレスは最大 ' . TableConstants::USERS_EMAIL_MAX_LENGTH . ' 文字です。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは最低 ' . TableConstants::USERS_PASSWORD_MIN_LENGTH . ' 文字である必要があります。',
            'password.max' => 'パスワードは最大 ' . TableConstants::USERS_PASSWORD_MAX_LENGTH . ' 文字です。',
            'password.regex' => 'パスワードは半角英数字および記号（!@#$%^&*()_+-=）を含む必要があります。',
        ];
    }
}
