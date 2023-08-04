<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";
    import { fade, slide } from "svelte/transition";
    import { page } from "@inertiajs/svelte";

    import {
        Label,
        Dropdown,
        DropdownItem,
        Button,
        Input,
        Badge,
        Chevron,
    } from "flowbite-svelte";
    import { addToast } from "./Toast/store";
    import { banques } from "./utils/helperData";

    export let data;

    let selected = {
        name: data["nom_banque"],
        src: banques.filter((item) => item.name == data["nom_banque"])[0]?.src,
    };
    let inputRib = data["rib"];

    let _nom_societe = false;
    let _adresse_societe = false;
    let _numero_societe = false;
    let _email_societe = false;
    let _nom_banque = false;
    let _adresse_banque = false;
    let _rib = false;
    let _code_swift = false;
    $: showSubmit =
        _nom_societe ||
        _adresse_societe ||
        _numero_societe ||
        _email_societe ||
        _nom_banque ||
        _adresse_banque ||
        _rib ||
        _code_swift;
    let form = useForm({
        nom_societe: data["nom_societe"],
        adresse_societe: data["adresse_societe"],
        numero_societe: data["numero_societe"],
        email_societe: data["email_societe"],

        nom_banque: data["nom_banque"],
        adresse_banque: data["adresse_banque"],
        rib: data["rib"],
        code_swift: data["code_swift"] || "",
    });

    const handleToast = () => {
        if (
            $page.props.flash.message ||
            $page.props.flash.error ||
            $form.hasErrors
        ) {
            addToast({
                message:
                    $page.props.flash.message ||
                    $page.props.flash.error ||
                    Object.values($form.errors),
                type: $page.props.flash.message ? "success" : "error",
                dismissable: true,
                timeout: 2000,
            });
        }
    };

    function submit() {
        showSubmit = false;
        $form.put("/parametres", {
            onSuccess: () => {
                handleToast();
            },
            onError: () => {
                console.log($form);
                showSubmit = true;
                handleToast();
            },
        });
    }
    $: l = inputRib || "";
    function check(event) {
        if (l.toString().length <= 24) {
            $form.rib = l.toString() || null;
        }
        event.target.value = $form.rib;
        if ($form.rib != data["rib"]) _rib = true;
        else _rib = false;
    }
</script>

<form
    class="container h-screen w-auto flex items-left justify-left flex-col gap-2 p-4 bg-primary mx-auto"
    on:submit|preventDefault={submit}
>
    <div class="text-3xl w-full font-semibold">Profile de la Societé</div>
    <hr />
    {#if showSubmit}
        <p
            transition:slide
            class="absolute z-200 top-20 text-yellow-400 font-slim text-sm"
        >
            {"*Vous avez ajouter des modification qu'il faut sauvgarder"}
        </p>
    {/if}
    <div class="flex flex-row gap-4 w-full mt-4">
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Nom De Societé</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
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
                        d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"
                    />
                </svg>

                <Input
                    id="default-input"
                    class="border-transparent bg-transparent pl-1"
                    placeholder="Default input"
                    on:input={() => {
                        if ($form.nom_societe != data["nom_societe"])
                            _nom_societe = true;
                        else _nom_societe = false;
                    }}
                    bind:value={$form.nom_societe}
                />
            </div>
        </div>
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Adresse De Sociéte</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
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
                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"
                    />
                </svg>

                <Input
                    id="default-input"
                    class="border-transparent bg-transparent pl-1"
                    placeholder="Default input"
                    on:input={() => {
                        if ($form.adresse_societe != data["adresse_societe"])
                            _adresse_societe = true;
                        else _adresse_societe = false;
                    }}
                    bind:value={$form.adresse_societe}
                />
            </div>
        </div>
    </div>
    <div class="flex flex-row gap-4 w-full mt-4">
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Numéro Téléphone</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"
                    />
                </svg>
                <Input
                    type="number"
                    id="default-input"
                    class="border-transparent bg-transparent pl-1"
                    placeholder="Default input"
                    on:input={() => {
                        if ($form.numero_societe != data["numero_societe"])
                            _numero_societe = true;
                        else _numero_societe = false;
                    }}
                    bind:value={$form.numero_societe}
                />
            </div>
        </div>
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Adresse Email</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25"
                    />
                </svg>

                <Input
                    type="email"
                    id="default-input"
                    class="border-transparent bg-transparent pl-1"
                    placeholder="Default input"
                    on:input={() => {
                        console.log($form.email_societe, data["email_societe"]);
                        if ($form.email_societe != data["email_societe"])
                            _email_societe = true;
                        else _email_societe = false;
                    }}
                    bind:value={$form.email_societe}
                />
            </div>
        </div>
    </div>
    <div class="text-3xl w-full font-semibold mt-16">Informations Bancaire</div>
    <hr />
    <div class="flex flex-row gap-4 w-full mb-4 mt-4">
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Nom De Banque</Label
            >
            <Button
                class="w-full text-black focus:ring-0 flex flex-row justify-between focus:border-blue-500  border-transparent border-2"
                ><img
                    transition:slide
                    src={selected.src}
                    hidden={!selected.src}
                    height="50px"
                    width="70px"
                    alt="logo banque"
                />
                <p transition:slide class="text-black-500">
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
                            if ($form.nom_banque != data["nom_banque"])
                                _nom_banque = true;
                            else _nom_banque = false;
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
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Adresse de L'Agence Bancaire</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
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
                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"
                    />
                </svg>

                <Input
                    type="text"
                    id="default-input"
                    class="border-transparent bg-transparent pl-1"
                    placeholder="Default input"
                    on:input={() => {
                        if ($form.adresse_banque != data["adresse_banque"])
                            _adresse_banque = true;
                        else _adresse_banque = false;
                    }}
                    bind:value={$form.adresse_banque}
                />
            </div>
        </div>
    </div>

    <div class="flex flex-row gap-4 w-full mb-4">
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Numéro du compte Bancaire</Label
            >
            {#if $form.errors.rib}
                <div
                    class="form-error text-center text-sm font-semibold text-red-500"
                >
                    {$form.errors.rib}
                </div>
            {/if}
            <div class="flex flex-row gap-1 items-center justify-center">
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
                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"
                    />
                </svg>

                <Input
                    type="number"
                    name="rib"
                    bind:value={inputRib}
                    class="border-transparent  bg-transparent border-2 focus:ring-0 focus:{$form
                        .rib.length == 24
                        ? 'border-green-500'
                        : ''} "
                    pl-1
                    placeholder="rib code..."
                    on:input={check}
                    min="0"
                />
            </div>
        </div>
        <div class="w-full">
            <Label for="default-input" class="block mb-2 font-bold"
                >Code Swift</Label
            >
            <div class="flex flex-row gap-1 items-center justify-center">
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
                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"
                    />
                </svg>

                <Input
                    type="text"
                    id="default-input"
                    class="border-transparent bg-transparent pl-1 border-2 focus:ring-0 focus:{$form
                        .code_swift.length >= 8
                        ? 'border-green-500'
                        : ''} "
                    maxlength="11"
                    placeholder="Default input"
                    bind:value={$form.code_swift}
                    on:input={() => {
                        if ($form.code_swift != data["code_swift"])
                            _code_swift = true;
                        else _code_swift = false;
                    }}
                />
            </div>
        </div>
    </div>
    <div class="w-full block">
        {#if showSubmit}
            <button
                transition:fade
                type="submit"
                color="blue"
                class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >Sauvgarder</button
            >
        {/if}
    </div>
</form>
