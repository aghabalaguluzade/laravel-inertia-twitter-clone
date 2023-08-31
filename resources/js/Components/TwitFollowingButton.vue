<template>
    <Link :href="`/${$page.props.auth.user.username}/following/${user.id}`" 
    v-if="user.following" 
    preserve-scroll 
    as="button" 
    method="DELETE"
    class="px-3 py-1 rounded-l-2xl rounded-r-2xl text-sm font-semibold hover:brightness-90 transition duration-200" :class="{ 'bg-useGreen' : user.following }">
    Following
    </Link>
    
    <Link :href="`/${$page.props.auth.user.username}/following/${user.id}`" 
    v-if="!user.following" 
    preserve-scroll 
    as="button" 
    method="POST"
    class="bg-normalWhite px-3 py-1 rounded-l-2xl rounded-r-2xl text-sm font-semibold hover:brightness-90 transition duration-200" :class="{ 'bg-normalWhite' : !user.following }">
    Follow
    </Link>
</template>

<script setup>
    import { ref, watch } from "vue";


    const props = defineProps({
        user : Object
    })

    const user = ref(props.user);

    watch(() => props.user, (newUser) => {
        user.value = newUser;
    });

</script>