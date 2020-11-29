<template>
    <img v-bind:src="user.avatar" v-bind:alt="user.name + '\'s Avatar' " class="rounded-full mr-2" :width="size" :height="size" >
</template>

<script>

    export default {
      props: {
          user: {
            type: Object
          },
          size: {
            type: Number
          },
      },
    }
</script>
