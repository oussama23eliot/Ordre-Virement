<script>
    import { Sidebar, SidebarWrapper, SidebarGroup } from "flowbite-svelte";
    import { inertia, Link, useForm } from "@inertiajs/svelte";
    import { slide } from "svelte/transition";
    import { addToast } from "./Toast/store";
    import { page } from "@inertiajs/svelte";
    import SmallModal from "./SmallModal.svelte";

    export let open = false;
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
    let form = useForm({
        user: $page.props.loggedin,
    });
    function submit() {
        $form.get("/logout", {
            onSuccess: () => {
                handleToast();
            },
            onError: () => {
                handleToast();
            },
        });
    }
</script>

<aside
    transition:slide
    class="w-full sm:w-1/4 md:w-1/5 bg-gray-100 z-1"
    class:open
>
    <div class="sticky top-0 w-full bg-transparent">
        <Sidebar class="w-full h-full px-0">
            <SidebarWrapper class=" bg-transparent px-0 h-screen">
                <SidebarGroup>
                    <li
                        class="w-full p-3 hover:bg-white focus-within:bg-white rounded-full hover:duration-500"
                    >
                        <Link
                            href="/parametres"
                            class="flex flex-row gap-3 w-full font-semibold text-lg "
                            preserveScroll
                            preserveState
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
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
                                />
                            </svg>

                            Paramètres</Link
                        >
                    </li>

                    <li
                        class="w-full p-3 hover:bg-white focus-within:bg-white rounded-full hover:duration-500"
                    >
                        <Link
                            href="/virements"
                            class="flex flex-row gap-3 w-full font-semibold text-lg "
                            preserveScroll
                            preserveState
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
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                />
                            </svg>
                            Virements</Link
                        >
                    </li>
                    <li
                        class="w-full p-3 absolute left-0 bottom-0 hover:bg-white focus-within:bg-white rounded-full hover:duration-500"
                    >
                        <SmallModal operation={"logout"} />
                    </li>
                </SidebarGroup>
            </SidebarWrapper>
        </Sidebar>
    </div>
</aside>

<style>
    aside {
        display: none;
        transition: right 1s ease-in-out;
    }

    .open {
        display: block;
    }
</style>
