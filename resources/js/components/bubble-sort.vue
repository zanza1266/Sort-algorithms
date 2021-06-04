<template>
  <section class="bubble-algo">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <h1>Bubble sort Algorithm</h1>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col d-flex justify-content-center pt-4">
                    <button type="button" class="btn btn-primary btn-lg" @click= "sort">Sort!</button>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <div class="bars-cont">
                        <div v-for= "(item,i) in arr" :key="i" class="bar"
                        v-bind:style="{ height: item + 'px' }">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex justify-content-center align-items-center pt-4">
                    <input type="range" min="1" max="15" class="slider" id="myRange" v-model="speedBar">

                    <span class="ml-4">Speed: {{speedBar}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col col d-flex justify-content-center pt-3">
                    <button @click= "fillArr" v-bind:style="{ display: restartButton }" class="restart">Restart!</button>
                </div>
            </div>
      </div>
  </section>
</template>

<script>
export default {

    data: function() {
        return {

            arr: [],
            speedBar: 1,
            maxSpeed: 15,
            restartButton: "none"
        }
    },
    mounted () {

    this.fillArr();

    },
    methods: {

        sort: function () {


            let topCounter = 0

            let topInterval = setInterval(function() {

                let count = 0;

                if (topCounter == this.arr.length) {
                    clearInterval(topInterval);

                    this.restartButton = "block"
                }

                let interval = setInterval(function() {

                    let i = count;

                    if (i == this.arr.length) {
                        clearInterval(interval);

                    }

                    if (this.arr[i] > this.arr[i + 1]) {
                    
                        let first = this.arr[i];
                        let second = this.arr [i + 1];

                        Vue.set(this.arr, i, second)
                        Vue.set(this.arr, i + 1, first)

                    }

                    count++

                }.bind(this), this.maxSpeed/this.speedBar)

                topCounter++


            }.bind(this), (this.maxSpeed/this.speedBar)*this.arr.length - topCounter);

        },

        fillArr: function () {

            let arr = []

            for (let i = 0; i < 50; i++) {
                let num = this.numberBetween(1, 300);
                arr.push(num);
            }
        
            this.arr = arr
            this.restartButton = "none"
        },

        numberBetween: function (min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

    }

}
</script>

<style scoped>
    .bar {
  background-color: #2aa9e8;
  border: 1px solid rgb(0, 102, 255);
  width: 15px;
  border-radius: 5px;
}

.bars-cont {
  display: flex;
  align-items: flex-end;
}

h1 {
  font-family: 'Quicksand', sans-serif !important;
}


.slider {
  -webkit-appearance: none;
  width: 200px;
  height: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  border-radius: 5px;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 15px;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 15px;
  background: #4CAF50;
  cursor: pointer;
}

.restart {
  border: none;
  height: 80px;
  width: 150px;
  border-radius: 10px;
  background-color: chocolate;
}
</style>