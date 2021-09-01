<template>
<div style="background-color: white;" >
    <div class="container" >
        <div >
            <H1>Donations</H1>
        </div>
        <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12"  >
            <img class="image fit" v-bind:key="image" v-for="image in images" :src="image.url"/>
        </div>
            
            <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            
                 <div class="contenido-textos">
                <h3><span>1</span>Paso 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                    consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                    velit doloribus laboriosam ut.</p>
                <h3><span>2</span>Paso 2</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                    consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                    velit doloribus laboriosam ut.</p>
                    <h3><span>3</span>Paso 3 </h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                        consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                        velit doloribus laboriosam ut.</p>

            </div>

            
        </div>
            
    </div>
    
    <div style="background-color: white; " >
        <div class="container" >
            
                
                <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                
                     <div class="contenido-textos">
                <h3><span>1</span>Paso 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                    consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                    velit doloribus laboriosam ut.</p>
                <h3><span>2</span>Paso 2</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                    consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                    velit doloribus laboriosam ut.</p>
                    <h3><span>3</span>Paso 3 </h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt veniam eius aspernatur ad
                        consequuntur aperiam minima sed dicta odit numquam sapiente quam eum, architecto animi pariatur,
                        velit doloribus laboriosam ut.</p>

            </div>
    
                
            </div>
            <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12"  >
             
                <img class="image fit" v-bind:key="image" v-for="image in images" :src="image.url"/>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    data(){
    return {
      images : [
         {
            url : '../images/test2.png',
            name : 'My Image 1',
            
         }
      ]
    }
  }
}
</script>

<style>
.image.fit {
    display: block;
    margin: 2em 0 2em 0;
    width: 100%;
}

.sobre-nosotros .contenido-textos{
    width: 45%;
}

.contenido-textos h3{
    margin-bottom: 15px;
}

.contenido-textos h3 span{
    background-color: #fd0000;
    color: #fff;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    width: 30px;
    height: 30px;
    padding: 2px;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, .5);
    margin-right: 5px;
}

.contenido-textos p{
    padding: 0px 0px 30px 15px;
    font-weight: 300;
    text-align: justify;
    width: 500px;
}
</style>