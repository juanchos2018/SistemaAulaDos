<template>
  <div>
    <h5>COMPONETE DE VUJE WE</h5>
    <b-button v-b-toggle.collapse-2 class="m-1">Toggle Collapse</b-button>

    <!-- Using value -->
    <b-button v-b-toggle="'collapse-2'" class="m-1">Toggle Collapse</b-button>

    <!-- Element to collapse -->
    <b-collapse id="collapse-2">
        <b-card>I am collapsible content!</b-card>
    </b-collapse>
    
    </div>   

</template>

<script>
export default {

}
</script>

<style>

</style>