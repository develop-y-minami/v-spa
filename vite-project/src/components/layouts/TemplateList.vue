<!-- 一覧表示用のテンプレート -->
<template>
    <div class="template_list">
        <div class="list_container">
            <div class="top">
                <div class="left">
                    <slot name="listTopLeft"></slot>
                </div>
                <div class="right">
                    <slot name="listTopRight"></slot>
                </div>
            </div>
            <div class="list_wrap">
                <slot name="list"></slot>
            </div>
        </div>

        <div class="sub_menu_container_wrap">
            <div class="sub_menu_container">

            </div>
        </div>
    </div>
</template>