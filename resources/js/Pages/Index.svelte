<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<script>
    import Amount from "./Amount.svelte";
    import {
        Spinner,
        Button,
        Modal,
        Label,
        Input,
        Badge,
    } from "flowbite-svelte";
    import { slide } from "svelte/transition";
    import { useForm } from "@inertiajs/svelte";
    import { page } from "@inertiajs/svelte";
    import { addToast } from "./Toast/store";
    import { banques, status } from "./utils/helperData";
    import { Dropdown, Chevron, DropdownItem } from "flowbite-svelte";

    export let updateData = {};

    export let updating;
    let selected = {
        name: updateData.nom_banque,
        src: banques.filter((item) => item.name == updateData.nom_banque)[0]
            ?.src,
    };
    let formModal = false;
    let loader = false;

    let benifTemporaire =
        (updateData.beneficiaire_id && updating) || !updating ? false : true;
    let inputRib = updateData.rib;

    let form = useForm({
        beneficiaire_id: updateData.beneficiaire_id || null,
        nom_banque: selected.name || null,
        nom_beneficiaire: updateData.nom_beneficiaire || "",
        rib: updateData.rib || "",
        code_swift: updateData.code_swift || "",
        adresse_agence: updateData.adresse_agence || "",
        date: updateData.date || null,
        status: updateData.status || null,
        montant: updateData.montant || 0.0,
        description: updateData.description || "",
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
        if (updating) {
            $form.put(`/virements/${updateData.id}`, {
                onSuccess: () => {
                    handleToast();
                    loader = false;
                    formModal = false;
                },
                onError: () => {
                    handleToast();
                    loader = false;
                },
            });
        } else {
            $form.post("/virements", {
                onSuccess: () => {
                    handleToast();
                    loader = false;
                    formModal = false;
                },
                onError: () => {
                    handleToast();
                    loader = false;
                },
            });
        }
    }
    $: l = inputRib;
    function check(event) {
        if (l.toString().length <= 24) {
            console.log(l.toString(), $form.rib);
            $form.rib = l.toString();
        }
        event.target.value = $form.rib;
    }
    $: btnContent = updating ? "Modifier" : "Ajouter";
</script>

<div class="">
    <div class=" ">
        {#if !updating}
            <Button
                on:click={() => (formModal = true)}
                class="flex flex-row gap-1 focus:ring-0 text-orange-500  border-solid float-right hover:underline p-4 bg-transparent"
            >
                <svg
                    class="w-3 h-3 my-auto text-orange-500 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 18 18"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 1v16M1 9h16"
                    />
                </svg>Nouveau Ordre de Virement</Button
            >
        {:else}
            <Button
                on:click={() => (formModal = true)}
                class="flex flex-row p-0 focus:ring-0 text-black  border-solid  hover:underline bg-transparent"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                </svg></Button
            >
        {/if}

        <Modal bind:open={formModal} size="xs" class="w-full">
            <form
                class="flex flex-col space-y-6 formy"
                on:submit|preventDefault={submit}
            >
                <h3
                    class="mb-4 text-xl text-center font-medium text-gray-900 dark:text-white"
                >
                    {#if updating}Modifier Ordre de Virement{:else}Ajouter Ordre
                        de Virement{/if}
                </h3>
                <div
                    class={(updateData.beneficiaire_id && updating) || !updating
                        ? "block"
                        : "hidden"}
                >
                    <Label
                        for="select"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left"
                        >Bénificiare</Label
                    >
                    {#if $form.errors.beneficiaire_id}
                        <div
                            class="form-error text-center text-sm font-semibold text-red-500"
                        >
                            {$form.errors.beneficiaire_id}
                        </div>
                    {/if}
                    <select
                        type="select"
                        name="select"
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required={!benifTemporaire}
                        on:click={() => {
                            benifTemporaire = false;
                        }}
                        bind:value={$form.beneficiaire_id}
                    >
                        {#each $page.props.fournisseurs as { id, nom_beneficiaire }}
                            <option
                                value={id}
                                selected={$form.beneficiaire_id == id}
                                >{nom_beneficiaire}</option
                            >
                        {/each}
                    </select>
                </div>
                <div class="block text-right w-full">
                    <button
                        type="button"
                        on:click={() => {
                            benifTemporaire = !benifTemporaire;
                            $form.beneficiaire_id = null;
                        }}
                        class="flex {updating
                            ? 'hidden'
                            : 'block'} flex-row space-x-1 align-right float-right justify-right text-sm text-blue-700 hover:underline dark:text-blue-500 text-right"
                    >
                        <svg
                            class="w-3 h-3 my-auto text-blue-700 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 18 18"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 1v16M1 9h16"
                            />
                        </svg>
                        <span
                            >{benifTemporaire
                                ? "Choisir Bénificiares existants"
                                : "Ajouter Nouveau Bénificiare "}</span
                        >
                    </button>
                </div>
                {#if updating}
                    <div class="text-left">
                        <Label for="banque" class="mb-2 ">Status</Label>
                        {#if $form.errors.status}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.status}
                            </div>
                        {/if}
                        <Button
                            class="w-full text-black focus:ring-0 flex flex-row justify-between border border-gray-300 "
                        >
                            <Badge
                                color={status.filter(
                                    (item) => item.name == $form.status
                                )[0]?.color}>{$form.status}</Badge
                            >
                            <Chevron class="float-right " /></Button
                        >
                        <Dropdown
                            class="w-50  items-left z-2000 overflow-y-auto py-1 h-30 "
                            >{#each status as { name, color }}
                                <DropdownItem
                                    class=" text-base flex flex-row pt-auto font-semibold gap-2 "
                                    on:click={() => {
                                        $form.status = name;
                                    }}
                                >
                                    <Badge {color}>{name}</Badge>
                                </DropdownItem>
                            {/each}
                        </Dropdown>
                    </div>
                {/if}
                {#if benifTemporaire}
                    <div transition:slide>
                        <Label for="nom" class="mb-2 text-orange-500 text-left"
                            >Nom du Bénéficiaire</Label
                        >
                        {#if $form.errors.nom_beneficiaire}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.nom_beneficiaire}
                            </div>
                        {/if}
                        <Input
                            type="text"
                            name="nom"
                            bind:value={$form.nom_beneficiaire}
                            class="border-orange-500"
                            placeholder="nom du bénéficiaire..."
                            required
                        />
                    </div>

                    <div transition:slide class="text-left">
                        <Label for="banque" class="mb-2 text-orange-500"
                            >Nom Banque</Label
                        >
                        {#if $form.errors.nom_banque}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.nom_banque}
                            </div>
                        {/if}
                        <Button
                            class="w-full text-black focus:ring-0 flex flex-row justify-between  border-orange-500 border"
                            ><img
                                transition:slide
                                src={selected.src}
                                hidden={!selected.src}
                                height="50px"
                                width="70px"
                                alt="logo banque"
                            />
                            <p transition:slide class="text-gray-500">
                                {selected.name || "choisir une banque..."}
                            </p>
                            <Chevron class="float-right" /></Button
                        >
                        <Dropdown
                            class="w-50  items-center z-2000 overflow-y-auto py-1 h-48 "
                            open={!selected}
                            >{#each banques as banque}
                                <DropdownItem
                                    class=" text-base flex flex-row pt-auto font-semibold gap-2 "
                                    on:click={() => {
                                        selected = banque;
                                        $form.nom_banque = banque.name;
                                    }}
                                >
                                    <img
                                        src={banque.src}
                                        height="50px"
                                        width="70px"
                                        alt="hjjh"
                                    />
                                    <p class="my-auto">{banque.name}</p>
                                </DropdownItem>
                            {/each}
                        </Dropdown>
                    </div>
                    <div transition:slide class="text-left">
                        <Label for="rib" class="mb-2 text-orange-500">rib</Label
                        >
                        {#if $form.errors.rib}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.rib}
                            </div>
                        {/if}
                        <Input
                            type="number"
                            name="rib"
                            bind:value={inputRib}
                            class="border-orange-500"
                            placeholder="rib code..."
                            on:input={check}
                            min="0"
                            required
                        />
                    </div>
                    <div transition:slide class="text-left">
                        <Label for="code_swift" class="mb-2 text-orange-500"
                            >Code Swift</Label
                        >
                        {#if $form.errors.code_swift}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.code_swift}
                            </div>
                        {/if}
                        <Input
                            type="text"
                            name="code_swift"
                            bind:value={$form.code_swift}
                            class="border-orange-500"
                            placeholder="code swift..."
                            maxlength="11"
                            required
                        />
                    </div>
                    <div transition:slide class="text-left">
                        <Label for="adresse" class="mb-2 text-orange-500"
                            >Adresse</Label
                        >
                        {#if $form.errors.adresse_agence}
                            <div
                                class="form-error text-center text-sm font-semibold text-red-500"
                            >
                                {$form.errors.adresse_agence}
                            </div>
                        {/if}
                        <Input
                            type="text"
                            name="adresse"
                            bind:value={$form.adresse_agence}
                            class="border-orange-500"
                            placeholder="code swift..."
                            required
                        />
                    </div>
                {/if}
                <Amount bind:total={$form.montant} montant={$form.montant} />
                <div>
                    <Label
                        for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left"
                        >Date</Label
                    >
                    {#if $form.errors.date}
                        <div
                            class="form-error text-center text-sm font-semibold text-red-500"
                        >
                            {$form.errors.date}
                        </div>
                    {/if}
                    <input
                        type="date"
                        name="date"
                        id="date"
                        placeholder="YYYY-MM-DD"
                        bind:value={$form.date}
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    />
                </div>
                <div>
                    {#if $form.errors.description}
                        <div
                            class="form-error text-center text-sm font-semibold text-red-500"
                        >
                            {$form.errors.description}
                        </div>
                    {/if}
                    <Label
                        for="detail"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left"
                        >Description</Label
                    >
                    <textarea
                        name="detail"
                        id=""
                        bind:value={$form.description}
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    />
                </div>

                <button
                    type="submit"
                    disabled={$form.processing}
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    {#if loader}
                        <Spinner class="mr-3" size="4" color="blue" />
                    {:else}{btnContent}{/if}
                </button>
            </form>
        </Modal>
    </div>
</div>
