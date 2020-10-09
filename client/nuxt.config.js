export default {
  // Global page headers (https://go.nuxtjs.dev/config-head)
  head: {
    title: "Excel Importer",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
  },

  // Global CSS (https://go.nuxtjs.dev/config-css)
  css: [],

  loading: { color: "#3B8070" },

  // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
  plugins: [{ src: "~plugins/vue-tables-2.js", ssr: false }],

  build: {
      vendor: ["vue-tables-2"]
  },

  // Auto import components (https://go.nuxtjs.dev/config-components)
  components: true,

  // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
  buildModules: [],

  // Modules (https://go.nuxtjs.dev/config-modules)
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    "bootstrap-vue/nuxt",
    "@nuxtjs/axios"
  ],

  axios: {
    // proxyHeaders: false
    baseURL: "http://localhost:8000/api"
  },
  // Build Configuration (https://go.nuxtjs.dev/config-build)

};
