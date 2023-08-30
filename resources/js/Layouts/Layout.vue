<template>
    <div class="container flex mx-auto">
        <TwitLeftSide/>
        <slot />
    </div>
</template>

<script setup>
    import TwitLeftSide from "../Components/TwitLeftSide.vue";
    import { onMounted } from 'vue';
    import { usePage } from "@inertiajs/vue3";

    const page = usePage();

    onMounted(() => {
        window.Echo.private(`App.Models.User.${page.props.auth.user.id}`)
            .notification((notification) => {
                switch(notification.type) {
                    case 'App\\Notifications\\LikedTweetNotification':
                        page.props.unreadNotifications++;
                        break;
                }
        });
    });

</script>