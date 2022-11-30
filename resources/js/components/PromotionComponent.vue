<template lang="">
    <div>
        <div>
            <button @click="showPlans()">
                Promuovi ora
            </button>
        </div>
        <div class="border-2  border-red-600" v-if="planPopUpVisible">
            <sponsor-component :apartment="apartment" />
            <button class="rounded-full font-bold absolute right-0 top-0 p-4 bg-red-600 z-50" @click="showPlans()">
                X
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        "apartment"
    ],
    data(){
        return{
            planPopUpVisible: false,
        }
    },
    
    methods:{
        showPlans(){
            this.planPopUpVisible = !this.planPopUpVisible
        },
    }
}
</script>

<style lang="">

</style>