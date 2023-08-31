<template>
  <div class="sticky top-0 w-full h-[96px] bg-transparent text-normalWhite mr-auto border-b-[0.5px] border-useGray backdrop-blur-sm">
    <Link :href="profile.user.username"  class="p-3 px-4 h-[48px] flex justify-start gap-5">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-extrabold">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
      </svg>
      <h3 class="font-bold">@{{ profile.user.username }}</h3>
    </Link>
      <div class="flex justify-evenly items-center text-sm font-light" >
        <Link :href="`/${profile.user.username}/followers`" class="w-6/12 text-center h-[48px] flex flex-col items-center justify-center text-white font-normal cursor-pointer hover:bg-lowWhite transition duration-200 relative"><span>Followers</span><div class="absolute w-14 h-[4px] rounded top-10" :class="{ 'bg-useGreen' : $page.url.slice(-10) === `/followers` }"></div></Link>
        <Link :href="`/${profile.user.username}/following`" class="w-6/12 text-center h-[48px] flex flex-col items-center justify-center text-white font-normal cursor-pointer hover:bg-lowWhite transition duration-200 relative"><span>Following</span><div class="absolute w-14 h-[4px] rounded top-10" :class="{ 'bg-useGreen' : $page.url.slice(-10) === `/following` }"></div></Link>
      </div>
  </div>
</template>

<script setup>
  import { ref } from "vue";

  const props = defineProps({
      profile : Object
  })

  const profile = ref(props.profile);

</script>