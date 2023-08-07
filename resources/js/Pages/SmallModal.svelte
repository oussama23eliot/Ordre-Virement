<script>
    import { useForm } from "@inertiajs/svelte";
    import { Button, Modal, Spinner } from "flowbite-svelte";
    import { addToast } from "./Toast/store";

    import { page } from "@inertiajs/svelte";

    export let popupModal = false;
    export let data;
    export let operation;

    let loader = false;
    let form = useForm({
        id: data || operation,
    });
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
    function submit() {
        loader = true;
        if (operation == "logout") {
            $form.post(`/logout`, {
                onSuccess: () => {
                    handleToast();
                    loader = false;
                    popupModal = false;
                },
                onError: () => {
                    loader = false;
                    handleToast();
                },
            });
        } else {
            $form.delete(`/virements/${data}`, {
                onSuccess: () => {
                    handleToast();

                    loader = false;
                    popupModal = false;
                },
                onError: () => {
                    loader = false;
                    handleToast();
                },
            });
        }
    }
</script>

{#if !operation}
<Button on:click={() => (popupModal = true)} class="p-0">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6 text-black focus:ring-0"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
        />
    </svg>
</Button>
{/if}

<Modal bind:open={popupModal} class="z-2000" size="xs" autoclose>
    <div class="text-center">
        <svg
            aria-hidden="true"
            class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            ><path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            /></svg
        >
        <h3 class="mb-5 text-lg font-normal text-gray-700 dark:text-gray-400">
            {operation ? 'etes-vous sure de se déconnecter ?':'etes-vous sure de supprimer cet ordre de virement ?'}
        </h3>
        <Button on:click={submit} type="submit" color={operation ?"red":"blue"} class="mr-2"
            >{#if loader}
                <Spinner class="mr-3" size="4" color="blue"/>
            {:else}Oui, je suis sure{/if}</Button
        >
        <Button type="reset" color="alternative">Non, revenir</Button>
    </div>
</Modal>
