<template lang="">
    <div class="static">
        <div>
            <button class="p-1 rounded sponsor" @click="showPlans()">
                Promuovi ora
            </button>
        </div>
        <div  v-if="planPopUpVisible">
            <sponsor-component @show-plans="showPlans"  :apartment="apartment" />
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

<style lang="scss" scoped>
    .sponsor{
        background-color: #F5DF19;
    }
</style>