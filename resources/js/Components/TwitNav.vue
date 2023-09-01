<template>
    <div class="sticky top-0 w-full h-[96px] bg-transparent text-normalWhite mr-auto border-b-[0.5px] border-useGray backdrop-blur-sm">
      <Link href="/"  class="p-3 px-4 h-[48px] block"><h3 class="font-bold">Home</h3></Link>
        <div class="flex justify-evenly items-center text-sm font-light" >
            <Link href="/" class="w-6/12 text-center h-[48px] flex flex-col items-center justify-center text-white font-normal cursor-pointer hover:bg-lowWhite transition duration-200 relative"><span>For you</span><div class="absolute bg-useGreen w-14 h-[4px] rounded top-10"></div></Link>
            <Link :href="`${user.username}/following`" class="w-6/12 text-center h-[48px] flex flex-col items-center justify-center cursor-pointer hover:bg-lowWhite transition duration-200 text-lowsWhite"><span>Following</span></Link>
        </div>
    </div>
  </template>
  
<script setup>
  import { inject } from 'vue';

  const user = inject('user');

</script>