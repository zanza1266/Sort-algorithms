<template>
    <section class="insertion-algo">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <h1>Insertion sort Algorithm</h1>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col d-flex justify-content-center pt-4">
                    <button
                        type="button"
                        class="btn btn-primary btn-lg"
                        @click="sort"
                        v-bind:style="{ display: sortButton }"
                    >
                        Sort!
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center pt-4">
                    <div class="bars-cont">
                        <div
                            v-for="(item, i) in arr"
                            :key="i"
                            class="bar"
                            v-bind:style="{
                                height: item + 'px',
                                background:
                                    trackIndex === i
                                        ? 'blue'
                                        : 'rgba(0, 68, 255, 0.664)'
                            }"
                        ></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div
                    v-if="sortButton === 'block'"
                    class="col d-flex justify-content-around align-items-center pt-4"
                >
                    <div>
                        <input
                            type="range"
                            min="20"
                            max="50"
                            class="slider"
                            id="myRange"
                            v-model="speed"
                        />
                        <span class="ml-4"
                            >Speed: {{ speed }} ms/iteration</span
                        >
                    </div>

                    <div>
                        <input
                            type="range"
                            min="10"
                            max="30"
                            class="slider"
                            id="myRange"
                            v-model="setArrayLength"
                        />
                        <span class="ml-4">Lenght: {{ setArrayLength }}</span>
                    </div>
                </div>

                <div
                    v-else-if="sortButton == 'none' && restartButton == 'none'"
                    class="col d-flex justify-content-center align-items-center pt-4"
                >
                    <h4>Sorting...</h4>
                </div>

                <div
                    v-else
                    class="col d-flex justify-content-center align-items-center pt-4"
                >
                    <h4>Done!</h4>
                </div>
            </div>

            <div class="row">
                <div class="col col d-flex justify-content-center pt-3">
                    <button
                        @click="fillArr(setArrayLength)"
                        v-bind:style="{ display: restartButton }"
                        class="restart"
                    >
                        Restart!
                    </button>
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
            restartButton: "none",
            sortButton: "block",
            speed: 20,
            trackIndex: null,
            setArrayLength: 20
        };
    },

    mounted() {
        this.fillArr(this.setArrayLength);
    },

    watch: {
        setArrayLength(value) {
            this.fillArr(value);
        }
    },

    methods: {
        sort: function() {
            let speed = parseInt(this.speed);
            this.sortButton = "none";

            for (let i = 1; i < this.arr.length; i++) {
                for (let j = i; j > 0; j--) {
                    setTimeout(() => {
                        this.trackIndex = j - 1;

                        if (this.arr[j] < this.arr[j - 1]) {
                            let temp = this.arr[j];
                            Vue.set(this.arr, j, this.arr[j - 1]);
                            Vue.set(this.arr, j - 1, temp);
                        }
                    }, speed);

                    speed += parseInt(this.speed);
                }
            }

            setTimeout(() => {
                this.restartButton = "block";
            }, speed);
        },

        fillArr: function(quantity) {
            this.arr.length > 0 ? (this.arr = []) : "";

            for (let i = 0; i < quantity; i++) {
                let num = this.numberBetween(1, 300);
                this.arr.push(num);
            }

            this.restartButton = "none";
            this.sortButton = "block";
        },

        numberBetween: function(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    }
};
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
    font-family: "Poppins", sans-serif !important;
}

.slider {
    -webkit-appearance: none;
    width: 200px;
    height: 3px;
    background: #343a40;
    outline: none;
    opacity: 0.7;
    border-radius: 5px;
    -webkit-transition: 0.2s;
    transition: opacity 0.2s;
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
