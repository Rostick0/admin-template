<template>
    <form class="form">
        <v-slot></v-slot>
    </form>
</template>

<style lang="scss" scoped>
.form {
    background-color: rgb(var(--color-white));
    border-radius: 0.625rem;
    padding: 2rem;

    &__inputs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
        margin-bottom: 2rem;
    }
}
</style>
