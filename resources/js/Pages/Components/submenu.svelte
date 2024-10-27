<script>
    import { IconChevronRight } from "@tabler/icons-svelte";
    import { slide } from "svelte/transition";
    import { isSideBarMini } from "../../store";
    import { page, Link } from "@inertiajs/svelte";

    const submenu = $$slots.default;
    export let icon, title, href, active;

    const handleClick = () => {
        if (!submenu) {
            return false;
        }

        active = !active;
    }
    
</script>

<li class="submenu" class:active={active}>
    <Link {href} class={submenu && active?'subdrop':null} on:click={handleClick}> <svelte:component this={icon} /> <span class="capitalize">{title}</span> 
        {#if submenu && !$isSideBarMini}
            <IconChevronRight class='absolute top-3.5 right-3.5 transition-all duration-200{active?" rotate-90":""}' />
        {/if}
    </Link>
    {#if submenu && active && !$isSideBarMini}
        <ul class="block" transition:slide>
            <slot />
        </ul>
    {/if}
</li>