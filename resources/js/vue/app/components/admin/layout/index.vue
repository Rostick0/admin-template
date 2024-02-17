<template>
    <div class="admin">
        <Aside />
        <div class="admin__content">
            <Header />
            <main class="admin__main"><v-slot></v-slot></main>
        </div>
    </div>
</template>

<script setup>
import Aside from "../components/Aside.vue";
import Header from "./Header.vue";
</script>

<style lang="scss" scoped>
.admin {
    display: flex;
    min-height: 100vh;

    &__content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    &__main {
        background-color: rgb(var(--color-grey-light));
        flex-grow: 1;
        padding: 1.25rem;
        overflow: auto;
    }
}
</style>
