<script lang="ts">
    import Toast from "./toasty.svelte";

    import { dismissToast, toasts } from "./store.js";
</script>

{#if $toasts}
    <section class="sec">
        {#each $toasts as toast (toast.id)}
            <Toast
                type={toast.type}
                dismissible={toast.dismissible}
                on:dismiss={() => dismissToast(toast.id)}>{toast.message}</Toast
            >
        {/each}
    </section>
{/if}

<style lang="postcss">
    .sec {
        width: 100%;
        display: flex;
        margin-top: 1rem;
        justify-content: center;
        flex-direction: column;
        z-index: 1000;
    }
</style>
