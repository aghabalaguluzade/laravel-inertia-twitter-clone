
<template>
    <aside class="2xl:w-[280px] xl:w-[280px] lg:w-[80px] sm:w-[80px] overflow-y-auto fixed flex flex-col overflow-x-hidden flex-start justify-between border-r-[1px] border-r-lowWhite h-screen">
        <div class="flex flex-col items-start justify-center">
            <Link href="/"
                       class="fill-normalWhite cursor-pointer rounded-full hover:bg-lowWhite p-3 transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[25px]" aria-hidden="true">
                    <g>
                        <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"></path>
                    </g>
                </svg>
            </Link>
            <Link href="/"
                       class="relative leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M12 1.696L.622 8.807l1.06 1.696L3 9.679V19.5C3 20.881 4.119 22 5.5 22h13c1.381 0 2.5-1.119 2.5-2.5V9.679l1.318.824 1.06-1.696L12 1.696zM12 16.5c-1.933 0-3.5-1.567-3.5-3.5s1.567-3.5 3.5-3.5 3.5 1.567 3.5 3.5-1.567 3.5-3.5 3.5z"></path>
                    </g>
                </svg>
                <div class="w-[6px] h-[6px] rounded absolute bottom-9 left-8" :class="{ 'bg-useGreen' : $page.url === '/' }"></div>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Home</span>
            </Link>
            <Link href="/explore"
                       class="leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M15.398,13.522l-3.878-3.877c0.631-0.977,1.004-2.136,1.004-3.384C12.524,2.809,9.713,0,6.262,0 C2.808,0,0,2.809,0,6.262c0,3.453,2.808,6.262,6.262,6.262c1.247,0,2.406-0.371,3.384-1.003l3.876,3.878 c0.129,0.129,0.342,0.129,0.47,0l1.406-1.407C15.527,13.863,15.527,13.653,15.398,13.522z M1.988,6.262 c0-2.355,1.916-4.273,4.273-4.273c2.356,0,4.272,1.917,4.272,4.273c0,2.355-1.916,4.272-4.272,4.272 C3.904,10.535,1.988,8.617,1.988,6.262z"></path>
                    </g>
                </svg>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Explore</span>
            </Link>
            <Link href="/notifications"
                       class="relative leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite px-4 flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M19.993 9.042C19.48 5.017 16.054 2 11.996 2s-7.49 3.021-7.999 7.051L2.866 18H7.1c.463 2.282 2.481 4 4.9 4s4.437-1.718 4.9-4h4.236l-1.143-8.958zM12 20c-1.306 0-2.417-.835-2.829-2h5.658c-.412 1.165-1.523 2-2.829 2zm-6.866-4l.847-6.698C6.364 6.272 8.941 4 11.996 4s5.627 2.268 6.013 5.295L18.864 16H5.134z"></path>
                    </g>
                </svg>
                <div class="w-[16px] h-[16px] rounded-full absolute bottom-9 left-8 bg-blue-500 text-white font-bold flex items-center justify-center" v-if="notifications ">{{ notifications }}</div>
                <div class="w-[6px] h-[6px] rounded absolute bottom-9 left-8 bg-bl bg-useGreen" v-else></div>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Notifications</span>
            </Link>
            <Link href="/messages"
                       class="leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite px-4 flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M1.998 5.5c0-1.381 1.119-2.5 2.5-2.5h15c1.381 0 2.5 1.119 2.5 2.5v13c0 1.381-1.119 2.5-2.5 2.5h-15c-1.381 0-2.5-1.119-2.5-2.5v-13zm2.5-.5c-.276 0-.5.224-.5.5v2.764l8 3.638 8-3.636V5.5c0-.276-.224-.5-.5-.5h-15zm15.5 5.463l-8 3.636-8-3.638V18.5c0 .276.224.5.5.5h15c.276 0 .5-.224.5-.5v-8.037z"></path>
                    </g>
                </svg>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Messages</span>
            </Link>
            <Link href="/bookmarks"
                       class="leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite px-4 flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"></path>
                    </g>
                </svg>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Bookmarks</span>
            </Link>
            <Link href="/profile"
                class="relative leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite px-4 flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M5.651 19h12.698c-.337-1.8-1.023-3.21-1.945-4.19C15.318 13.65 13.838 13 12 13s-3.317.65-4.404 1.81c-.922.98-1.608 2.39-1.945 4.19zm.486-5.56C7.627 11.85 9.648 11 12 11s4.373.85 5.863 2.44c1.477 1.58 2.366 3.8 2.632 6.46l.11 1.1H3.395l.11-1.1c.266-2.66 1.155-4.88 2.632-6.46zM12 4c-1.105 0-2 .9-2 2s.895 2 2 2 2-.9 2-2-.895-2-2-2zM8 6c0-2.21 1.791-4 4-4s4 1.79 4 4-1.791 4-4 4-4-1.79-4-4z"></path>
                    </g>
                </svg>
                <div class="w-[6px] h-[6px] rounded absolute bottom-9 left-8" :class="{ 'bg-useGreen' : $page.url === '/profile' }"></div>
                <span class="2xl:block xl:block lg:hidden sm:hidden">Profile</span>
            </Link>
            <Link href="/"
                       class="leading-none fill-normalWhite cursor-pointer p-3 text-normalWhite  rounded-full hover:bg-lowWhite px-4 flex gap-4 items-center text-md transition duration-300">
                <svg viewBox="0 0 24 24" class="w-[23px]" aria-hidden="true">
                    <g>
                        <path d="M3.75 12c0-4.56 3.69-8.25 8.25-8.25s8.25 3.69 8.25 8.25-3.69 8.25-8.25 8.25S3.75 16.56 3.75 12zM12 1.75C6.34 1.75 1.75 6.34 1.75 12S6.34 22.25 12 22.25 22.25 17.66 22.25 12 17.66 1.75 12 1.75zm-4.75 11.5c.69 0 1.25-.56 1.25-1.25s-.56-1.25-1.25-1.25S6 11.31 6 12s.56 1.25 1.25 1.25zm9.5 0c.69 0 1.25-.56 1.25-1.25s-.56-1.25-1.25-1.25-1.25.56-1.25 1.25.56 1.25 1.25 1.25zM13.25 12c0 .69-.56 1.25-1.25 1.25s-1.25-.56-1.25-1.25.56-1.25 1.25-1.25 1.25.56 1.25 1.25z"></path>
                    </g>
                </svg>
                <span class="2xl:block xl:block lg:hidden sm:hidden">More</span>
            </Link>
            <div class="2xl:w-60 xl:w-60 lg:w-auto md:w-auto sm:w-auto mt-2">
                <button class="flex items-center justify-center transition duration-200  bright hover:brightness-90	 leading-none bg-useGreen text-normalWhite font-bold rounded-full 2xl:w-full xl:w-full text-sm  py-[16px] lg:w-12 lg:h-12">
                    <span class="2xl:block xl:block lg:hidden md:hidden sm:hidden">Tweet</span>
                    <svg viewBox="0 0 24 24" class="w-[25px] fill-normalWhite 2xl:hidden xl:hidden lg:block md:block sm:block" aria-hidden="true">
                        <g>
                            <path d="M23 3c-6.62-.1-10.38 2.421-13.05 6.03C7.29 12.61 6 17.331 6 22h2c0-1.007.07-2.012.19-3H12c4.1 0 7.48-3.082 7.94-7.054C22.79 10.147 23.17 6.359 23 3zm-7 8h-1.5v2H16c.63-.016 1.2-.08 1.72-.188C16.95 15.24 14.68 17 12 17H8.55c.57-2.512 1.57-4.851 3-6.78 2.16-2.912 5.29-4.911 9.45-5.187C20.95 8.079 19.9 11 16 11zM4 9V6H1V4h3V1h2v3h3v2H6v3H4z"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <div tabindex="0"
             class="relative flex items-center group px-3 transition duration-200 cursor-pointer hover:bg-lowWhite rounded-full bottom-2 2xl:left-4 xl:left-4 py-2 2xl:w-11/12 xl:w-11/12 lg:w-16 lg:h-16 sm:h-16 sm:w-16 focus:pointer-events-none ">
            <div class="flex items-center gap-3 w-full">
                <div class="flex items-center justify-center">
                <img class="rounded-full w-9 object-cover " :src="user.profile_photo_path"
                     alt="profile image">
                </div>
                <div class="flex flex-col flex-grow items-center 2xl:block xl:block lg:hidden sm:hidden">
                    <span class="text-normalWhite text-sm font-semibold block">{{ user.name }}</span>
                    <span class="text-lowsWhite font-light text-sm block">@{{ user.username }}</span>
                </div>
                <div class="mr-1 2xl:block xl:block lg:hidden sm:hidden">
                    <svg viewBox="0 0 24 24" class="w-[15px] fill-normalWhite" aria-hidden="true">
                        <g>
                            <path d="M3 12c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9 2c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm7 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"></path>
                        </g>
                    </svg>
                </div>
                <div class="absolute right-2 opacity-0 shadow-[rgba(222,222,222,0.6)] shadow-[0_0_7px_0] text-normalWhite py-3 rounded-xl text-sm w-56 bg-black z-100 pointer-events-none group-focus:opacity-100 group-focus:pointer-events-auto bottom-16 ">
                    <div class="relative  flex flex-col py-2 border-t-[0.5px] border-[rgba(222,222,222,0.4)]">
                        <a @click="logout" class="py-2 px-2 cursor-pointer w-full hover:bg-useGray transition duration-200">Log out @{{ user.username }}</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>


<script setup>
    import {Link, router} from "@inertiajs/vue3";
    import { usePage } from "@inertiajs/vue3";
    import { computed } from "vue";

    const page = usePage()

    const user = computed(() => page.props.auth.user)

    const notifications = computed(() => page.props.unreadNotifications)

    const logout = () => {
        router.post('/logout');
    };

</script>