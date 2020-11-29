<template>
    <common-layout :follows="follows" :authUser="$page.user">
      <template #pagename>
        Account
      </template>
      <a :href="route('account', user.username)" v-for="user in users" class="flex items-center mb-5">
        <avatar :user="user" :key="user.id" :size="60" class="mr-4 rounded"></avatar>
        <div>
          <h4 class="font-bold">{{ '@' + user.username}}</h4>
        </div>
      </a>

    </common-layout>
</template>

<script>
    import CommonLayout from '@/Layouts/CommonLayout'
    import Avatar from '@/Components/Avatar'

    export default {
        components: {
            CommonLayout,
            Avatar,
        },
        props: {
            follows: {
              type: Array,
            },
            users: {
              type: Array
            }
        },
    }
</script>
