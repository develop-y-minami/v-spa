/**
 * グローバルなローディング状態を管理するためのキー
 * 
 * - `provide` で `isLoading` を親コンポーネントから提供する際に使用。
 * - `inject` で子コンポーネントが `isLoading` を取得する際にも使用。
 * - `Symbol('isLoading')` を共通で使うことで、異なるコンポーネント間で正しくデータを共有できる。
 */
export const isLoadingKey = Symbol('isLoading');
