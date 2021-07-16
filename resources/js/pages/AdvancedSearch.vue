<template>
  <div>
 <div class="d-flex box-search">
                    <div class="d-flex flex-column box-apartments flew-wrap">
                    <div 
                    v-for="(apartment , key) in apartments" :key="key"
                    class="card m-3">
                    <img class="card-img-top" :src="apartment.img_path" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{apartment.title}}</h5>
                            <p class="card-text">{{apartment.address}}</p>
                            <p class="card-text">{{apartment.floor}}</p>
                            <p class="card-text">{{apartment.rooms}}</p>
                            <p class="card-text">{{apartment.beds}}</p>
                            <p class="card-text">{{apartment.description}}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                </div>
           <div  id="map" class="ml-5"></div>
          </div>
  </div>
</template>

<script>
export default {
    props:['apartments'],
    name:'AdvancedSearch',
}
</script>

<style scoped lang="scss">
#map{
        width: 65%;
        height: 70vh;
        }

        .range{
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: chartreuse;
            color: #000;
            border-radius: 50%;
            font-weight: bold;
            font-size: 10px;
        }


        .card{
            width: 18rem;
            animation: card-effect 0.7s forwards;
           opacity: 0;
           transform: scale(0.1);
        }

        @keyframes card-effect {
            0%{
                opacity: 0;
                transform: scale(0.1);
            }
            100%{
                opacity: 1;
                transform: scale(1.0);
            }
        }


        .box-apartments{
            max-height: 70vh;
            width: 35%;
            overflow-y:auto;
        }
</style>