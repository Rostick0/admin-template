<template>
    <input class="input" v-bind="$attrs" />
</template>

<script setup></script>

<style lang="scss" scoped>
.input {
    border: 2px solid rgb(var(--color-blue-light));
    border-radius: 0.625rem;
    font-size: 1rem;
    transition: 0.3s;
    padding: 0.75rem 1rem;

    &:focus {
        box-shadow: 0 0 1.25rem -0.25rem rgba(var(--color-blue), 0.5);
    }
}
</style>
