<template>
  <div style="margin-top: 100px">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <h1>Galeria Flora</h1>
    <div
      class="container-all"
     
    >
      <div  v-for="donativo in donativos.data"
      :key="donativo.id" class="container">
        <img
          v-bind:src="'/images/donativos/' + donativo.photo"
          width="100%"
          height="100%"
          alt=""
        />
        <span class="title">{{ donativo.idPersona }}</span>
        <span class="text"
          >Morbi diam viverra mattis sociis magna, habitasse penatibus non
          lectus</span
        >
      </div>
    </div>
    <div>
      <h2>Paginacion</h2>
       <pagination
                :data="donativos"
                @pagination-change-page="getResults"
              ></pagination>
    </div>
    <div class="container xsmall">
  <div class="pagination">
      <ul>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li :data="donativos"  @pagination-change-page="getResults" class="active"><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
      </ul>
  </div>
</div>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      donativos: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/floraCliente?page=" + page)
        .then(({ data }) => (this.donativos = data.data));
      this.$Progress.finish();
    },
    cargarDonativos() {
      axios
        .get("/api/floraCliente")
        .then(({ data }) => (this.donativos = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Poppins");
body,
html {
  margin: 0;
  background: #2b2927;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
   min-height: 100vh;
}
.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}
h1 {
  text-align: center;
  color: black;
}
.container-all {
  width: fit-content;
  margin: 20px auto;
  height: auto;
}
.container {
  background: #38ab811c;
  width: calc(33% - 6px);
  overflow: hidden;
  display: block;
  position: relative;
  float: left;
  padding: 1rem;
  margin: 3rem auto auto 10px;
  border-radius: 0.2rem;
  box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.3);
  counter-reset: pagination;
  text-align: center;
}
img {
  width: 100%;
  transition-duration: 0.3s;
  max-width: 100%;
  display: block;
  overflow: hidden;
  cursor: pointer;
}
.title {
  position: absolute;
  display: block;
  cursor: pointer;
  top: 35%;
  display: none;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  font-weight: bold;
  font-size: 1.6em;
  text-shadow: 1px 5px 10px black;
  transition-duration: 0.3s;
}
.text {
  position: absolute;
  top: 70%;
  cursor: pointer;
  max-width: 80%;
  text-align: center;
  left: 50%;
  text-shadow: 1px 5px 10px black;
  font-size: 1em;
  display: none;
  margin-right: -50%;
  transition-duration: 0.3s;
  transform: translate(-50%, -50%);
}
.container:hover img {
  transform: scale(1.2);
  transition-duration: 0.3s;
  filter: grayscale(50%);
  opacity: 0.7;
}
.container:hover span {
  color: white;
  display: block;
  transition-duration: 0.3s;
}
@media only screen and (max-width: 900px) {
  .container {
    width: calc(50% - 6px);
  }
}
@media only screen and (max-width: 400px) {
  .container {
    width: 100%;
  }
}


/*ESTILO DE PAGINACION PRUEBA*/
.center {
  display: flex;
  justify-content: center;
  align-items: center;
}
.container:after {
  clear: both;
  content: "";
  display: table;
}
.container ul {
  width: 100%;
}

.xlarge {
  width: 65rem;
}

.large {
  width: 45rem;
}

.middle {
  width: 32rem;
}

.small {
  width: 22rem;
}

.xsmall {
  width: 14rem;
}

ul, li {
  list-style: none;
  display: inline;
  padding-left: 0px;
}

li {
  counter-increment: pagination;
}
li:hover a {
  color: #fdfdfd;
  background-color: #1d1f20;
  border: solid 1px #1d1f20;
}
li.active a {
  color: #fdfdfd;
  background-color: #1d1f20;
  border: solid 1px #1d1f20;
}
li:first-child {
  float: left;
}
li:first-child a:after {
  content: "Previous";
}
li:nth-child(2) {
  counter-reset: pagination;
}
li:last-child {
  float: right;
}
li:last-child a:after {
  content: "Next";
}
li a {
  border: solid 1px #d7d7d7;
  border-radius: 0.2rem;
  color: #7d7d7d;
  text-decoration: none;
  text-transform: uppercase;
  display: inline-block;
  text-align: center;
  padding: 0.5rem 0.9rem;
}
li a:after {
  content: " " counter(pagination) " ";
}

.large li a {
  display: none;
}
.large li:first-child a {
  display: inline-block;
}
.large li:first-child a:after {
  content: "Previous";
}
.large li:nth-child(2) a {
  display: inline-block;
}
.large li:nth-child(3) a {
  display: inline-block;
}
.large li:nth-child(4) a {
  display: inline-block;
}
.large li:nth-child(5) a {
  display: inline-block;
}
.large li:nth-child(6) a {
  display: inline-block;
}
.large li:nth-child(7) a {
  display: inline-block;
}
.large li:nth-child(8) a {
  display: inline-block;
}
.large li:last-child a {
  display: inline-block;
}
.large li:last-child a:after {
  content: "Next";
}
.large li:nth-last-child(2) a {
  display: inline-block;
}
.large li:nth-last-child(3) {
  display: inline-block;
}
.large li:nth-last-child(3):after {
  padding: 0 1rem;
  content: "...";
}

.middle li a {
  display: none;
}
.middle li:first-child a {
  display: inline-block;
}
.middle li:first-child a:after {
  content: "<";
}
.middle li:last-child a {
  display: inline-block;
}
.middle li:last-child a:after {
  content: ">";
}
.middle li:nth-child(2) a {
  display: inline-block;
}
.middle li:nth-child(3) a {
  display: inline-block;
}
.middle li:nth-child(4) a {
  display: inline-block;
}
.middle li:nth-child(5) a {
  display: inline-block;
}
.middle li:nth-last-child(2) a {
  display: inline-block;
}
.middle li:nth-last-child(3) {
  display: inline-block;
}
.middle li:nth-last-child(3):after {
  padding: 0 1rem;
  content: "...";
}

.small li {
  display: none;
}
.small li:first-child {
  width: 50%;
  display: inline;
}
.small li:first-child a:after {
  content: "Previous Page";
}
.small li:last-child {
  display: inline;
}
.small li:last-child a:after {
  content: "Next Page";
}

.xsmall li {
  display: none;
}
.xsmall li.active {
  display: inline;
}
.xsmall li:first-child {
  display: inline;
}
.xsmall li:first-child a:after {
  content: "Prev";
}
.xsmall li:last-child {
  display: inline;
}
.xsmall li:last-child a:after {
  content: "Next";
} 
</style>