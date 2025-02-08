<!-- 共通ヘッダー -->
<template>
    <header class="header">
        <div class="title_container">
            <div class="title">
                <!-- ページアイコン -->
                <span class="material-symbols-outlined icon color-violet">{{ pageIconName }}</span>
                <!-- ページ名 -->
                <span class="name">{{ pageName }}</span>
            </div>
        </div>
        <div class="container">

        </div>
    </header>
</template>

<script setup lang="ts">
    // 親コンポーネントからのデータを受信
    defineProps<{
        pageName: string;
        pageIconName: string;
    }>();

</script>

<style scoped>
    /***************************************************************
    *   ヘッダー
    ***************************************************************/
    .header {
        display: flex;
        align-items: center;
        padding: 15px 0px;
    }

    /* ヘッダー：タイトル右のコンテナー */
    .header > .container {
        flex: 1;
    }

    /* タイトル */
    .title {
        display: flex;
        align-items: center;
        padding: 10px 15px;
    }
    /* タイトルのアイコンと名称の間隔を調整 */
    .title .icon { margin-right: 15px; }
    /* タイトルのアイコンと名称を上下中央寄せに設定 */
    .title .name { margin-top: 5px; }
</style>