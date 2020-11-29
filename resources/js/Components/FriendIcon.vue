<template>
    <div>
        <li>
          <div>
            <a :href="route('account', follow.username)" class="flex items-center text-sm">
              <avatar :user="follow" :size="40"></avatar>{{ follow.name }}
            </a>
          </div>
        </li>
    </div>
</template>

<script>

    import Avatar from './Avatar'

    export default {

      components: {
          Avatar,
      },
      props: {
          follow: {
            type: Object
          },
      },
    }
</script>
