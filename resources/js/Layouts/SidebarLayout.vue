<template>
    <div class="overflow-hidden sm:rounded-lg lg:w-32">
      <ul>
          <li><a class="font-bold text-lg mb-4 block" :href="route('dashboard')">Home</a></li>
          <li><a class="font-bold text-lg mb-4 block" :href="route('explore')">Explore</a></li>
          <li><a class="font-bold text-lg mb-4 block" :href="route('account', authUser.username)">Account</a></li>
          <li><a @click.prevent="logout" class="font-bold text-lg mb-4 block" href="">Logout</a></li>
      </ul>
    </div>
</template>

<script>

    export default {
      props: {
          authUser: {
            type: Object
          },
      },
      methods: {
          logout() {
              axios.post(route('logout').url()).then(response => {
                  window.location = '/';
              })
          },
      }
    }
</script>
