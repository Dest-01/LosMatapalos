<template>
<div class="datos">
  <h1 style="text-align:center">Acerca de nosotros</h1>
  <div class="row ">
    <div class="col-6 col-sm-4 ">
      <div class="mision" style="margin-left:2px;">
        <h2>Mision</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, quod ullam doloribus fuga laudantium nam amet tempore, doloremque a iste unde excepturi reiciendis animi. Aperiam velit omnis minima veritatis corporis laborum cum, fuga, explicabo ipsam sapiente incidunt, saepe id. Dicta laudantium at similique aspernatur mollitia eveniet laboriosam cupiditate. Explicabo quos eveniet in vero sint, reprehenderit repellat nam enim, esse earum sed porro rem saepe assumenda expedita cupiditate iure amet architecto possimus, vel minus? Eligendi accusamus obcaecati dicta dignissimos ipsam a natus aliquid ea veniam voluptatem! Aliquid facilis aperiam numquam accusantium, maiores quisquam assumenda labore temporibus dolorem veritatis repellat neque quas?</p>
      </div>
    </div>
    <div class="col-6 col-sm-4 ">
      <div class="vision">
        <h2> Vision</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium minima sunt vel architecto quas ipsum doloribus vero ab unde, facere tenetur repellendus beatae illum cupiditate aut, eius dolor quo laborum sequi ratione rem vitae incidunt. Ipsa earum natus voluptates, repellat rerum illum voluptatibus veritatis voluptatum impedit odit et. Amet placeat quaerat explicabo sequi cupiditate officiis pariatur maxime veritatis aliquid magnam eaque qui, repellendus quibusdam. Beatae suscipit harum doloribus sit vel, dolore magnam quidem dolorum molestiae. Quaerat laudantium illo, officia ut animi, minus voluptates dolor, alias repellendus corrupti cumque sapiente sit rerum. Quos illo dignissimos libero eaque! Repudiandae totam accusantium suscipit.</p>
      </div>
    </div>
    <div class="col-6 col-sm-4">
      <div class="valores" style="margin-right:2px;">
        <h2>Valores</h2>
        <p> In libero id quos exercitationem vitae expedita quisquam amet praesentium aut qui animi, perspiciatis possimus excepturi aperiam quam, asperiores dicta? Provident reprehenderit ratione quam dignissimos, ullam maiores consequuntur aliquam eum repellendus saepe sapiente necessitatibus aspernatur culpa neque amet iste eaque nam libero incidunt laborum soluta! Quod in rem animi saepe. Esse provident voluptatum labore quia perspiciatis? Nihil perferendis dolorem atque, sapiente consectetur asperiores quisquam corrupti nemo, et nam ipsa eos pariatur dolor minus dolorum voluptatum non in officia maxime saepe! Magnam voluptatibus aspernatur sapiente quae earum beatae vel totam quod, vero sequi.</p>
      </div> 
    </div>
  </div>

<div class="colaboradores padding-lg">
  <div class="container">
    <div class="row encabezado">
        <h2>Nuestro equipo de trabajo</h2>
    </div>
    <ul class="row">
      <li class="col-6 col-sm-4">
          <div class="cnt-block equal-hight" style="height: 349px;">
            <figure><img src="/images/face2.jpg" class="img-responsive" alt=""></figure>
            <h3><a href="mailto:yerry.rodriguez.barquero@est.una.ac.cr">Persona 1</a></h3>
            <p>Profesional ambiental</p>
            <ul class="follow-us clearfix">
              
            </ul>
          </div>
      </li>
      <li class="col-6 col-sm-4">
          <div class="cnt-block equal-hight" style="height: 349px;">
            <figure><img src="/images/bird2.jpg" class="img-responsive" alt=""></figure>
            <h3><a href="mailto:yerry.rodriguez.barquero@est.una.ac.cr">Persona 2</a></h3>
            <p>Director academico</p>
            <ul class="follow-us clearfix">
              
            </ul>
          </div>
       </li>
      <li class="col-6 col-sm-4">
          <div class="cnt-block equal-hight" style="height: 349px;">
            <figure><img src="/images/face1.jpg" class="img-responsive" alt=""></figure>
            <h3><a href="mailto:yerry.rodriguez.barquero@est.una.ac.cr">Persona 3</a></h3>
            <p>Encargado administrativo</p>
            <ul class="follow-us clearfix">
              
            </ul>
          </div>
      </li>
    </ul>
  </div>
