<template>
  <ul class="flex w-64 p-4 mx-auto justify-between">
    <li v-for="(value, name, index) in links">
      <a :href="value.url" v-bind:class="{'text-blue-500': value.active}" v-html="value.label"></a>
    </li>

  </ul>
</template>

<script>

    export default {
      props: {
          links: {
            type: Array
          },
      },
    }
</script>
