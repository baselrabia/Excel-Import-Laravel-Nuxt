<template>
  <div id="app">
    <no-ssr placeholder="Loading...">
        <vue-data-table></vue-data-table>
    </no-ssr>
  </div>
</template>

<script>
import VueDataTable from '@/components/VueDataTable'

export default {
  name: 'app',
  components: {
   'vue-data-table': VueDataTable
  }
}
</script>
