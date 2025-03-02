// errorMessages.ts
export const errorMessages = {
    requiredField: (fieldName: string) => `${fieldName}を入力してください`,
    invalidCharacterFormat: (fieldName: string) => `${fieldName}は半角英数字および記号のみで入力してください`,
    invalidFormat: (fieldName: string) => `${fieldName}の入力形式が正しくありません`,
    invalidPasswordFormat: 'パスワードは最低6文字以上で、半角英数字と記号を含む必要があります',
};
