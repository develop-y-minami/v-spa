import axios from 'axios';
import type { AxiosResponse } from 'axios';
import { API_BASE_URL } from '../config';

/**
 * Axios インスタンスの作成
 * - `baseURL` : API のベース URL（環境に応じて変更可能）
 * - `timeout` : タイムアウト時間（ミリ秒単位）
 * - `headers` : 共通ヘッダー（JSON をデフォルトに設定）
 */
const api = axios.create({
  baseURL: API_BASE_URL, // APIのベースURL
  timeout: 10000, // タイムアウト時間（10秒）
  headers: {
    'Content-Type': 'application/json',
  },
});

/**
 * リクエストインターセプター
 * - リクエストごとに認証トークンを追加
 * - 認証トークンは `localStorage` から取得
 */
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('auth_token'); // ローカルストレージからトークンを取得
    if (token) {
      config.headers.Authorization = `Bearer ${token}`; // Authorization ヘッダーにトークンを設定
    }
    return config;
  },
  (error) => Promise.reject(error) // リクエストエラー時の処理
);

/**
 * レスポンスインターセプター
 * - 成功時はそのままレスポンスを返す
 * - 失敗時はエラーメッセージをログに出力し、エラーを投げる
 */
api.interceptors.response.use(
  (response: AxiosResponse) => response, // 成功時はそのままレスポンスを返す
  (error) => {
    console.error('API Error:', error.response?.data || error.message); // エラー情報をコンソールに出力
    return Promise.reject(error); // エラーを呼び出し元へ伝える
  }
);

export default api; // 作成した Axios インスタンスをエクスポート
