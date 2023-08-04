<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<script>
    import { page } from "@inertiajs/svelte";
</script>

<div
    class="w-full flex h-screen lg:flex-row gap-2 md:flex-col sm:flex-col flex-col justify-center items-center px-8"
>
    <h2 class="text-4xl font-bold mb-2 text-black-50">
        Bienvenue Dans L'espace De Gestion InovaServices
    </h2>
    <div class="">
        <img src={$page.props.src} alt="home icon" />
    </div>
</div>
