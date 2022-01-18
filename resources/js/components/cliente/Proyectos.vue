<template>
<div>
     <div class="col-md-12">
              <div class="site-heading text-center">
                <h2>Nuestros <span>Proyectos</span>.!</h2>
                
              </div>
            </div>
<div class="blog-slider">
  <div class="blog-slider__wrp swiper-wrapper">

    <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <img src="https://dl.dropbox.com/s/zf55w5ifo421lhy/IMG_20211102_134831.jpg?dl=0" alt="">
      </div>
      <div class="blog-slider__content">
        
        <div class="blog-slider__title">Vivero</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? </div>
        <a href="#" class="blog-slider__button">Leer más</a>
      </div>
    </div>
    
    <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <img src="https://dl.dropbox.com/s/5094eiy8j36r3et/20210902230203_IMG_1205.JPG?dl=0" alt="">
      </div>
      <div class="blog-slider__content">
        
        <div class="blog-slider__title">Sendero</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blog-slider__button">Leer más</a>
      </div>
    </div>
    
    <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <img src="https://dl.dropbox.com/s/t2kqme1hxhgdger/20210826205504_IMG_0752.JPG?dl=0" alt="">
      </div>
      <div class="blog-slider__content">
        
        <div class="blog-slider__title">Arboretum</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blog-slider__button">Leer más</a>
      </div>
    </div>
     <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <img src="https://dl.dropbox.com/s/izeydgpf1o4af9x/20210902234013_IMG_1329_1%20%281%29.JPG?dl=0" alt="">
      </div>
      <div class="blog-slider__content">
        
        <div class="blog-slider__title">Reservorio</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blog-slider__button">Leer más</a>
      </div>
    </div>

     <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <img src="https://dl.dropbox.com/s/55jz4vybpnnp0jm/20210804_082932.jpg?dl=0" alt="">
      </div>
      <div class="blog-slider__content">
        
        <div class="blog-slider__title">Meliponario</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blog-slider__button">Leer más</a>
      </div>
    </div>
    
  </div>
  <div class="blog-slider__pagination"></div>
</div>
</div>
</template>



<script>
export default {
  mounted() {
    const plugin = document.createElement("script");
    plugin.setAttribute(
      "src",
      "/js/utilitarios.js"
    );
    plugin.async = true;
    document.head.appendChild(plugin);
  }
};
</script>




<style scoped>


* {
   box-sizing: border-box;
}
 body 
 {
   background-color: #38ab81;
 
   min-height: 100vh;
   font-family: 'Montserrat', sans-serif;
   display: flex;
}




.site-heading h2 {
  display: block;
  font-weight: 700;
  margin-bottom: 10px;
}

.site-heading h2 span {
  color: #38ab81;
}

.site-heading h4 {
  display: inline-block;
  padding-bottom: 20px;
  position: relative;
  text-transform: capitalize;
  z-index: 1;
}

.site-heading h4::before {
  background: #00a01d none repeat scroll 0 0;
  bottom: 0;
  content: "";
  height: 2px;
  left: 50%;
  margin-left: -25px;
  position: absolute;
  width: 50px;
}

