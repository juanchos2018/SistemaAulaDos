<template>
  <b-modal
    id="modal-1"
    title="Boletin por Sección"
    hide-footer
    v-model="show"
   
  >
  <!--  size="lg" -->
    <b-form @submit.prevent>
      <b-row>
        <b-col md="12">
          <b-form-group label="Sección" >
          <v-select
              v-model="selected"         
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Año Lectivo" >
               <b-form-input id="mc-country" placeholder="2021" />      
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Periodo" >
          <v-select
              v-model="selected"
       
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>


        <b-col>
              <b-button
       
                type="submit"
                variant="primary"
                class="mr-1"
              >
                Guardar
              </b-button>
              <b-button
                @click="show=false"
                variant="outline-secondary"
              >
                Cancelar
              </b-button>
            </b-col>

        <!-- submit and reset -->
      </b-row>
    </b-form>
  </b-modal>
</template>

<script>
import EventBus from "../../assets/js/EventBus";
import vSelect from "vue-select";
import Cleave from "vue-cleave-component";
import "cleave.js/dist/addons/cleave-phone.us";
import flatPickr from 'vue-flatpickr-component'
export default {
  components: { vSelect, Cleave,flatPickr },
  directives: {  },
  data() {
    return {
      show: false,
      selected: { title: "Square" },
      dateDefault: null,
      fecha: null,
      option: [
        { title: "Opcion 1" },
        { title: "Opcion 2" },
        { title: "Opcion 3" },
        { title: "Opcion 4" },
      ],
      optionsInput: {
        creditCard: {
          creditCard: true,
        },
        date: {
          date: true,
          delimiter: "-",
          //datePattern: ['Y', 'm', 'd'],
          datePattern: ["d", "m", "Y"],
        },
      },
    };
  },
  computed: {},
  mounted() {
    EventBus.$on("ModalBoletin", (id) => {
      this.show = true;
    });
  },
  methods: {},
};
</script>

