<template>
  <div
    class="contenedor wow fadeInLeft"
    data-wow-delay="0.2s"
    style="
      visibility: visible;
      -webkit-animation-delay: 0.2s;
      -moz-animation-delay: 0.2s;
      animation-delay: 0.2s;
    "
  >
    <div class="site-heading text-center">
      <h2>Equipo de <span>Desarrollo</span></h2>
    </div>
    <div class="main-card">
      <div class="cards">
        <div class="card">
          <div class="content">
            <div class="img">
              <img v-bind:src="'/images/user.png'" alt="" />
              <!--- <img src="images/img1.jpg" alt="">-->
            </div>
            <div class="details">
              <div class="name">Yerry Rodriguez Barquero</div>
              <div class="job">Desarrollador</div>
            </div>
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="content">
            <div class="img">
              <img v-bind:src="'/images/user.png'" alt="" />
              <!--- <img src="images/img2.jpg" alt="">--->
            </div>
            <div class="details">
              <div class="name">
                Marko Guevara <br />
                Fallas
              </div>
              <div class="job">Desarrollador</div>
            </div>
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="content">
            <div class="img">
              <img v-bind:src="'/images/user.png'" alt="" />
              <!-- <img src="images/img3.jpg" alt="">---->
            </div>
            <div class="details">
              <div class="name">
                Erick Valle <br />
                Obando
              </div>
              <div class="job">Desarrollador</div>
            </div>
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="content">
            <div class="img">
              <img v-bind:src="'/images/user.png'" alt="" />
              <!---<img src="images/img4.jpg" alt="">--->
            </div>
            <div class="details">
              <div class="name">Cesar Matarrita Matarrita</div>
              <div class="job">Desarrollador</div>
            </div>
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="content">
            <div class="img">
              <!---<img src="images/img4.jpg" alt="">--->
              <img v-bind:src="'/images/user.png'" alt="" />
            </div>
            <div class="details">
              <div class="name">Jose Montiel Hernandez</div>
              <div class="job">Desarrollador</div>
            </div>
            <div class="media-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
.contenedor {
  width: 100%;
  overflow: hidden;
  padding: 80px 0px;
}

::selection {
  background: #034991d1;
  color: rgba(15, 15, 15, 0.521);
}
.contenedor {
  width: 100%;
  overflow: hidden;
  padding: 20px 0;
  margin: 20px 0;
}
span {
  color: #034991d1;
}
h2 {
  font-weight: 700;
}
.site-heading {
  margin: 5px;
  padding: 5px;
  font-weight: 700;
}
.contenedor .main-card {
  display: flex;
  justify-content: space-evenly;
  transition: 1s;
}
#two:checked ~ .main-card {
  margin-left: -100%;
}
.contenedor .main-card .cards {
  display: flex;
  margin: 0 20px;
  justify-content: space-between;
  gap: 10px;
  flex-wrap: nowrap;
}
.main-card .cards .card {
  width: calc(100% / 3 - 10px);
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
  transition: all 0.4s ease;
}
.main-card .cards .card:hover {
  transform: translateY(-15px);
}
.cards .card .content {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}
.cards .card .content .img {
  height: 130px;
  width: 130px;
  border-radius: 50%;
  padding: 3px;
  background: #034991d1;
  margin-bottom: 14px;
}
.card .content .img img {
  height: 100%;
  width: 100%;
  border: 3px solid #ffff;
  border-radius: 50%;
  object-fit: cover;
}
.card .content .name {
  font-size: 20px;
  font-weight: 500;
}
.card .content .job {
  font-size: 20px;
  color: #034991d1;
}
.card .content .media-icons {
  margin-top: 10px;
  display: flex;
}
.media-icons a {
  text-align: center;
  line-height: 33px;
  height: 35px;
  width: 35px;
  margin: 0 4px;
  font-size: 14px;
  color: #fff;
  border-radius: 50%;
  border: 2px solid transparent;
  background: #034991d1;
  transition: all 0.3s ease;
}
.media-icons a:hover {
  color: #034991d1;
  background-color: rgb(0, 0, 0);
  border-color: #034991d1;
}
.contenedor .button {
  width: 100%;
  display: flex;
  justify-content: center;
  margin: 20px;
}
.button label {
  height: 15px;
  width: 15px;
  border-radius: 20px;
  background: rgb(0, 0, 0);
  margin: 0 4px;
  cursor: pointer;
  transition: all 0.5s ease;
}
.button label.active {
  width: 35px;
}
#one:checked ~ .button .one {
  width: 35px;
}
#one:checked ~ .button .two {
  width: 15px;
}
#two:checked ~ .button .one {
  width: 15px;
}
#two:checked ~ .button .two {
  width: 35px;
}
input[type="radio"] {
  display: none;
}
@media (max-width: 768px) {
  .main-card .cards .card {
    margin: 20px 0 10px 0;
    width: calc(100% / 2 - 10px);
  }
}
@media (max-width: 600px) {
  .main-card .cards .card {
    /* margin: 20px 0 10px 0; */
    width: 100%;
  }
}
@media only screen and (max-device-width: 1023px) {
  .contenedor .main-card .cards {
    display: flex;
    flex-wrap: wrap;
  }
}
@media only screen and (min-device-width: 400px) and (max-device-width: 900px) {
  .main-card {
    margin: 20px 0 100px 0;
  }
}
@media only screen and (max-device-width: 399px) {
  .main-card {
    margin: 20px 0 160px 0;
  }
}
</style>