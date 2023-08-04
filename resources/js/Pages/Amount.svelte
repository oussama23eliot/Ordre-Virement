<script>
    import { Select, Input } from "flowbite-svelte";
    import { handleMoneyInput } from "./utils/moneyFotmatter";
    export let montant = 0.0;
    export let total = montant;

    function handleInput2() {
        let num = montant.replace(/[^0-9.]/g, "");
        let num2 = parseFloat(num);
        montant = num2.toLocaleString("en-US", {
            currencySign: "standard",
            style: "currency",
            currency: "MAD",
            minimumFractionDigits: 2,
        });
        total = handleMoneyInput(montant);
    }
</script>

<div class="flex flex-col">
    <label
        for="montant"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left"
        >Montant</label
    >
    <div class="flex flex-row">
        <Input
            name="montant"
            type="currency"
            class=" border-r-0 rounded-r-none"
            bind:value={montant}
            on:change={handleInput2}
            required
        />
        <div
            class="flex-shrink-0 rounded-l-none w-1/4 items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-r-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
        >
            <p class="block items-center">MAD</p>
        </div>
    </div>
</div>
