<template>
    <list :cate_id="cate_id"></list>
</template>
<script>
    import list from '../content/list.vue';
    export default {
          name: 'IndustryNews',
          components: {
            list
          },
          data () {
            return {
                cate_id: 2001
            }
          }
    }
</script>