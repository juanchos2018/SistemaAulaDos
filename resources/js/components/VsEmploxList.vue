<template>
  
  <div>
      <b-card >
        <b-alert variant="primary" show>
        <div class="alert-body">
          <span> Ficha Personal</span>
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

              <label>Mostrar</label>
              <!-- <v-select
                v-model="perPage"
                :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
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
        ref="refVsemploxTable"
        :items="items"
        responsive
        :fields="Columns"
        primary-key="id"
 
        show-empty
        empty-text="No matching records found"
     
        class="position-relative"
      >
       
<template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.EMP_NO}-preview-icon`"
              icon="EyeIcon"
              size="16"
              class="mx-1"
              @click="viewFicha(data.item.EMP_NO)"
            />
            <b-tooltip
              title="Consultar"
              :target="`invoice-row-${data.item.EMP_NO}-preview-icon`"
            />
            <feather-icon
              :id="`invoice-row-${data.item.EMP_NO}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
              @click="detailFicha(data.item.EMP_NO)"
            />
            <b-tooltip
              title="Editar"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.EMP_NO}-send-icon`"
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
          
          </b-col>
        </b-row>
      </div>
    </b-card>

      <modal-ficha />
  </div>
</template>

<script>

const axios = require("axios").default;
import ModalFicha from "./modals/ModalFicha.vue";
import EventBus from "../assets/js/EventBus";
export default {
 components: {
   ModalFicha
  },
  data() {
    return {
      items:[],
      show: false,    
      searchTerm: null,
      Columns : [
            { label:'#',key: 'id',  sortable: false },
            { label:'Nombre',key: 'LAS_NM', sortable: false },
            { label:'Apellido',key: 'FIR_NM', sortable: false },
            { label:'Tipo Id',key: 'IDTYPE', sortable: false },
            { label:'No. Id',key: 'IDE_NO', sortable: false },
            { label:'Estado',key: 'ESTATU', sortable: false },
            { label:'Direccion',key: 'ADDRES', sortable: false },    
            { label:'Telefono',key: 'TPHONE', sortable: false },
            { label:'Acciones',key: 'actions' },
        ]
     
    };
  },
  computed: {},
  mounted() {
    
    this.tables();
  },
  methods: {
    tables(){
      let me = this;     
      let url = "/vsemblox/records/";
      axios({
        method: "GET",
        url: url,
      }).then((response) => {        
        const { status, result } = response.data;       
         me.items=result.data;
      });
    },
    detailFicha(EMP_NO){
        EventBus.$emit("ModalFicha", EMP_NO);
    },
    viewFicha(EMP_NO){

    },
    exportExcel(){
      let url = "/vsemblox/excel";
      window.open(url, "_blank");
    },
    exportPdf(){
       let url = "/vsemblox/pdf";
       window.open(url, "_blank");
    }    
  },
};
</script>

<style>

</style>