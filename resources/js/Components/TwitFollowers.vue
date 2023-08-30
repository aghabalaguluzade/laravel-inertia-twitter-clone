<template>
    <div class="w-full h-auto">
        <div class="h-auto overflow-hidden">
            <ul>
                <li class="flex p-3 gap-2 items-center justify-center cursor-pointer hover:bg-lowWhite transition duration-200">
                    <div class="overflow-hidden">
                        <img :src="profile.user.profile_photo_path" class="object-cover rounded-full hover:brightness-90 transition duration-200" alt="profile image" />
                    </div>
                    <div class="flex flex-col flex-grow text-[13px]">
                        <span class="font-semibold text-normalWhite">{{ profile.user.name }}</span>
                        <span class="font-light text-lowsWhite">@{{ profile.user.username }}</span>
                        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quas enim nobis omnis! Architecto, quaerat velit. Cumque perspiciatis consequatur laudantium adipisci illo, quos id veritatis ratione officia officiis rem ipsam debitis repellat rerum quo et tempore, inventore beatae ut provident nobis tempora ex. Nemo doloremque totam in. Esse, non corporis!</p>
                    </div>
                    <button class="bg-normalWhite px-3 py-1 rounded-l-2xl rounded-r-2xl text-[13px] font-semibold hover:brightness-90 transition duration-200">Follow</button>
                </li>
            </ul>
        </div>
    </div>

</template>


<script setup>
    import { ref } from "vue";

    const props = defineProps({
        profile : Object,
        followers : Array
    })

    
    const profile = ref(props.profile);
    const followers = ref(props.followers);
    
</script>