<template>
    <div class="delete_user_info">
        <div class="row">
            <div class="label">{{ tableInfos.user.id.name }}</div>
            <div>{{ user?.id?.toString().padStart(tableInfos.user.id.length, '0') }}</div>
        </div>
        <div class="row">
            <div class="label">{{ tableInfos.user.username.name }}</div>
            <div>{{ user?.username }}</div>
        </div>
        <div class="row">
            <div class="label">{{ tableInfos.user.name.name }}</div>
            <div>{{ user?.name }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineProps } from 'vue';
    import { tableInfos } from '../../constants/tableInfos';
    import type { User } from '../../stores/users';

    defineProps<{ user: User | null }>();
</script>

<style scoped>
.delete_user_info {
    margin: 0px 40px;
    margin-bottom: 20px;
}
.delete_user_info .row {
    display: flex;
    align-items: center;
}
.delete_user_info .row div {
    display: flex;
    align-items: center;
    padding: 15px;
}
.delete_user_info .row .label {
    width: 150px;
    background-color: #e8e2fb;
}
</style>
