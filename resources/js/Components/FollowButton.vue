<template>
  <form method="POST" v-bind:action=" '/accounts/' + $page.user.username + '/follow'">
    <input type="hidden" name="_token" :value="csrf">
    <button v-if="following" type="submit" class="bg-blue-500 rounded-full shadow py-2 px-2 text-white text-xs">Unfollow Me</button>
    <button v-else="following" type="submit" class="bg-blue-500 rounded-full shadow py-2 px-2 text-white text-xs">Follow Me</button>
  </form>
</template>

<script>

    export default {
      data() {
          return {
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
      },
      props: {
          following: {
            type: Boolean
          },
      },
    }
</script>
