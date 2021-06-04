<template>
  <section class="merge-algo">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <h1>Merge sort Algorithm</h1>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col d-flex justify-content-center pt-4">
                    <button type="button" class="btn btn-primary btn-lg" @click="sort" v-bind:style="{ display: sortButton }">Sort!</button>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <div class="bars-cont">
                        <div v-for= "(item, ind) in arr" :key="ind" class="bar"
                        v-bind:style="{ height: item + 'px', background: trackIndexOnData === ind ? 'blue' : 'rgba(0, 68, 255, 0.664)' }">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div v-if="sortButton == 'block'" class="col d-flex justify-content-around align-items-center pt-4">
                    <div>
                        <input type="range" min="5" max="50" class="slider" id="myRange" v-model="setSpeed">
                        <span class="ml-4">Speed: {{setSpeed}} ms/iteration</span>
                    </div>

                    <div>
                        <input type="range" min="16" max="96" class="slider" id="myRange" v-model="setArrayLength">
                        <span class="ml-4">Lenght: {{setArrayLength}}</span>
                    </div>
                </div>

                <div v-else-if="sortButton == 'none' && restartButton == 'none'" class="col d-flex justify-content-center align-items-center pt-4">
                    <h4>Sorting...</h4>
                </div>

                <div v-else class="col d-flex justify-content-center align-items-center pt-4">
                    <h4>Done!</h4>
                </div>
            </div>

            <div class="row">
                <div class="col col d-flex justify-content-center pt-3">
                    <button @click= "fillArr(setArrayLength)" v-bind:style="{ display: restartButton }" class="restart">Restart!</button>
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
            setSpeed: 10,
            restartButton: "none",
            sortButton: "block",
            iterationIndexes: [],
            setArrayLength: 32,
            trackIndexOnData: null
        }
    },

    mounted () {

        this.initArrayIndexes(parseInt(this.setArrayLength));
    },

    watch: {
        setArrayLength(value) {
            this.initArrayIndexes(parseInt(value))
        }
    },

    methods: {

        sort: function () {

            var speed = parseInt(this.setSpeed);
            var iterationTurn = 0
            this.sortButton = "none";

            const merge = (leftArr, rightArr) => {

                let output = [];

                let leftIndex = 0;
                let rightIndex = 0;

                while (leftIndex < leftArr.length && rightIndex < rightArr.length) {

                    let leftEl = leftArr[leftIndex]
                    let rightEl = rightArr[rightIndex]

                    if (leftEl < rightEl) {
                        output.push(leftEl)
                        leftIndex++
                    } else {
                        output.push(rightEl)
                        rightIndex++
                    }
                }

                var orderedPortion = [...output, ...leftArr.slice(leftIndex), ...rightArr.slice(rightIndex)]

                orderedPortion.forEach((el) => {

                    setTimeout(function (){

                        var index = this.iterationIndexes[iterationTurn]
                        this.trackIndexOnData = index;

                        Vue.set(this.arr, index, el)

                        iterationTurn += 1

                        if (iterationTurn === this.iterationIndexes.length) {
                            this.restartButton = "block"
                        }

                    }.bind(this), speed)

                    speed += parseInt(this.setSpeed);
                });

                return orderedPortion;
            };



            const mergeSort = (array) => {

                if (array.length <= 1) {
                    return array;
                }

                const middleIndex = Math.floor(array.length / 2);
                const leftArr = array.slice(0, middleIndex);
                const rightArr = array.slice(middleIndex);

                return merge(
                    mergeSort(leftArr),
                    mergeSort(rightArr)
                );
            }

            mergeSort(this.arr);
        },

        fillArr: function (len) {

            this.arr.length > 0 ? this.arr = [] : '';

            for (let i = 0; i < len; i++) {
                this.arr.push(this.numberBetween(1, 300));
            }

            this.restartButton = "none";
            this.sortButton = "block";
        },

        numberBetween: function (min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        },

        initArrayIndexes: function (length) {

            this.iterationIndexes = [];
            this.fillArr(length);

            let indexes = []

            this.arr.forEach((element, ind) => {
                indexes.push(ind)
            });

            const joiner = (left, right) => {

                let output = []
                
                left.forEach(element => {
                    output.push(element)
                    this.iterationIndexes.push(element)
                });

                right.forEach(element => {
                    output.push(element)
                    this.iterationIndexes.push(element)
                });

                console.log(output);

                return output;
            }

            const slicer = (array) => {

                if (array.length <= 1) {
                    return array;
                }

                const middleIndex = Math.floor(array.length / 2);
                const leftArr = array.slice(0, middleIndex);
                const rightArr = array.slice(middleIndex);

                return joiner(
                    slicer(leftArr),
                    slicer(rightArr)
                );
            }

            slicer(indexes);
        }

    }

}
</script>



<style scoped>


.bar {
    background: rgba(0, 68, 255, 0.664);
  border: 1px solid white;
  width: 10px;
}

.bars-cont {
  display: flex;
  align-items: flex-end;
  min-height: 320px;
}

h1 {
  font-family: 'Poppins', sans-serif !important;
}


.slider {
  -webkit-appearance: none;
  width: 200px;
  height: 3px;
  background: #343a40;
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
  width: 15px;
  height: 15px;
  background: #2426b8;
  cursor: pointer;
  border-radius: 50%;
  border-style: none;
}

.slider::-moz-range-thumb {
  width: 15px;
  height: 15px;
  background: #2426b8;
  cursor: pointer;
  border-radius: 50%;
  border-style: none;
}

.restart {
    color: white;
  border: none;
  padding: 15px;
  border-radius: 10px;
  background-color: black;
}
</style>