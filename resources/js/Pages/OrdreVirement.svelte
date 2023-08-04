<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<script>
    import Index from "./Index.svelte";
    import SmallModal from "./SmallModal.svelte";
    import {
        Table,
        TableBody,
        TableBodyCell,
        TableBodyRow,
        TableHead,
        TableHeadCell,
        Badge,
        Tooltip,
    } from "flowbite-svelte";
    import { status } from "./utils/helperData";
    import { page } from "@inertiajs/svelte";
    import { handleInput2 } from "./utils/moneyFotmatter";
</script>

<div
    class="container mx-auto z-0 mb-10 flex flex-col w-full h-fit min-h-screen px-4 items-center space-y-3"
>
    <h1 class="text-3xl w-full font-semibold">Ordres de Virements</h1>
    <div class="text-lg w-full text-right hover:text-undeline">
        <Index />
    </div>
    <div class="w-full mx-auto">
        <Table hoverable={true} shadow>
            <TableHead>
                <TableHeadCell class="bg-gray-100 text-center">ID</TableHeadCell
                >
                <TableHeadCell>date</TableHeadCell>
                <TableHeadCell>Nom du Bénéficiaire</TableHeadCell>
                <TableHeadCell>Description</TableHeadCell>
                <TableHeadCell>Montant</TableHeadCell>
                <TableHeadCell>status</TableHeadCell>
                <TableHeadCell>Actions</TableHeadCell>
            </TableHead>
            <TableBody class="divide-y">
                {#each $page.props.orders as order (order.id)}
                    <TableBodyRow>
                        <TableBodyCell class="bg-gray-100 text-center"
                            >{order.id}</TableBodyCell
                        >
                        <TableBodyCell>{order.date}</TableBodyCell>
                        <TableBodyCell>{order.nom_beneficiaire}</TableBodyCell>
                        <TableBodyCell
                            class="max-w-xs overflow-hidden truncate capitalize"
                        >
                            {order.description}
                        </TableBodyCell>
                        <TableBodyCell
                            >{handleInput2(order.montant)}</TableBodyCell
                        >

                        <TableBodyCell
                            ><Badge
                                color={status.filter(
                                    (item) => item.name == order.status
                                )[0]?.color}
                                class=" text-center">{order.status}</Badge
                            >
                        </TableBodyCell>

                        <TableBodyCell>
                            <div
                                class="flex flex-row gap-3 align-middle items-center justify-center"
                            >
                                <button
                                    class="font-medium text-primary-600 focus:ring-0 hover:underline dark:text-primary-500"
                                >
                                    <Index updateData={order} updating={true} />
                                    <Tooltip>Modifier</Tooltip>
                                </button>
                                <button
                                    class="font-medium text-primary-600 focus:ring-0 hover:underline flex items-center dark:text-primary-500"
                                >
                                    <SmallModal data={order.id} />
                                    <Tooltip>Supprimer</Tooltip>
                                </button>
                                <a
                                    href={"/virements/pdf/" + order.id}
                                    target="_blank"
                                    class="font-medium text-primary-600 hover:underline focus:border-0 dark:text-primary-500 focus:ring-0"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 focus:ring-0"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                        />
                                    </svg>
                                    <Tooltip>Générer PDF</Tooltip>
                                </a>
                            </div>
                        </TableBodyCell>
                    </TableBodyRow>
                {/each}
            </TableBody>
        </Table>
    </div>
</div>
