/**
 * 半角英数字および記号のみで構成されているかを検証する関数
 * 
 * この関数は、入力された文字列が半角英数字（a-z, A-Z, 0-9）および
 * 特定の記号（! ~）のみで構成されているかどうかを判定します。
 * 
 * @param value チェック対象の文字列
 * @returns {boolean} 文字列が半角英数字および記号のみで構成されていれば `true` を返し、それ以外の場合は `false` を返します。
 */
export const validateAlphanumericWithSymbols = (value: string): boolean => {
    const pattern = /^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/;
    return pattern.test(value);
};

/**
 * メールアドレスの形式を検証する関数です。
 * 
 * この関数は、入力されたメールアドレスが正しい形式かどうかをチェックします。
 * メールアドレスは、英数字、記号（._%+-）、およびドメイン名（例：example.com）の形式である必要があります。
 * 
 * @param email メールアドレス文字列
 * @returns メールアドレスが正しい形式であれば true、それ以外の場合は false を返します。
 */
export const validateEmailFormat = (email: string): boolean => {
    // 正規表現を使ってメールアドレス形式をチェック
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
};

/**
 * パスワードの検証関数
 * 
 * - パスワードが最低6文字以上で、半角英数字記号を含むかをチェックします。
 * 
 * @param {string} password パスワード
 * @returns {boolean} パスワードが条件を満たすかどうか
 */
export const validatePassword = (password: string): boolean => {
    // 最低6文字以上、半角英数字記号を含む正規表現
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+={}\[\]:;"'<>,.?/\\|]).{6,}$/;
    return passwordPattern.test(password);
};