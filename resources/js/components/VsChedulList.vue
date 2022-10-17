<template>  
  <div>
      <b-card >
        <b-alert variant="primary" show>
        <div class="alert-body">
          <span> Aula Virtual</span>
 
           <b-button
                size="sm"            
                variant="info"               
                style="float:right;margin-top:-3px;margin-left:3px"     
                @click="modalActividad()"    
              >               
               Agregar Actividad
            </b-button>          
        </div>
      </b-alert>    
      <div class="m-2">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-between flex-wrap">
            <div>
              <b-button
                size="sm"
                class="mr-1"
                variant="success"
                @click="exportExcel"
              >
                <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon>
                Excel
              </b-button>
              <b-button
                size="sm"
                variant="danger"
                class="mr-1"
                 @click="exportPdf"
               >
                <b-icon icon="file-pdf" aria-hidden="true"></b-icon> PDF
              </b-button>

              <!-- <label>Mostrar</label> -->
              <!-- <v-select
                v-model="perPage"
            
                :options="perPageOptions"
                :clearable="false"
                class="per-page-selector d-inline-block mb-2"
              /> -->
            </div>

            <div>
              <div class="justify-content-end">
                <b-form-input
                  v-model="searchTerm"
                  placeholder="Buscar"
                  type="text"
                  class="d-inline-block"
                />
              </div>
            </div>
          </b-col>
        </b-row>
      </div>

    <b-table       
        :items="items"
        responsive
        :fields="Columns"
        primary-key="id"       
        show-empty
        empty-text="No matching records found"     
        class="position-relative"
      >       

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_ID}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
       
            />
            <b-tooltip
              title="Acta de Matricula"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.SEC_ID}-send-icon`"
            />
          </div>
        </template>
      </b-table>       
    
      <div class="mx-2 mb-2">
        <b-row>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-start
            "
          >
           
          </b-col>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-end
            "
          >        
           <b-pagination
              v-model="currentPage"
              :total-rows="total_pages"
              :per-page="perPage"
              v-on:input="vscheduls"
              first-number
              last-number
              class="mb-0 mt-1 mt-sm-0"
              prev-class="prev-item"
              next-class="next-item"
            >
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>  
          </b-col>
        </b-row>
      </div>
    </b-card>

      <modal-actividad/>
  </div>
</template>

<script>

const axios = require("axios").default;
import ModalActividad from "./modals/ModalActividad.vue";
import EventBus from "../assets/js/EventBus";

const queryString = require("query-string");


export default {
 components: {
   ModalActividad
  },
  data() {
    return {
      items:[],
      show: false,    
      searchTerm: null,
      perPage: 1,
      currentPage: 1,
      total_pages: 0,
      Columns : [
          { label:'FEcha',key: 'FECREG', sortable: false },
          { label:'Seccion',key: 'SEC_NM', sortable: false },
          { label:'Asignatura',key: 'MAT_NM', sortable: false },
          { label:'Estudiante.',key: 'LAS_NM', sortable: false },
          { label:'PUNTAJ ',key: 'PUNTAJ', sortable: false },
          { label:'SCHEDU',key: 'SCHEDU', sortable: false },         
          { label:'Acciones',key: 'actions' },
        ]     
    };
  },
  computed: {},
  mounted() {
    
    this.vscheduls();
  },
  methods: {
    getQueryParameters(){
      return queryString.stringify({
        limit: 10,
        page: this.currentPage,
      });
    },
    vscheduls(){
      let me = this;     
      let url = "/vschedul/records/?"+me.getQueryParameters();
      axios({
        method: "GET",
        url: url,
      }).then((response) => {    
        console.log(response);    
        const { status, result } = response.data;       
         me.items=result.data;
         me.total_pages = result.pagination.total_pages;
      });
    },
    modalActividad(SEC_ID){
        EventBus.$emit("ModalActividad", null);
    },
    viewFicha(SEC_ID){

    },
    exportExcel(){
       let url = "/vschedul/excel/";
       window.open(url, "_blank");
    },
    exportPdf  ()  {
      let url = "/vschedul/pdf/";
      window.open(url, "_blank");
    }
  },
};
</script>

<style>

</style>