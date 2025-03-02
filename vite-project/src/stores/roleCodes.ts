/**
 * RoleCode Store (役割コードストア)
 * 
 * このストアは、役割コードのデータを管理するために使用されます。主に以下の機能を提供します：
 * - 役割コードのリストを取得する
 * - 特定の役割コードをIDで取得する
 * - ローディング状態やエラーメッセージの管理
 * 
 * 使用方法：
 * - `useRoleCodeStore()`を呼び出して、役割コードの状態やアクションにアクセスします。
 * - アクション`fetchRoleCodes`で役割コードのリストを取得します。
 * - アクション`getRoleCodeById`で特定の役割コードをIDで取得します。
 * 
 * @module stores/roleCodeStore
 * 
 * @example
 * ```ts
 * import { useRoleCodeStore } from '../stores/roleCodeStore';
 * 
 * const roleCodeStore = useRoleCodeStore();
 * roleCodeStore.fetchRoleCodes(); // 役割コードを取得
 * ```
 */

import { defineStore } from 'pinia';
import api from '../api/api'; // 共通のAPI設定をインポート
import type { AxiosResponse } from 'axios'; // Axiosのレスポンス型をインポート
import type { ApiResponse } from '../types/apiResponse'; // 共通レスポンス型をインポート

// 役割コードの型定義
interface RoleCode {
    id: number;
    name: string;
}

export const useRoleCodeStore = defineStore('roleCode', {
    state: () => ({
        roleCodes: null as RoleCode[] | null, // 役割コードのリスト（初期値はnull）
        loading: false, // ローディング状態
        error: null as string | null // エラーメッセージ
    }),

    actions: {
        // 役割コードを取得する関数
        async fetchRoleCodes() {
            // すでにデータがある場合、再度APIを呼び出さない
            if (this.roleCodes !== null) {
                return;
            }

            this.loading = true;
            this.error = null;

            try {
                const roleCodes = await this.getRoleCodes();
                this.roleCodes = roleCodes; // 取得した役割コードを状態に保存
            } catch (error) {
                this.error = '役割コードの取得に失敗しました';
                console.error('役割コードの取得エラー:', error);
                throw error;
            } finally {
                this.loading = false;
            }
        },

        // すべての役割コードを取得する関数
        async getRoleCodes(): Promise<RoleCode[]> {
            try {
                // APIから役割コードのリストを取得するリクエスト
                const response: AxiosResponse<ApiResponse<RoleCode[]>> = await api.get('/role-codes');

                // APIのレスポンスが成功したかどうかをチェック
                if (response.data.success) {
                    return response.data.data; // 成功した場合、役割コードのリストを返す
                } else {
                    throw new Error(response.data.message); // 成功しなかった場合、エラーメッセージを投げる
                }
            } catch (error) {
                console.error('Error fetching role codes:', error); // エラーログを出力
                throw error; // エラーを呼び出し元に投げる
            }
        },

        // 特定の役割コードをIDで取得する関数
        async getRoleCodeById(id: number): Promise<RoleCode | null> {
            try {
                // APIから特定の役割コードをIDで取得するリクエスト
                const response: AxiosResponse<ApiResponse<RoleCode>> = await api.get(`/role-codes/${id}`);

                // APIのレスポンスが成功したかどうかをチェック
                if (response.data.success) {
                    return response.data.data; // 役割コードが取得できた場合、そのデータを返す
                } else {
                    throw new Error(response.data.message); // 成功しなかった場合、エラーメッセージを投げる
                }
            } catch (error) {
                console.error('Error fetching role code by ID:', error); // エラーログを出力
                throw error; // エラーを呼び出し元に投げる
            }
        }
    }
});
