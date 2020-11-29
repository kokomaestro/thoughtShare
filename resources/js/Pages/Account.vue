<template>
    <common-layout :follows="follows" :authUser="authUser">
      <template #pagename>
        Account
      </template>
      <header class="mb-6 relative">
        <div class="flex justify-between items-center mb-4">
          <div style="max-width: 270px;">
            <h2 class="font-bold text-2xl mb-2">{{user.name}}</h2>
            <p class="text-sm">{{user.created_at}}</p>
          </div>

          <div>
            <a v-if="user.id===authUser.id" :href="route('profile.show')" class="rounded-full border border-grey-300 py-2 px-2 text-black text-xs">Edit Profile</a>
            <follow-button v-else="user.id===authUser.id" :following="following"></follow-button>
          </div>
        </div>
        <p class="text-sm">
          If needed, you may specify a database connection name to connect to a database connection that is not the default connection:
          If needed, you may specify a database connection name to connect to a database connection that is not the default connection:
          If needed, you may specify a database connection name to connect to a database connection that is not the default connection:
          If needed, you may specify a database connection name to connect to a database connection that is not the default connection:
        </p>
        <avatar :user="user" :size="40" class="absolute" style="width: 150px; left: calc(50% - 75px); top: -60%"></avatar>
      </header>
      <div class="border border-gray-300 rounded-lg">
          <div v-if="thoughts.length > 0">
            <thought v-for="thought in thoughts" :key="thought.id" :thought="thought" :user="user" :authUser="authUser" :likeList="likeList">
            </thought>
            <pagination :links="links"></pagination>
          </div>
          <p v-else="thoughts.length > 0" class="p-4">No Thoughts Yet</p>
      </div>
    </common-layout>
</template>

<script>
    import CommonLayout from '@/Layouts/CommonLayout'
    import Thought from '@/Components/Thought'
    import Avatar from '@/Components/Avatar'
    import FollowButton from '@/Components/FollowButton'
    import Pagination from '@/Components/Pagination'

    export default {
        components: {
            CommonLayout,
            Thought,
            Avatar,
            FollowButton,
            Pagination,
        },
        props: {
            thoughts: {
              type: Array,
              required: true
            },
            follows: {
              type: Array,
            },
            authUser: {
              type: Object
            },
            following: {
              type: Boolean
            },
            user: {
              type: Object
            },
            links: {
              type: Array
            },
            likeList: {
              type: Array
            }
        },
    }
</script>
