<template>
  <div class="container">
    <div class="alert alert-info" role="alert">
      number of neglected users : {{num}}
    </div>
      <v-client-table
          :data="tableData"
          :columns="columns"
          :options="options">
      </v-client-table>
        <b-pagination
                v-model="page"
                :total-rows="count"
                :per-page="pageSize"

                prev-text="Prev"
                next-text="Next"
                @change="handlePageChange"
              ></b-pagination>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            columns: ['id', 'first_name', 'second_name','family_name','uuid'],
            tableData: [],
            options: {
                headings: {
                    id: 'ID',
                    first_name: 'first_name',
                    second_name: 'second_name',
                    family_name: 'family_name',
                    uuid: 'UUID'
                },
                sortable: ['id'],
                filterable: ['id','first_name', 'second_name','family_name'],

            },
            page: 1,
            count: 999,
            pageSize:10,
            num:0
        }
    },
    methods: {
      async asyncData () {
        let res = await this.$axios.$get(`users?page=${this.page}`)
        this.tableData = res.data
      },
      handlePageChange (value) {
        this.page = value;
        this.asyncData();
      }
    },
    mounted() {
        this.$axios.$get('users').then(res => {
            this.tableData = res.data
            this.count = res.meta.total
            this.num = res.num_neglected
        })
    }

}
</script>

<style>
#app {
  width: 95%;
  margin-top: 50px;
}

.VuePagination {
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: center;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

</style>
