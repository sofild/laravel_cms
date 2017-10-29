<template>
    <edit :cate_id="cate_id"></edit>
</template>
<script>
    import edit from '../content/edit.vue';
    export default {
          name: 'PublicService',
          components: {
            edit
          },
          data () {
            return {
                cate_id: 5001
            }
          }
    }
</script>