</div>
</div>

</template>
<style scoped>

h1,h2{
  text-transform:uppercase;
}
.datos{
  margin-top: 100px;
  background: transparent;
  padding: 0;
  
}
.mision{
  text-align: justify;
  padding: 5%;
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 3px;
}

.mision:hover{
  box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
  border: 0;
}


.mision > h2{
  text-align: center;
}
.vision{
  text-align: justify;
  padding: 5%;
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 3px;
}

.vision:hover
{
  box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
  border: 0;
}


.vision>h2{
  text-align: center;
  
}
.valores{
  text-align: justify;
  padding: 5%;
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 3px;
}

.valores:hover{
  box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
  border: 0;
}
.valores>h2{
  text-align: center;
}

.encargados p{
  margin-top: 150px;
}

.row{
  margin-top: 25px;
  margin-right: 15px;
  margin-left: 15px;
  margin-block: 10px;
}


/*Encargados*/
.row.encabezado h2 {
    color: rgba(255, 255, 255, 0.794);
    font-size: 52.52px;
    line-height: 95px;
    font-weight: 400;
    text-align: center;
    margin: 0 0 40px;
    padding-bottom: 20px;
    text-transform: uppercase;
}
ul{
  margin:0;
  padding:0;
  list-style:none;
}
/* .heading.heading-icon {
    display: block;
} */
.padding-lg {
	display: block;
	padding-top: 60px;
	padding-bottom: 60px;
}
/* .practice-area.padding-lg {
    padding-bottom: 55px;
    padding-top: 55px;
}
.practice-area .inner{ 
   border:1px solid #999999; 
	 text-align:center; 
	 margin-bottom:28px; 
	 padding:40px 25px;
} */
.colaboradores .cnt-block:hover {
    box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
    border: 0;
}
/* .practice-area .inner h3{ 
  color:#3c3c3c; 
	font-size:24px; 
	font-weight:500;
	font-family: 'Poppins', sans-serif;
	padding: 10px 0;
} */
/* .practice-area .inner p{ 
  font-size:14px; 
	line-height:22px; 
	font-weight:400;
} */
/* .practice-area .inner img{
	display:inline-block;
} */
.colaboradores{
  /*fondo*/
  /* background: url("http://www.webcoderskull.com/img/right-sider-banner.png") no-repeat center top / cover; */
   background: rgb(11, 12, 83); 
}
.colaboradores .cnt-block{ 
   float:left; 
   width:100%;
   background:#fff; 
   padding:30px 20px; 
   text-align:center; 
   border:2px solid #d5d5d5;
   margin: 0 0 28px;
}
.colaboradores .cnt-block figure{
   width:148px; 
   height:148px; 
   border-radius:100%; 
   display:inline-block;
   margin-bottom: 15px;
}
.colaboradores .cnt-block img{ 
   width:148px; 
   height:148px; 
   border-radius:100%; 
}
.colaboradores .cnt-block h3{ 
   color:#2a2a2a; 
   font-size:20px; 
   font-weight:500; 
   padding:6px 0;
   text-transform:uppercase;
}
.colaboradores .cnt-block h3 a{
  text-decoration:none;
	color:#2a2a2a;
}
.colaboradores .cnt-block h3 a:hover{
	color:#337ab7;
}
.colaboradores .cnt-block p{ 
   color:#2a2a2a; 
   font-size:13px; 
   line-height:20px; 
   font-weight:400;
}
.colaboradores .cnt-block .follow-us .clearfix  p{ 
   color:#2a2a2a; 
   font-size:13px; 
   line-height:20px; 
   font-weight:400;
}
</style>