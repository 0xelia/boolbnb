<template lang="">
    <div>
        <div>
            <button @click="showPlans()">
                Promuovi ora
            </button>
        </div>
        <div v-if="planPopUpVisible">
            <sponsor-component :visible="planPopUpVisible" :setVisible="setVisible"/>
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
            planPopUpVisible: false
        }
    },
    mounted() {
       console.log(this.apartment);
    },
    methods:{
        showPlans(){
            this.planPopUpVisible = true
        },
        setVisible(){
            console.log()
        }
    }
}
</script>

<style lang="">

</style>