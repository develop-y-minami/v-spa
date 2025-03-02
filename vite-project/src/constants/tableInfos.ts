// src/constants/tableInfos.ts

// ColumnInfo インターフェースは、テーブルのカラム情報を保持するための型定義です。
// 各カラムには 'name'（カラム名）と 'length'（カラムの長さ）が含まれます。
export interface ColumnInfo {
    name: string;   // カラム名
    length: number; // カラムの最大長
}

// TableInfos インターフェースは、全てのテーブルのカラム情報を管理するための型定義です。
// ここでは 'user' テーブルのカラム情報を定義しています。
export interface TableInfos {
    user: { // 'user' テーブルのカラム情報
        id: ColumnInfo;       // IDカラム
        username: ColumnInfo; // ユーザー名カラム
        name: ColumnInfo;     // 名前カラム
        email: ColumnInfo;    // メールアドレスカラム
        password: ColumnInfo; // パスワード
    },
    roleCodes: { // 'roleCodes' テーブルのカラム情報
        name: string;  // 名前
        user: number;  // 一般
        admin: number; // 管理者
    };
}

// tableInfos 定数は、テーブルごとのカラム情報を保持するオブジェクトです。
export const tableInfos: TableInfos = {
    user: { // 'user' テーブルのカラム設定
        id: {
            name: 'ユーザーID', // ユーザーIDカラムの名前
            length: 6,        // ユーザーIDの最大長
        },
        username: {
            name: 'ユーザー名', // ユーザー名カラムの名前
            length: 30,        // ユーザー名の最大長
        },
        name: {
            name: '名前',      // 名前カラムの名前
            length: 255,       // 名前の最大長
        },
        email: {
            name: 'メールアドレス', // メールアドレスカラムの名前
            length: 255,           // メールアドレスの最大長
        },
        password: {
            name: 'パスワード', // パスワードカラムの名前
            length: 255,       // パスワードの最大長
        },
    },
    roleCodes: {
        name: '役割',
        user: 1,
        admin: 2,
    }
};
