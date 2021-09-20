<template>
  <div>
    <div class="container multi">
      <h2 class="titles">
        <span class="pull-right">Accesorios</span> Lista de donaciones necesarias
      </h2>
      <div class="row">
        <div class="carousel slide" id="myCarousel">
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                    v-bind:key="image"
                    v-for="image in image1"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                    v-bind:key="image"
                    v-for="image in image2"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                     v-bind:key="image"
                    v-for="image in image3"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                    v-bind:key="image"
                    v-for="image in image4"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                    v-bind:key="image"
                    v-for="image in image5"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                    v-bind:key="image"
                    v-for="image in image6"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                     v-bind:key="image"
                    v-for="image in image7"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
            <div class="item">
              <div class="col-xs-3">
                <a href="#"
                  ><img
                     v-bind:key="image"
                    v-for="image in image8"
                    :src="image.url"
                    class="img-responsive"
                /></a>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"
            ><i class="glyphicon glyphicon-chevron-left"></i
          ></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"
            ><i class="glyphicon glyphicon-chevron-right"></i
          ></a>
        </div>
      </div>
    </div>

    <!-- Type-2 -->
    <div class="container">
      <h2 class="titles">
        <span class="pull-right">Perfil</span> Lista de Donadores
      </h2>
      <div class="row">
        <ul class="scroll-box">
          <li>
            <a href="">
              <h3>Title Name</h3>
              <h1>$ 10</h1>
              <h4>0 out of 975</h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Title Name</h3>
              <h1>$ 10</h1>
              <h4>0 out of 975</h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Title Name</h3>
              <h1>$ 10</h1>
              <h4>0 out of 975</h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Title Name</h3>
              <h1>$ 10</h1>
              <h4>0 out of 975</h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Title Name</h3>
              <h1>$ 10</h1>
              <h4>0 out of 975</h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Type-3 -->
    <div class="container">
      <h2 class="titles"><span class="pull-right">Donaciones</span> Donaciones Recibidas</h2>
      <div class="row donation">
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="" class="card">
            <h3>Title Full Name 15 characters</h3>
            <h1>$ 10</h1>
            <h4>0 out of 975</h4>
            <h5>Description Description Description Description Description</h5>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      image1: [
        {
          url: "../images/donativos/palas.jpg",
        },
      ],
      image2: [
        {
          url: "../images/donativos/arboles.jpg",
        },
      ],
      image3: [
        {
          url: "../images/donativos/camaraTrampa.jpg",
        },
      ],
      image4: [
        {
          url: "../images/donativos/dron.jpg",
        },
      ],
      image5: [
        {
          url: "../images/donativos/palas.jpg",
        },
      ],
      image6: [
        {
          url: "../images/donativos/palas.jpg",
        },
      ],
      image7: [
        {
          url: "../images/donativos/palas.jpg",
        },
      ],
      image8: [
        {
          url: "../images/donativos/palas.jpg",
        },
      ],

    };
  },
};
</script>

<style scoped>
/* Type-1 */
.multi .carousel-inner .active.left {
  left: -25%;
}
.multi .carousel-inner .next {
  left: 25%;
}
.multi .carousel-inner .prev {
  left: -25%;
}
.multi .carousel-control {
  width: 4%;
}
.multi .carousel-control.left,
.multi .carousel-control.right {
  margin-left: 15px;
  background-image: none;
}

/* Type-2 */
.scroll-box {
  display: flex;
  widows: 100%;
  overflow: hidden;
}
.scroll-box:hover {
  overflow: auto;
  overflow-y: hidden;
}
.scroll-box li {
  display: inline-block;
}
.scroll-box a {
  display: block;
  width: 300px;
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  padding: 10px;
  text-align: center;
  margin: 10px;
  color: #282828;
}
.scroll-box a:hover {
  text-decoration: none;
}
.scroll-box a h3 {
  margin-top: 10px;
}
.scroll-box a h1 {
  margin-top: 10px;
  color: orange;
}
.scroll-box a h4 {
  color: #aaa;
  margin-bottom: 15px;
}
.scroll-box a h5 {
  line-height: 20px;
}

/* Type-3 */
.donation a.card {
  display: block;
  width: 100%;
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  padding: 10px;
  text-align: center;
  margin: 10px;
  color: #282828;
}
.donation a.card:hover {
  text-decoration: none;
}
.donation a.card h3 {
  margin-top: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}
.donation a.card h1 {
  margin-top: 10px;
  color: orange;
}
.donation a.card h4 {
  color: #aaa;
  margin-bottom: 15px;
}
.donation a.card h5 {
  line-height: 20px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}

/* Heading */
.titles {
  background: #034991;
  border: 8px double #fff;
  padding: 10px;
  color: #fff;
}
.titles span {
  color: rgba(255, 255, 255, 0.6);
}
</style>