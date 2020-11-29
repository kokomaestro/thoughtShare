<template>
    <app-layout :authUser="authUser">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <slot name="pagename"></slot>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:flex lg:justify-between">
                <div class="overflow-hidden sm:rounded-lg lg:w-32">
                  <sidebar-layout :authUser="authUser">
                  </sidebar-layout>
                </div>
                <div class="lg:flex-1 lg:mx-10" style="max-width: 700px;">
                    <slot></slot>
                </div>
                <div class="lg:w-1/6">
                  <div class="bg-gray-200 border border-gray-300 rounded-lg py-4 px-6">
                    <h3 class="font-bold text-xl mb-4">Following</h3>
                    <ul v-if="follows.length > 0">

                      <friend-icon  v-bind:class="{'mb-4': index !== follows.length-1}" v-for="(follow, index) in follows" :key="follow.id" :follow="follow">
                      </friend-icon>
                    </ul>
                    <p v-else="follows.length > 0">No friends yet!</p>
                  </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './AppLayout'
    import SidebarLayout from './SidebarLayout'
    import FriendIcon from '@/Components/FriendIcon'

    export default {
        components: {
            AppLayout,
            SidebarLayout,
            FriendIcon,
        },
        props: {
            follows: {
              type: Array,
            },
            authUser: {
              type: Object
            }
        },
    }
</script>
