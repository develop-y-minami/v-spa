<template>
    <div class="loading_overlay overlay">
        <div class="loader"></div>
    </div>
</template>

<style scoped>
    /***************************************************************
    *   ローディングインジケーター
    ***************************************************************/
    .loading_overlay {
        position: fixed;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100dvw;
        height: 100dvh;
    }

    .loader {
        width: 50px;
        height: 50px;
        border: 5px solid #e9b0ff;
        border-top-color: #b125e9;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>