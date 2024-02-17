<template>
    <button class="btn" v-bind="$attrs"><v-slot></v-slot></button>
</template>

<script lang="ts" setup></script>

<style>
.btn {
    background-color: rgb(var(--color-blue-light));
    color: rgb(var(--color-white));
    border-radius: 0.625rem;
    transition: 0.3s;
    padding: 0.5rem 1rem;
}
</style>
