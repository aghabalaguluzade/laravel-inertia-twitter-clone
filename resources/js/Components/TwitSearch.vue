<template>
    <div class="flex flex-col justify-start items-center sticky top-0 bg-black w-full">
        <div class="bg-black  top-0 py-2 group w-full px-5">
            <label tabindex="3" class="flex   bg-useGray py-[10px] px-5 gap-2 rounded-l-full rounded-r-full justify-center items-center focus-within:border-[0.5px] focus-within:border-useGreen focus-within:bg-black">
                <span class="cursor-pointer ">
                    <svg  viewBox="0 0 24 24" class="fill-lowsWhite w-[18px] group-focus-within:fill-useGreen" aria-hidden="true">
                    <g>
                        <path d="M10.25 3.75c-3.59 0-6.5 2.91-6.5 6.5s2.91 6.5 6.5 6.5c1.795 0 3.419-.726 4.596-1.904 1.178-1.177 1.904-2.801 1.904-4.596 0-3.59-2.91-6.5-6.5-6.5zm-8.5 6.5c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5c0 1.986-.682 3.815-1.824 5.262l4.781 4.781-1.414 1.414-4.781-4.781c-1.447 1.142-3.276 1.824-5.262 1.824-4.694 0-8.5-3.806-8.5-8.5z"></path>
                    </g>
                    </svg>
               </span>
                <input type="text" class="outline-none bg-transparent px-2 text-lowsWhite text-sm" v-model="search"  placeholder="Search Twitter">
               <span @click="clearSearchInput" class="flex items-center justify-center bg-useGreen rounded-full box-border cursor-pointer	w-5 h-5 opacity-0 group-focus-within:opacity-100">
                    <svg viewBox="0 0 15 15" class="fill-black w-[10px] " aria-hidden="true">
                    <g>
                        <path d="M6.09 7.5L.04 1.46 1.46.04 7.5 6.09 13.54.04l1.42 1.42L8.91 7.5l6.05 6.04-1.42 1.42L7.5 8.91l-6.04 6.05-1.42-1.42L6.09 7.5z"></path>
                    </g>
                    </svg>
               </span>
            </label>
        </div>
    </div>

    <div class="max-h-48 overflow-y-auto z-10">
        <div v-for="user in users" :key="user.id">
        <span class="text-white">salam</span>
            
            <p class="text-white">{{ user.username }}</p>
        </div>
  
    <div class="flex items-center mt-2" v-for="user in users" :key="user.id">
        <span class="text-white">salam</span>
        <div class="w-10 h-10 mr-4">
            <div class="w-full h-full rounded-full overflow-hidden">
                <img src="https://pbs.twimg.com/profile_images/1576085948743524352/JQ-gfbyf_normal.jpg" alt="" class="w-full h-full object-cover">
            </div>
        </div>
        <div>
            <div class="text-white">Povilas Korop | Laravel Courses Creator & Youtuber</div>
            <span class="text-lg font-semibold text-white">@{{ user.username }}</span>
            <br>
            <span class="text-lg font-semibold text-gray-500">Following</span>
        </div>
    </div>
  
</div>
    
</template> 


<script setup>
    import { ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';
    import debounce from "lodash/debounce";

    const props = defineProps({
        users: {
            type: Array,
            default: () => [],
            },
    });

    const search = ref('');

    const users = ref(props.users);

    const clearSearchInput = () => {
        search.value = '';
    };

    // watch(search, (value) => {
    //     router.get("/search", 
    //         { search: value },
    //         {
    //             preserveState: true,
    //             replace: true,
    //         });
    // });

    watch(() => search.value, debounce(function(value) {
        router.get('/', { search: value }, {
            preserveState: true,
            replace: true
        }, 300);
}));


</script>



