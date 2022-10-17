<template>
  <div>
    <b-card>
      <b-alert variant="primary" show>
        <div class="alert-body">
          <b-form inline>
            <span>Actas de Calificaciones</span>

            <label for="" style="margin-left: 5px">Año Electivo</label>
            <b-form-input v-model="anio" style="margin-left: 5px" />
            <label for="" style="margin-left: 5px">Periodo Academico</label>
            <v-select
              style="width: 20%; margin-left: 5px"
              v-model="periodo"
              placeholder="Seleccione"
              label="label"
              item-value="value"
              :options="itemPerios"
            />
          </b-form>
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
        <!-- Column: Actions -->
        <template #cell(REGIME)="data">
          <template v-if="data.value == '1'">
            <b-badge pill variant="light-success"> Malla </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="light-warning"> Interno </b-badge>
          </template>
        </template>
         <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_ID}-send-icon`"
              icon="PrinterIcon"
              class="cursor-pointer"
              size="16"
              @click="modalActa(data.item.SEC_ID)"
            />
            <b-tooltip
              title="Lista de EStudiantes"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.SEC_ID}-send-icon`"
            />

             <feather-icon
              :id="`invoice-row-${data.item.SEC_ID}-preview-icon`"
              icon="PrinterIcon"
              class="cursor-pointer"
              size="16"
              @click="modalActa(data.item.SEC_ID)"
            />
            <b-tooltip
              title="Acta de Calificaciones"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.SEC_ID}-preview-icon`"
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
              v-on:input="vsactmats"
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

    <modal-notify />
  </div>
</template>

<script>
const axios = require("axios").default;
import ModalNotify from "./modals/ModalNotify.vue";
import EventBus from "../assets/js/EventBus";
import vSelect from "vue-select";
const queryString = require("query-string");

export default {
  components: {
    ModalNotify,
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
        { label:'Sección',key: 'SEC_NM', sortable: false },
        { label:'Asignatura',key: 'MAT_NM', sortable: false },
        { label:'Regimen',key: 'REGIME', sortable: false },
        { label:'Docente',key: 'FIR_NM', sortable: false },    
        { label:'Acciones',key: 'actions' },
      ],
    };
  },
  computed: {},
  mounted() {
    this.vsactmats();
  },
  methods: {
    getQueryParameters() {
      return queryString.stringify({
        limit: 10,
        page: this.currentPage,
      });
    },
    vsactmats() {
      let me = this;
      let url = "/vsactmat/records/?" + me.getQueryParameters();
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
    modalActa(SEC_ID) {
      //  EventBus.$emit("ModalNotify", null);
    }, 
    exportExcel() {
      let url = "/vsactmat/excel/";
      window.open(url, "_blank");
    },
    exportPdf() {
      let url = "/vsactmat/pdf/";
      window.open(url, "_blank");
    },
  },
};
</script>

<style>
</style>