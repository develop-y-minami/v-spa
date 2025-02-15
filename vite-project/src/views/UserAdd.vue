<!-- ユーザー登録 -->
<template>
    <div class="page">
        <div class="top_container">
            <button @click="goBack" class="button left_icon gray">
                <span class="material-symbols-outlined">first_page</span>
                <span class="name">戻る</span>
            </button>
            <button class="button left_icon blue">
                <span class="material-symbols-outlined">add</span>
                <span class="name">追加</span>
            </button>
        </div>
        <div class="input_container">
            <div class="row">
                <div class="item">
                    <div class="label required">ユーザー名</div>
                    <div>
                        <input type="text" class="input">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">名前</div>
                    <div>
                        <input type="text" class="input">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">役割</div>
                    <div class="radio_container">
                        <div class="radio">
                            <input type="radio" id="user" name="roles" value="0" checked />
                            <label for="user">一般</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="admin" name="roles" value="1" />
                            <label for="admin">管理者</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label">メールアドレス</div>
                    <div>
                        <input type="mail" class="input" style="width: 500px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineEmits } from 'vue';
    import { useRouter } from 'vue-router';

    // ページ名
    const PAGE_NAME = 'ユーザー追加';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'add';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // 親コンポーネントにデータを送信
    emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });

    // ルーターのインスタンスを取得
    const router = useRouter();

    // 戻るボタンクリック時のイベントを定義
    const goBack = () => {
        // 前ページへ戻る
        router.back();
    };
</script>

<style scoped>
    /* ページ上部のコンテナー */
    .top_container {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
    }

    /* 入力用のコンテナー */
    .input_container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 15px;
    }
    /* 入力用のコンテナーの行内の入力項目を内包するコンテナー */
    .input_container .row .item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* ラジオボタン表示用のコンテナー */
    .radio_container {
        display: flex;
        align-items: center;
        gap: 15px;
    }
</style>