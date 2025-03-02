/**
 * Users Store (ユーザー管理ストア)
 * 
 * このストアは、ユーザーのデータを管理し、以下の機能を提供します：
 * - ユーザーの一覧を取得する
 * - 新しいユーザーを追加する
 * - ユーザー情報の取得と追加の際のローディング状態やエラーメッセージを管理する
 * 
 * 使用方法：
 * - `useUsersStore()`を呼び出して、ユーザーの状態やアクションにアクセスします。
 * - アクション`fetchAllUsers`でユーザーの一覧を取得します。
 * - アクション`addUser`で新しいユーザーを追加します。
 * 
 * @module stores/usersStore
 * 
 * @example
 * ```ts
 * import { useUsersStore } from '../stores/usersStore';
 * 
 * const usersStore = useUsersStore();
 * usersStore.fetchAllUsers(); // ユーザー一覧を取得
 * usersStore.addUser(newUser); // 新しいユーザーを追加
 * usersStore.deleteUser(userId); // ユーザーを削除
 * ```
 */

import { defineStore } from 'pinia';
import api from '../api/api';
import type { AxiosResponse } from 'axios';
import type { ApiResponse } from '../types/apiResponse';
import { AxiosError } from 'axios';

// ユーザー情報の型定義
export interface User {
    id?: number;
    username: string;
    password: string;
    name: string;
    email: string;
    role_code_id: number;
    created_at?: string;
    updated_at?: string;
}

// Piniaストアの定義
export const useUsersStore = defineStore('users', {
    state: () => ({
        users: null as User[] | null, // ユーザー一覧、初期状態はnull
        loading: false,               // ローディング状態
        error: null as string | null, // エラーメッセージ
    }),

    actions: {
        /**
         * すべてのユーザーを取得し、状態に保存する関数
         * 
         * APIからユーザー一覧を取得し、成功した場合は状態に保存します。
         * すでにデータがある場合は、再度APIを呼び出しません。キャッシュを使用します。
         * 
         * @returns {Promise<void>} 非同期処理
         */
        async fetchAllUsers() {
            // ユーザー一覧が既にある場合は再取得しない
            if (this.users !== null) return;

            this.loading = true;
            this.error = null;

            try {
                // getAllUsersメソッドでユーザー情報を取得
                const users = await this.getAllUsers();
                this.users = users; // 取得したユーザーを状態に保存
            } catch (error) {
                this.error = 'ユーザー一覧の取得に失敗しました';
                console.error('ユーザー一覧の取得エラー:', error);
                throw error; // エラーを呼び出し元に投げる
            } finally {
                this.loading = false; // ローディング完了
            }
        },

        /**
         * すべてのユーザーをAPIから取得する関数
         * 
         * APIからユーザー一覧を取得し、成功した場合はそのデータを返します。
         * キャッシュがあれば、APIリクエストを送信せずにキャッシュデータを返します。
         * 
         * @returns {Promise<User[]>} ユーザーのリスト
         */
        async getAllUsers(): Promise<User[]> {
            try {
                // キャッシュが存在する場合は、キャッシュデータを返す
                if (this.users) {
                    return this.users;
                }

                // APIからユーザーリストを取得するリクエスト
                const response: AxiosResponse<ApiResponse<User[]>> = await api.get('/users');
                
                if (response.data.success) {
                    return response.data.data; // 成功した場合、ユーザーリストを返す
                } else {
                    throw new Error(response.data.message); // 失敗した場合はエラーメッセージを投げる
                }
            } catch (error) {
                console.error('ユーザー一覧の取得エラー:', error);
                throw error; // エラーを呼び出し元に投げる
            }
        },

        /**
         * 新しいユーザーを追加する関数
         * 
         * APIにユーザー情報を送信し、成功した場合にはその情報を状態に反映します。
         * ユーザー追加後、追加されたユーザー情報を現在のユーザー一覧に追加します。
         * 
         * @param {User} user 追加するユーザー情報
         * @returns {Promise<User>} 追加されたユーザー情報
         */
        async addUser(user: User): Promise<User> {
            this.loading = true;
            this.error = null;

            try {
                // APIにユーザー情報を送信してユーザーを追加
                const response: AxiosResponse<ApiResponse<User>> = await api.post('/users', user);

                if (response.data.success) {
                    const newUser = response.data.data;
                    // 現在のユーザー一覧に追加されたユーザーを反映
                    this.users = this.users ? [...this.users, newUser] : [newUser];
                    return newUser; // 追加されたユーザー情報を返す
                } else {
                    throw new Error(response.data.message); // 失敗した場合はエラーメッセージを投げる
                }
            } catch (error) {
                this.error = 'ユーザーの追加に失敗しました';
                console.error('ユーザー追加エラー:', error);
                throw error; // エラーを呼び出し元に投げる
            } finally {
                this.loading = false; // ローディング完了
            }
        },

        /**
         * ユーザーを削除する関数
         * 
         * 指定したユーザーIDに基づいて、APIにリクエストを送り、ユーザーを削除します。
         * 削除成功後、状態からもそのユーザーを削除します。
         * 
         * @param {number} userId 削除するユーザーのID
         * @returns {Promise<void>} 非同期処理
         */
        async deleteUser(userId: number): Promise<void> {
            this.loading = true;
            this.error = null;

            try {
                // APIに削除リクエストを送信
                const response: AxiosResponse<ApiResponse<null>> = await api.delete(`/users/${userId}`);

                if (response.data.success) {
                    // 削除が成功した場合、現在のユーザー一覧から削除対象のユーザーを削除
                    if (this.users) {
                        this.users = this.users.filter(user => user.id !== userId);
                    }
                } else {
                    throw new Error(response.data.message); // 失敗した場合はエラーメッセージを投げる
                }
            } catch (error: unknown) {
                if (error instanceof AxiosError) {
                    // AxiosErrorであることを確認してからエラーハンドリング
                    if (error.response && error.response.status === 410) {
                        this.error = 'ユーザーは既に削除されています。';

                        // ユーザー一覧から該当のユーザーを削除
                        if (this.users) {
                            this.users = this.users.filter(user => user.id !== userId);
                        }
                    } else {
                        this.error = 'ユーザーの削除に失敗しました';
                    }
                } else {
                    // AxiosErrorでない場合のデフォルトエラーハンドリング
                    this.error = '予期しないエラーが発生しました';
                }
                console.error('ユーザー削除エラー:', error);
                throw error;
            } finally {
                this.loading = false; // ローディング完了
            }
        }
    }
});
