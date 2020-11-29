<template>
    <div class="flex p-4 border-b border-b-gray-400">
        <div class="mr-2 flex-shrink-0">
          <a :href="route('account', getThoughtUser(user, follows, thought).username)">
            <avatar :user="getThoughtUser(user, follows, thought)" :size="50"></avatar>
          </a>
        </div>
        <div>
          <h5 class="font-bold mb-4"><a :href="route('account', getThoughtUser(user, follows, thought).username)">{{ getThoughtUser(user, follows, thought).name }}</a></h5>
          <p class="text-sm mb-3">{{ thought.body }}</p>

          <like-buttons-form :thought="thought" :isThoughtLiked="isThoughtLiked(likeList, thought)"
          :isThoughtDisliked="isThoughtLiked(likeList, thought, 0)"></like-buttons-form>

          </div>
        </div>
    </div>
</template>

<script>

    import Avatar from './Avatar'
    import LikeButtonsForm from './LikeButtonsForm'

    export default {

      components: {
          Avatar,
          LikeButtonsForm,
      },

      props: {
          thought: {
            type: Object,
            required: true
          },
          follows: {
            type: Array
          },
          user: {
            type: Object
          },
          likeList: {
            type: Array
          }
      },
      methods: {
          getThoughtUser(user, follows, thought) {
            return thought.user_id === user.id ? user : _.find(follows, function(user) { return thought.user_id === user.id; });
          },
          isThoughtLiked(likeList, thought, toggle = 1) {
            const like =  _.find(likeList, function(like) { return like.thought_id === thought.id});
            if(like) {
              return like.liked === toggle ? true : false;
            } else {
              return false;
            }
          }

      },
      data() {
        return {
          _: window._,
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
      },



    }
</script>
