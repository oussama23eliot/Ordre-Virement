<script context="module">
    import { Spinner } from "flowbite-svelte";
</script>

<script>
    import { inertia } from "@inertiajs/svelte";
    import Hamburger from "./Hamburger.svelte";
    import SideBar from "./SideBar.svelte";
    import Toasts from "./Toast/toasts.svelte";
    import { fly, fade } from "svelte/transition";

    import { addToast } from "./Toast/store";
    let sidebar = false;
    import { page } from "@inertiajs/svelte";

    const handleToast = () => {
        if ($page.props.flash.message) {
            addToast({
                message: $page.props.flash.message,
                type: "success",
                dismissable: true,
                timeout: 2000,
            });
        }
    };
    import { router } from "@inertiajs/svelte";
    import { beforeUpdate, onMount } from "svelte";
    beforeUpdate(() => {
        if ($page.component == "Login") sidebar = false;
    });
    let navigating = false;
    router.on("start", () => {
        navigating = true;
    });
    router.on("finish", () => {
        navigating = false;
    });
</script>

<body class="relative bg-white dark:bg-gray-800">
    <div class="wrapper w-full h-screen">
        <div
            class="flex flex-row flex-wrap
    "
        >
            {#if $page.component != "Login"}
                <SideBar bind:open={sidebar} />
            {:else}
                <SideBar open={false} />
            {/if}
            <main
                class="w-full h-fit bg-cover bg-fixed bg-no-repeat
            bg-[url(https://img.freepik.com/free-vector/neumorphic-white-layer-abstract-wallpaper-with-empty-space_1017-44320.jpg?w=900&t=st=1690165055~exp=1690165655~hmac=933315a8382aa3c1fbb0a0a147954e6baf393aaea5327fd2577fa6f8eebc54dd)]
    
             {!sidebar ||
                    'sm:w-3/4 md:w-4/5'} z-40 border-l border-t bg-white shadow-lg"
            >
                <div class="w-full h-full">
                    <nav
                        class=" inset-x-0 top-0 w-full h-[80px] delay-500 px-2"
                    >
                        <div
                            class="h-14 sm:h-20 flex items-center w-full justify-between gap-4 lg:gap-8"
                        >
                            <div class="flex items-center">
                                {#if $page.component != "Login"}
                                    <Hamburger bind:open={sidebar} />
                                {/if}
                                <a
                                    href="/virements"
                                    use:inertia
                                    aria-label="Go to home"
                                    class=" flex flex-row w-full justify-center align-middle"
                                >
                                    <img
                                        src="https://inovaservices.com/img/logo.png"
                                        alt="logo"
                                        style="width: 40%;"
                                    />
                                </a>
                            </div>
                        </div>
                    </nav>
                    <div class="w-full">
                        <Toasts />
                    </div>

                    <div
                        in:fade={{ x: -200, duration: 300, delay: 300 }}
                        out:fade={{ x: 200, duration: 300 }}
                    >
                        {#if navigating}
                            <div
                                transition:fade
                                style="background-color: rgba(0,0,0,0.10);border-color:box-shadow: rgba(0,0,0,0.06)"
                                class="absolute {!sidebar ||
                                    'sm:w-3/4 md:w-4/5'} z-2000 text-3xl flex bg-transparent opacity-1 text-black w-full h-screen items-center justify-center"
                            >
                                <Spinner
                                    size={20}
                                    color="gray"
                                    class="bg-transparent"
                                />
                            </div>
                        {/if}

                        <div
                            in:fade={{ x: -200, duration: 300, delay: 300 }}
                            out:fade={{ x: 200, duration: 300 }}
                        >
                            {#key $page.component}
                                <slot />
                            {/key}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
