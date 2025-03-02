<template>
    <!-- ユーザー一覧 -->
    <ul class="list">
        <li v-for="data in datas" :key="data.id">
            <div class="content">
                <div class="user_content">
                    <div class="left">
                        <div>
                            <span class="id">{{ data.id?.toString().padStart(tableInfos.user.id.length, '0') }}</span>
                            <span class="user_name">{{ data.username  }}</span>
                        </div>
                        <div class="name">{{ data.name }}</div>
                    </div>
                    <div class="right">
                        <div class="icon edit">
                            <span class="material-symbols-outlined">edit_document</span>
                        </div>
                        <div class="icon delete" @click="confirmDelete(data.id)">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script setup lang="ts">
    import { ref, onMounted, defineEmits, inject } from 'vue';
    import type { Ref } from 'vue';
    import { useUsersStore } from '../../stores/users';
    import type { User } from '../../stores/users';
    import { tableInfos } from '../../constants/tableInfos';
    import { isLoadingKey } from '../../keys';
    import { messageStore } from '../../stores/messageStore';
    import { confirmStore } from '../../stores/confirmStore';
    import DeleteUserInfo from '../infos/DeleteUserInfo.vue';

    // 親コンポーネントにイベントを送信するための emit を定義
    const emit = defineEmits<{
        (event: 'initialize-success'): void;
        (event: 'error', message: string): void;
        (event: 'clear-errors'): void;
        (event: 'showMessage', message: { message: string, title: string, icon: string }): void;
    }>();

    // Piniaストアを使用してユーザーデータにアクセス
    const usersStore = useUsersStore();

    // ユーザーデータを格納するための変数
    const datas = ref<User[]>([]);

    // 削除対象のユーザーID
    const selectedUserId = ref<number | null>(null);

    // 確認モーダルの表示状態
    const isConfirmModalVisible = ref(false);

    // `isLoading` を inject で取得
    const isLoading = inject(isLoadingKey) as Ref<boolean>;

    /**
     * ユーザー情報を初期化するための関数
     * 
     * ユーザー情報を非同期で取得し、`datas` にセットします。成功時には親コンポーネントにイベントを送信します。
     */
    const initialize = async () => {
        try {
            // ユーザー情報を非同期で取得
            await usersStore.fetchAllUsers();
            datas.value = usersStore.users || [];
            emit('initialize-success');
        } catch (err) {
            emit('error', 'ユーザー情報の取得に失敗しました。');
        }
    };

    /**
     * ユーザー削除確認モーダルを表示する関数
     * 
     * ユーザーIDを受け取り、削除対象のユーザーIDをセットしてモーダルを表示します。
     * 
     * @param userId 削除対象のユーザーID
     */
    const confirmDelete = (userId: number | undefined) => {
        if (userId === undefined) return;
        selectedUserId.value = userId;

        // 選択されたユーザーを取得
        const selectedUserData = datas.value.find(user => user.id === selectedUserId.value);
        
        confirmStore.showConfirm(
            '本当にこのユーザーを削除しますか？',
            undefined,
            undefined,
            undefined,
            undefined,
            DeleteUserInfo,
            { user: selectedUserData },
            deleteUser,
            undefined
        );
    };

    /**
     * ユーザー削除を実行する関数
     * 
     * 削除対象のユーザーIDを使ってユーザー削除を実行します。削除後はユーザーリストから対象ユーザーを削除し、モーダルを非表示にします。
     * 
     * エラーが発生した場合は親コンポーネントにエラーメッセージを送信します。
     */
    const deleteUser = async () => {
        if (selectedUserId.value === null) return;
        emit('clear-errors');
        if (isLoading) isLoading.value = true;

        try {
            await usersStore.deleteUser(selectedUserId.value);
            datas.value = datas.value.filter(user => user.id !== selectedUserId.value);
            isConfirmModalVisible.value = false;
            
            // メッセージを表示
            messageStore.showMessage('ユーザーが削除されました。', '削除完了');
        } catch (error) {
            console.error('ユーザー削除エラー:', error);
            emit('error', 'ユーザーの削除に失敗しました。');
        } finally {
            if (isLoading) isLoading.value = false;
        }
    };

    // コンポーネントがマウントされた後に初期化処理を実行
    onMounted(() => {
        initialize();
    });
</script>

<style scoped>
    .user_content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .user_content .right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user_content .id { margin-right: 10px; }
    .user_content .name {
        margin-top: 10px;
        font-size: 20px;
    }
</style>
