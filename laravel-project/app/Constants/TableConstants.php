<?php

namespace App\Constants;

/**
 * テーブルに関連する定数をまとめたクラス
 *
 * このクラスは、アプリケーションで使用されるテーブルの列や制約に関する定数を
 * 集約しています。
 */
class TableConstants
{
    // users テーブルに関連する定数を定義
    // ユーザー名の最大文字数を設定
    public const USERS_USERNAME_MAX_LENGTH = 30;
    
    // メールアドレスの最大文字数を設定
    public const USERS_EMAIL_MAX_LENGTH = 255;
    
    // パスワードの最大文字数を設定
    public const USERS_PASSWORD_MAX_LENGTH = 255;
    
    // パスワードの最小文字数を設定
    public const USERS_PASSWORD_MIN_LENGTH = 6;
    
    // 名前（name）の最大文字数を設定
    public const USERS_NAME_MAX_LENGTH = 255;
}
