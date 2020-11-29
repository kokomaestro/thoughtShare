<template>
    <common-layout :follows="follows" :authUser="$page.user">
        <template #pagename>
          Dashboard
        </template>
        <thought-form>
        </thought-form>
      <div class="border border-gray-300 rounded-xl">
          <div v-if="thoughts.length > 0">
            <thought  v-for="thought in thoughts" :key="thought.id" :thought="thought" :follows="follows" :user="$page.user" :likeList="likeList">
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
    import ThoughtForm from '@/Components/ThoughtForm'
    import Pagination from '@/Components/Pagination'

    export default {
        components: {
            CommonLayout,
            Thought,
            ThoughtForm,
            Pagination
        },
        props: {
            thoughts: {
              type: Array,
              required: true
            },
            follows: {
              type: Array,
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
