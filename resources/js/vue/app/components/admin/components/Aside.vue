<template>
    <div class="aside">
        <a class="aside-top" href="/">Logo</a>
        <nav class="aside__nav">
            <a class="aside__link" href="">
                <svg
                    fill="#000000"
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 28.145 28.145"
                >
                    <circle cx="9.026" cy="22.371" r="2.086" />
                    <circle cx="25.016" cy="22.371" r="2.086" />
                    <path
                        d="M28.145,7.746c0-0.033-0.016-0.061-0.018-0.094c-0.008-0.071-0.021-0.137-0.041-0.203
			c-0.021-0.064-0.043-0.125-0.072-0.183c-0.031-0.059-0.067-0.109-0.109-0.161c-0.042-0.054-0.086-0.102-0.139-0.146
			c-0.049-0.042-0.101-0.074-0.157-0.106c-0.063-0.035-0.125-0.064-0.195-0.087c-0.03-0.01-0.054-0.031-0.085-0.038
			c-0.04-0.009-0.076,0.001-0.115-0.002c-0.039-0.003-0.072-0.022-0.111-0.022L6.939,6.701c-0.015,0-0.027,0.008-0.042,0.009
			L6.213,4.432C6.081,3.991,5.674,3.688,5.214,3.688H1.043C0.467,3.688,0,4.155,0,4.731c0,0.576,0.467,1.043,1.043,1.043h3.396
			l3.949,13.162c0.132,0.441,0.539,0.742,0.999,0.742h15.294c0.49,0,0.912-0.338,1.019-0.816l2.42-10.888
			c0.009-0.038-0.002-0.075,0.002-0.113C28.127,7.821,28.145,7.786,28.145,7.746z M23.846,17.592H10.163L7.521,8.786l18.281,0.003
			L23.846,17.592z"
                    />
                </svg>
                <span>Товары</span>
            </a>
            <a
                class="aside__link"
                href="/"
            >
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M18 6H7V5h11zm0 2H7v1h11zm0 3H7v1h11zm-4 4h4v-1h-4zm0 3h3v-1h-3zm-2 2H7v-6h5zm-1-5H8v4h3zm10 8H4V2h17zM20 3H5v19h15z"
                    />
                    <path fill="none" d="M0 0h24v24H0z" />
                </svg>
                <span>Посты</span>
            </a>
            <a class="aside__link" href="">
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 21 21"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g
                        fill="none"
                        fill-rule="evenodd"
                        stroke="#000000"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        transform="translate(4 3)"
                    >
                        <path
                            d="m11.5.5h-7c-1.1045695 0-2 .8954305-2 2v9c0 1.1045695.8954305 2 2 2h7c1.1045695 0 2-.8954305 2-2v-9c0-1.1045695-.8954305-2-2-2z"
                        />
                        <path
                            d="m2.5 2.5c-1.1045695 0-2 .8954305-2 2v8c0 1.6568542 1.34314575 3 3 3h6c1.1045695 0 2-.8954305 2-2"
                        />
                    </g>
                </svg>
                <span>Страницы</span>
            </a>
        </nav>
    </div>
</template>

<style lang="scss">
.aside {
    background-color: rgb(var(--color-white));
    position: relative;
    z-index: 1;

    // a {
    //     color: #fff;
    // }

    &-top {
        background-color: rgb(var(--color-blue-light));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: 0.05rem;
        margin-bottom: 1.25rem;
        height: 3.5rem;
    }

    &__nav {
        display: flex;
        flex-direction: column;
        row-gap: 1.25rem;
        padding: 0 2.5rem;
    }

    &__link {
        display: inline-flex;
        align-items: center;
        column-gap: 0.25rem;
    }
}
</style>
