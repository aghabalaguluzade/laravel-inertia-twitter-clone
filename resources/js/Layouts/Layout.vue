<template>
    <div class="container flex mx-auto">
        <TwitLeftSide/>
        <slot />
    </div>
</template>

<script setup>
    import TwitLeftSide from "../Components/TwitLeftSide.vue";
</script>