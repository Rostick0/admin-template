<template>
    <label class="control"><v-slot></v-slot></label>
</template>

<script setup></script>

<style lang="scss">
.control {
    display: inline-flex;
    flex-direction: column;
    row-gap: 0.25rem;

    &._error {
        color: rgb(var(--color-red));

        /* .control__input{
            border-color: rgb(var(--color-red));
        } */
    }
}
</style>
