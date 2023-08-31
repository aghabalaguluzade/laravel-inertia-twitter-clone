<template>
    <div class="relative flex flex-col items-center justify-start 2xl:w-7/12 xl:w-7/12 lg:w-7/12 sm:w-7/12 min-h-screen 2xl:ml-[280px] xl:ml-[280px] lg:ml-[80px] sm:ml-[80px]">
        <TwitNavFollow :profile="profile" />
        <div class="w-full h-auto px-5 mt-2">
            <ul>
                <li v-for="user in followers.data" :key="user.id" class="flex p-3 gap-2 items-center justify-center cursor-pointer hover:bg-lowWhite transition duration-200">
                    <div class="overflow-hidden">
                        <img :src="user.profile_photo_path" alt="profile image" class="object-cover w-full h-full rounded-full hover:brightness-90 transition duration-200" />
                    </div>
                    <div class="flex flex-col flex-grow text-[13px]">
                        <span class="font-semibold text-normalWhite">{{ user.name }}</span>
                        <span class="font-light text-lowsWhite">@{{ user.username }}</span>
                        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quas enim nobis omnis! Architecto, quaerat velit. Cumque perspiciatis consequatur laudantium adipisci illo, quos id veritatis ratione officia officiis rem ipsam debitis repellat rerum quo et tempore, inventore beatae ut provident nobis tempora ex. Nemo doloremque totam in. Esse, non corporis!</p>
                    </div>
                    <TwitFollowingButton :user="user" />
                </li>
            </ul>

            <div v-if="followers.next_page_url" ref="scrollIndicator" class="text-center text-gray-400 my-4">
                Yüklənir...
            </div>
            
        </div>
    </div>

    <aside class="2xl:w-5/12 xl:w-5/12 lg:w-5/12 sm:w-5/12 min-h-screen border-l-[0.5px] border-useGray relative flex flex-col justify-start gap-2 items-center px-5">
        <TwitSearch />
        <TrendsForYou />
        <WhoToFollow />
        <div class="flex flex-col text-lowsWhite text-[12px] w-full px-4 mt-1">
            <div class="flex gap-2">
                <span class="hover:underline cursor-pointer">Terms of Service</span>
                <span class="hover:underline cursor-pointer">Privacy Policy</span>
                <span class="hover:underline cursor-pointer">Cookie Policy</span>
            </div>
            <div class="flex gap-2">
                <span class="hover:underline cursor-pointer">Imprint</span>
                <span class="hover:underline cursor-pointer">Accessibility</span>
                <span class="hover:underline cursor-pointer">Ads info</span>
                <span class="hover:underline cursor-pointer">More...</span>
            </div>
            <span>© 2023 Twitter, Inc.</span>
        </div>
    </aside>
</template>

<script setup>
    import TwitNavFollow from '../Components/TwitNavFollow.vue';
    import TwitFollowingButton from '../Components/TwitFollowingButton.vue';

    import { ref, onMounted, onUnmounted, } from "vue";
    import axios from 'axios';
    import debounce from 'lodash/debounce';

    const props = defineProps({
        profile : Object,
        followers : Object
    })

    
    const profile = ref(props.profile);
    const followers = ref(props.followers);

    const loadMoreFollowers = () => {
            axios.get(followers.value.next_page_url).then((response) => {
                followers.value = {
                    ...response.data,
                    data: [...followers.value.data, ...response.data.data],
                };
            });
    };

    onMounted(() => {
        const handleScroll = debounce(() => {
            const pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;

            if (pixelsFromBottom < 200) {
                loadMoreFollowers();
            }
        }, 100);

        window.addEventListener('scroll', handleScroll);

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });
    });

</script>