<template>
  <div class="border border-blue-400 px-8 py-6 mb-8">
    <form method="POST" action="/thoughts">
      <input type="hidden" name="_token" :value="csrf">
      <textarea name="body" class="w-full" placeholder="What's your Thought?" autofocus required></textarea>

      <hr class="my-4">

      <footer class="flex justify-between items-center">
        <avatar :user="$page.user" :size="50"></avatar>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm h-10 text-white">Share A Thought!</button>
      </footer>


    </form>
    <div v-if="$page.errorBags.length !== 0">
      <p v-for="error in $page.errorBags.default.body"class="text-red-500 text-sm mt-2">{{error}}</p>
    </div>


  </div>
</template>

<script>

    import Avatar from './Avatar'

    export default {

        components: {
            Avatar,
        },

        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
    }
</script>
