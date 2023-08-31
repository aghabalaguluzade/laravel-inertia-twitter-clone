<template>
    <Link :href="`/${$page.props.auth.user.username}/following/${user.id}`" 
    v-if="user.following" 
    preserve-scroll
    @mouseover="showUnFollow = true"
    @mouseleave="showUnFollow" 
    as="button" 
    method="DELETE"
    class="bg-useGreen px-3 py-1 rounded-l-2xl rounded-r-2xl text-sm font-semibold hover:bg-red-600 hover:brightness-90 transition duration-200">
    {{ showUnFollow ? 'Unfollow' : 'Following' }}
    </Link>
    
    <Link :href="`/${$page.props.auth.user.username}/following/${user.id}`" 
    v-else 
    preserve-scroll
    as="button" 
    method="POST"
    class="bg-normalWhite px-3 py-1 rounded-l-2xl rounded-r-2xl text-sm font-semibold hover:brightness-90 transition duration-200">
    Follow
    </Link>
</template>

<script setup>
    import { ref, watch } from "vue";


    const props = defineProps({
        user : Object
    })

    const showUnFollow = ref(false);

    const user = ref(props.user);

    watch(() => props.user, (newUser) => {
        user.value = newUser;
    });

</script>