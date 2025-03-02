<?php

// app/Rules/AlphanumericSymbol.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * 半角英数字および一部の特殊文字のみを許可するバリデーションルール
 *
 * このクラスは、ユーザーが入力した値が半角英数字（a-z, A-Z, 0-9）と
 * 特殊文字（!@#$%^&*()_+-=）のみで構成されていることを確認するための
 * バリデーションルールを提供します。主にユーザー名やパスワードなどの
 * 入力項目に適用されることが多いです。
 */
class AlphanumericSymbol implements Rule
{
    /**
     * バリデーションルールが有効かどうかを判断します。
     *
     * このメソッドでは、与えられた入力値が指定された正規表現に一致するかどうかを確認します。
     * 正規表現は、半角英数字および一部の特殊文字（!@#$%^&*()_+-=）のみを許可します。
     *
     * @param  string  $attribute  バリデーション対象の属性名（例: username）
     * @param  mixed  $value  入力された値
     * @return bool  バリデーションが成功したかどうかを示す真偽値
     */
    public function passes($attribute, $value): bool
    {
        // 半角英数字および特殊文字のみ許可する正規表現を使用
        return preg_match('/^[a-zA-Z0-9!@#$%^&*()_+-=]+$/', $value);
    }

    /**
     * バリデーションエラーメッセージを取得します。
     *
     * 入力値がバリデーションに失敗した場合に表示されるエラーメッセージを返します。
     * メッセージ内の :attribute は、実際の属性名（例: username）に置き換えられます。
     *
     * @return string  エラーメッセージ
     */
    public function message(): string
    {
        return 'The :attribute may only contain letters, numbers, and special characters like !@#$%^&*()_+-=.';
    }
}
