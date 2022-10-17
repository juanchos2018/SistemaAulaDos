<template>
  <div>
    <b-card>
      <b-alert variant="primary" show>
        <div class="alert-body">
        
            <span> Boletines por Sección</span>

            
          <!-- <b-row>
            <b-col md="3">
              <span> Boletín por Estudiante</span>
            </b-col>
            <b-col md="64">
              <b-form-group label="Orden" label-for="mc-country">
                <b-form-input v-model="anio" />
              </b-form-group>
            </b-col>
            <b-col md="4">
              <b-form-group label="Peridodo">
                <v-select
                  v-model="periodo"
                  label="label"
                  item-value="value"
                  :options="itemPerios"
                />
              </b-form-group>
            </b-col>
          </b-row> -->
        </div>
      </b-alert>
      <div class="m-2">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-between flex-wrap">
            <div>
              <!-- <b-button
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
              </b-button> -->

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
        <template #cell(JOR_NO)="data">
                <template v-if="data.value == 1">
                    <b-badge pill variant="light-success"> Matutina </b-badge>
                </template>
                <template v-else>
                    <b-badge pill variant="danger">Noche </b-badge>
                </template>
             </template>
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_NO}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
               @click="modalBoletin(data.item.SEC_NO)"
            />
            <b-tooltip
              title="Acta de Matricula"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.SEC_NO}-send-icon`"
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
              v-on:input="vslibsecs"
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

    <modal-boletin/>
  </div>
</template>

<script>
const axios = require("axios").default;
import ModalBoletin from "./modals/ModalBoletin.vue";
import EventBus from "../assets/js/EventBus";
import vSelect from "vue-select";
const queryString = require("query-string");

export default {
  components: {
    ModalBoletin,
    vSelect,
  },
  data() {
    return {
      items: [],
      show: false,
      anio: "2022",
      periodo: null,
      searchTerm: null,
      perPage: 1,
      currentPage: 1,
      total_pages: 0,
      itemPerios: [
        { value: "1", label: "Quinto 3 Parcial" },
        { value: "0", label: "Quimiestre" },
      ],
      Columns: [
        { label:'Nombre de Sección',key: 'SEC_NM', sortable: false },    
        { label:'Paralelo',key: 'PARALE', sortable: false },
        { label:'Jornada',key: 'JOR_NO', sortable: false },   
        { label:'Acciones',key: 'actions' },
      ],
    };
  },
  computed: {},
  mounted() {
    this.vslibsecs();
  },
  methods: {
    getQueryParameters() {
      return queryString.stringify({
        limit: 10,
        page: this.currentPage,
      });
    },
    vslibsecs() {
      let me = this;
      let url = "/vslibsec/records/?" + me.getQueryParameters();
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        console.log(response);
        const { status, result } = response.data;
        me.items = result.data;
        me.total_pages = result.pagination.total_pages;
      });
    },
    modalBoletin(SEC_NO) {
       EventBus.$emit("ModalBoletin", null);
    }, 
    exportExcel() {
      let url = "/vslibsec/excel/";
      window.open(url, "_blank");
    },
    exportPdf() {
      let url = "/vslibsec/pdf/";
      window.open(url, "_blank");
    },
  },
};
</script>

<style>
</style>