<template>
  <b-modal
    id="modal-1"
    title="Nueva Notificacion"
    hide-footer
    v-model="show"
    size="lg"
  >
    <b-form @submit.prevent>
      <b-row>
        <b-col md="6">
          <b-form-group label="Año Lectivo" label-for="ano_electivo">
             <b-form-input id="ano_electivo"  />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Fecha " label-for="fecha-asistencia">
             <flat-pickr
              v-model="dateDefault"
              class="form-control"
            />           
          </b-form-group>
        </b-col>
        <b-col md="12">
          <b-form-group label="Seccion" >
          <v-select
              v-model="selected"
          
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
        <b-col md="12">
          <b-form-group label="Asignatura" label-for="mc-country">
          <v-select
              v-model="selected"
          
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
        <b-col md="12">
          <b-form-group label="Estudiante" >
            <v-select
              v-model="selected"
             
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
     

        <b-col md="12">
          <b-form-group label="Descripcion" label-for="mc-city">
              <b-form-textarea
                  id="textarea-default"
                  placeholder="Descripcion"
                  rows="3"
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
    EventBus.$on("ModalNotify", (id) => {
      this.show = true;
    });
  },
  methods: {},
};
</script>

<style lang="scss">
//@import '~@resources/scss/vue/libs/vue-flatpicker.scss';
</style>
 