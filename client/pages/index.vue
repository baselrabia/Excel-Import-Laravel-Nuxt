<template>
  <div class="container">
    <div>
      <Logo />
      <h1 class="title">
        Excel Importer
      </h1>

      <div>
          <!-- Styled -->
          <b-form-file
            v-model="file"
            :state="Boolean(file)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
            @change="onFileSelected"
          ></b-form-file>
        <div style="margin: 20px;" >
            <b-button @click="onUpload" variant="success">Upload</b-button>
        </div>
        <div style="margin: 20px;" >
            <b-alert  :show="msg != ''" variant="success">{{msg}}, queue is runing u can see Results in <a href="/users">  users page </a></b-alert>
        </div>
        </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
      return {
        file: null,
        msg: '',
      }
    },
    methods: {
      onFileSelected($event) {
       this.file = event.target.files[0]
      },
     async onUpload() {
        //  this.file = event.target.files[0]
          const fd = new FormData();
          fd.append("file", this.file);
          let response = await this.$axios.$post('users/import',fd);
          this.msg = response.message
      }
    },

  }
</script>

<style>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family:
    'Quicksand',
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