.site-heading {
  margin-bottom: 60px;
  overflow: hidden;
  margin-top: -5px;
}





 .blog-slider {
   width: 95%;
   position: relative;
   max-width: 800px;
   margin: auto;
   background: #fff;
   box-shadow: 4px 13px 30px 1px rgba(0, 0, 0, 0.37);
   padding: 25px;
   border-radius: 25px;
   height: 400px;
   transition: all 0.3s;
}
 @media screen and (max-width: 992px) {
   .blog-slider {
     max-width: 680px;
     height: 400px;
  }
}
 @media screen and (max-width: 768px) {
   .blog-slider {
     min-height: 500px;
     height: auto;
     margin: 180px auto;
  }
}
 @media screen and (max-height: 500px) and (min-width: 992px) {
   .blog-slider {
     height: 350px;
  }
}
 .blog-slider__item {
   display: flex;
   align-items: center;
}
 @media screen and (max-width: 768px) {
   .blog-slider__item {
     flex-direction: column;
  }
}
 .blog-slider__item.swiper-slide-active .blog-slider__img img {
   opacity: 1;
   transition-delay: 0.3s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > * {
   opacity: 1;
   transform: none;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(1) {
   transition-delay: 0.3s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(2) {
   transition-delay: 0.4s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(3) {
   transition-delay: 0.5s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(4) {
   transition-delay: 0.6s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(5) {
   transition-delay: 0.7s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(6) {
   transition-delay: 0.8s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(7) {
   transition-delay: 0.9s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(8) {
   transition-delay: 1s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(9) {
   transition-delay: 1.1s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(10) {
   transition-delay: 1.2s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(11) {
   transition-delay: 1.3s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(12) {
   transition-delay: 1.4s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(13) {
   transition-delay: 1.5s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(14) {
   transition-delay: 1.6s;
}
 .blog-slider__item.swiper-slide-active .blog-slider__content > *:nth-child(15) {
   transition-delay: 1.7s;
}
 .blog-slider__img {
   width: 300px;
   flex-shrink: 0;
   height: 300px;
   background: #38ab81;
   box-shadow: 4px 13px 30px 1px rgba(0, 0, 0, 0.37);
   border-radius: 20px;
   transform: translateX(-80px);
   overflow: hidden;
}
 .blog-slider__img:after {
   content: '';
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   border-radius: 20px;
   opacity: 0.8;
}
 .blog-slider__img img {
   width: 100%;
   height: 100%;
   object-fit: cover;
   display: block;
   opacity: 0;
   border-radius: 20px;
   transition: all 0.3s;
}
 @media screen and (max-width: 768px) {
   .blog-slider__img {
     transform: translateY(-50%);
     width: 90%;
  }
}
 @media screen and (max-width: 576px) {
   .blog-slider__img {
     width: 95%;
  }
}
 @media screen and (max-height: 500px) and (min-width: 992px) {
   .blog-slider__img {
     height: 270px;
  }
}
 .blog-slider__content {
   padding-right: 25px;
}
 @media screen and (max-width: 768px) {
   .blog-slider__content {
     margin-top: -80px;
     text-align: center;
     padding: 0 30px;
  }
}
 @media screen and (max-width: 576px) {
   .blog-slider__content {
     padding: 0;
  }
}
 .blog-slider__content > * {
   opacity: 0;
   transform: translateY(25px);
   transition: all 0.4s;
}
 .blog-slider__code {
   color: #7b7992;
   margin-bottom: 15px;
   display: block;
   font-weight: 500;
}
 .blog-slider__title {
   font-size: 24px;
   font-weight: 700;
   color: #0d0925;
   margin-bottom: 20px;
}
 .blog-slider__text {
   color: #4e4a67;
   margin-bottom: 30px;
   line-height: 1.5em;
}
 .blog-slider__button {
   display: inline-flex;
   background: #38ab81;
   padding: 15px 35px;
   border-radius: 50px;
   color: #fff;
   box-shadow: 0px 14px 80px 4px 13px 30px 1px rgba(0, 0, 0, 0.37);
   text-decoration: none;
   font-weight: 500;
   justify-content: center;
   text-align: center;
   letter-spacing: 1px;
}
 @media screen and (max-width: 576px) {
   .blog-slider__button {
     width: 100%;
  }
}
 .blog-slider .swiper-container-horizontal > .swiper-pagination-bullets, .blog-slider .swiper-pagination-custom, .blog-slider .swiper-pagination-fraction {
   bottom: 10px;
   left: 0;
   width: 100%;
}
 .blog-slider__pagination {
   position: absolute;
   z-index: 21;
   right: 20px;
   width: 11px !important;
   text-align: center;
   left: auto !important;
   top: 50%;
   bottom: auto !important;
   transform: translateY(-50%);
}
 @media screen and (max-width: 768px) {
   .blog-slider__pagination {
     transform: translateX(-50%);
     left: 50% !important;
     top: 205px;
     width: 100% !important;
     display: flex;
     justify-content: center;
     align-items: center;
  }
}
 .blog-slider__pagination.swiper-pagination-bullets .swiper-pagination-bullet {
   margin: 8px 0;
}
 @media screen and (max-width: 768px) {
   .blog-slider__pagination.swiper-pagination-bullets .swiper-pagination-bullet {
     margin: 0 5px;
  }
}
 .blog-slider__pagination .swiper-pagination-bullet {
   width: 11px;
   height: 11px;
   display: block;
   border-radius: 10px;
   background: #062744;
   opacity: 0.2;
   transition: all 0.3s;
}
 .blog-slider__pagination .swiper-pagination-bullet-active {
   opacity: 1;
   background: #38ab81;
   height: 30px;
   box-shadow: 4px 13px 30px 1px rgba(0, 0, 0, 0.377);
}
 @media screen and (max-width: 768px) {
   .blog-slider__pagination .swiper-pagination-bullet-active {
     height: 11px;
     width: 30px;
  }
}
 
</style>