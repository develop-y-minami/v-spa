<!-- ユーザー一覧 -->
<template>
    <ul class="list">
        <li v-for="data in datas" :key="data.id">
            <a href="" class="content">
                <div class="user_content">
                    <div class="left">
                        <div><span class="id">{{ data.id }}</span><span class="user_name">{{ data.user_name }}</span></div>
                        <div class="name">{{ data.name }}</div>
                    </div>
                    <div class="right">
                        <div class="icon edit">
                            <span class="material-symbols-outlined">edit_document</span>
                        </div>
                        <div class="icon delete">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</template>

<script setup lang="ts">
    import { ref } from 'vue';

    // ユーザー一覧に設定するデータを定義
    const datas = ref([
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
        { id: '000001', user_name: 'y-minami',name: '南　優毅'},
    ]);
</script>

<style scoped>
    /***************************************************************
    *   ユーザー一覧
    ***************************************************************/
    .user_content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    /* アイコンを表示する右のコンテナー */
    .user_content .right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* ID */
    .user_content .id { margin-right: 10px; }
    /* 名前 */
    .user_content .name {
        margin-top: 10px;
        font-size: 20px;
    }
</style>