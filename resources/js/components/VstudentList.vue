<template>  
  <div>
      <b-card >
        <b-alert variant="primary" show>
        <div class="alert-body">
          <span> Ficha Estudiantil</span>
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
             
              >
                <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon>
                Excel
              </b-button>
              <b-button
                size="sm"
                variant="danger"
                class="mr-1"
             
              >
                <b-icon icon="file-pdf" aria-hidden="true"></b-icon> PDF
              </b-button>

              <label>Mostrar</label>
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
      <template #cell(IDTYPE)="data">
          <template v-if="data.value === '05'">
            <b-badge pill variant="light-success"> Cèdula </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> otro </b-badge>
          </template>
        </template>

        <template #cell(ESTATU)="data">
          <template v-if="data.value === 2">
            <b-badge pill variant="light-success"> Matriculado </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> No Matriculado </b-badge>
          </template>
        </template>

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.STD_NO}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
     
            />
            <b-tooltip
              title="Editar"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.STD_NO}-send-icon`"
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
              v-on:input="vsstudents"
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

      <modal-malla/>
  </div>
</template>

<script>

const axios = require("axios").default;
import ModalMalla from "./modals/ModalMalla.vue";
import EventBus from "../assets/js/EventBus";

const queryString = require("query-string");


export default {
 components: {
   ModalMalla
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
            { label:'Año',key: 'PERIOS', sortable: false },
            { label:'Estudiante',key: 'LAS_NM', sortable: false },
            { label:'Tipo Id',key: 'IDTYPE', sortable: false },
            { label:'No ID.',key: 'IDE_NO', sortable: false },
            { label:'Estado',key: 'ESTATU', sortable: false },
            { label:'Seccion',key: 'SEC_NM', sortable: false },   
            { label:'Acciones',key: 'actions' },
        ]     
    };
  },
  computed: {},
  mounted() {
    
    this.vsstudents();
  },
  methods: {
    getQueryParameters(){
      return queryString.stringify({
        limit: 10,
        page: this.currentPage,
      });
    },
    vsstudents(){
      let me = this;     
      let url = "/vstudent/records/?"+me.getQueryParameters();
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
    detailMalla(SEC_ID){
        EventBus.$emit("ModalMalla", SEC_ID);
    },
    viewFicha(SEC_ID){

    }    
  },
};
</script>

<style>

</style>