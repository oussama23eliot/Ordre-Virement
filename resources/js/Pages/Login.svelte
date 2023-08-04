<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<script>
    import {
        Card,
        Button,
        Label,
        Input,
        Checkbox,
        Spinner,
    } from "flowbite-svelte";
    import { useForm } from "@inertiajs/svelte";
    import { addToast } from "./Toast/store";
    import { page } from "@inertiajs/svelte";
    import { beforeUpdate } from "svelte";
    const handleToast = () => {
        if ($page.props.flash.message || $page.props.flash.error) {
            addToast({
                message: $page.props.flash.message || $page.props.flash.error,
                type: $page.props.flash.message ? "success" : "error",
                dismissable: true,
                timeout: 2000,
            });
        }
    };
    let loader = false;
    let form = useForm({
        email: "",
        password: "",
    });
    beforeUpdate(() => {
        if ($form.errors.password) loader = false;
    });

    function submit() {
        loader = true;
        console.log($form);
        $form.post("/login", {
            onSuccess: () => {
                handleToast();
                loader = false;
                $form.reset();
            },
            onError: () => {
                handleToast();
            },
        });
    }
</script>

<div class="h-screen w-full">
    <Card class="mx-auto">
        <form class="flex flex-col space-y-6" on:submit|preventDefault={submit}>
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                Se Connecter à La Platform
            </h3>
            <Label class="space-y-2">
                <span>Email</span>
                {#if $form.errors.email}
                    <div
                        class="form-error text-center text-sm font-semibold text-red-500"
                    >
                        {$form.errors.email}
                    </div>
                {/if}
                <Input
                    type="email"
                    name="email"
                    placeholder="exemple@gmail.com"
                    bind:value={$form.email}
                    required
                />
            </Label>
            <Label class="space-y-2">
                <span>Mot de passe</span>
                {#if $form.errors.password}
                    <div
                        class="form-error text-center text-sm font-semibold text-red-500"
                    >
                        {$form.errors.password}
                    </div>
                {/if}
                <Input
                    type="password"
                    name="password"
                    placeholder="•••••"
                    bind:value={$form.password}
                    required
                />
            </Label>
            <div class="flex items-start" />
            <button
                type="submit"
                disabled={$form.processing}
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                {#if loader}
                    <Spinner class="mr-3" size="4" color="blue" />
                {:else}Se Connecter{/if}
            </button>
        </form>
    </Card>
</div>
