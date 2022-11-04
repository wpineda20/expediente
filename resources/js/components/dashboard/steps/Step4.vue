<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <v-col>
        <v-btn class="btn btn-normal mb-3 mt-3" @click="addAcademicLevel()">
          Agregar
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="12" md="12" xs="12">
        <!-- Academic Level -->
        <table class="table table-responsive-md table-hover">
          <thead>
            <th>Nivel educativo</th>
            <th>Centro educativo</th>
            <th>Año</th>
            <th>Título recibido</th>
            <th class="text-center">Acciones</th>
          </thead>
          <tbody>
            <tr>
              <td>
                <p></p>
              </td>
              <td>
                <p></p>
              </td>
              <td>
                <p></p>
              </td>
              <td>
                <p></p>
              </td>
              <td class="text-center">
                <a class="p-1 mr-1 text-center"
                  ><span class="material-icons text-blue"> delete </span></a
                >
              </td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">
                <p>No se encontró ningún registro.</p>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- Academic Level -->
        <!-- New Academic Level -->
        <v-dialog v-model="dialog" max-width="600px" persistent>
          <v-card height="100%">
            <v-container>
              <h3 class="black-secondary text-center mt-4 mb-4">
                Agregar Nivel Educativo
              </h3>
              <v-row>
                <!-- Academic Level -->
                <v-col cols="12" xs="12" sm="12" md="6" class="auth">
                  <base-select-search
                    label="Nivel educativo"
                    v-model.trim="$v.academic.level_name.$model"
                    :items="academicLevels"
                    item="level_name"
                    :validation="$v.academic.level_name"
                  />
                </v-col>
                <!-- Year -->
                <v-col cols="12" xs="12" sm="12" md="6">
                  <base-input
                    label="Año"
                    v-model.trim="$v.academic.year.$model"
                    :validation="$v.academic.year"
                    v-mask="'####'"
                    type="number"
                    :min="1"
                  />
                </v-col>
                <!-- Education Center -->
                <v-col cols="12" xs="12" sm="12" md="12">
                  <base-input
                    label="Centro educativo"
                    v-model.trim="$v.academic.education_center.$model"
                    :validation="$v.academic.education_center"
                    validationTextType="default"
                    :min="1"
                  />
                </v-col>
                <!-- Obtained Title -->
                <v-col cols="12" xs="12" sm="12" md="12">
                  <base-input
                    label="Título recibido"
                    v-model.trim="$v.academic.obtained_title.$model"
                    :validation="$v.academic.obtained_title"
                    validationTextType="default"
                    :min="1"
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col align="center">
                  <v-btn class="btn btn-normal mb-3 mt-1">Agregar</v-btn>
                  <v-btn
                    color="btn-normal-close mb-3 mt-1"
                    rounded
                    @click="close()"
                  >
                    Cancelar
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-dialog>
        <!-- New Academic Level -->
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" xs="12" md="12" lg="12">
        <!-- Subjects Approved -->
        <h6 class="mb-5">
          En caso de haber estudiado una carrera universitaria y no fue
          finalizada, establezca cuantas materias aprobó:
        </h6>
        <v-col cols="12" xs="12" sm="12" md="6">
          <base-input
            label="Materias aprobadas"
            v-model.trim="validation.subjects_approved.$model"
            :validation="validation.subjects_approved"
            validationTextType="only-numbers"
            v-mask="'##'"
            type="number"
            :min="1"
          />
        </v-col>
      </v-col>
    </v-row>

    <v-btn class="btn btn-normal mt-3 mb-3" @click="validateData()">
      Continuar y guardar
    </v-btn>
    <v-btn class="btn btn-normal-close mt-3 mb-3" @click="$emit('get-back')"
      >Volver</v-btn
    >
  </div>
</template>

<script>
import {
  required,
  minLength,
  maxLength,
  helpers,
} from "vuelidate/lib/validators";
// import { httpsValid } from "../../../libs/function";

export default {
  data: () => ({
    dialog: false,
    academic: {
      level_name: "",
      education_center: "",
      year: "",
      obtained_title: "",
    },
    academicDefault: {
      level_name: "",
      education_center: "",
      year: "",
      obtained_title: "",
    },
    academics: [],
  }),

  props: {
    employee: {
      type: Object,
      required: true,
    },
    academicLevels: {
      type: Array,
      required: true,
      default: () => [],
    },
    validation: {
      type: Object,
      required: true,
    },
  },

  mounted() {
    this.academics = this.employee.academics;
  },

  methods: {
    validateData() {
      this.validation.$touch();

      if (this.validation.$invalid) {
        this.$emit("update-alert", {
          show: true,
          message: "Campos obligatorios",
          type: "fail",
        });

        return;
      }
      //   this.$emit("valid-step", {
      //     validStep: true,
      //   });
    },

    addAcademicLevel() {
      this.dialog = true;

      this.$v.academic.level_name.$model = "";
      this.$v.academic.education_center.$model = "";
      this.$v.academic.year.$model = "";
      this.$v.academic.obtained_title.$model = "";

      this.$v.academic.$reset();
    },

    close() {
      this.academic = this.academicDefault;
      this.$v.academic.$reset();
      this.dialog = false;
    },
  },

  validations: {
    academic: {
      level_name: {
        required,
      },
      education_center: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      year: {
        required,
        isValidYear: helpers.regex("isValidYear", /[0-9]{4}/),
      },
      obtained_title: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
    },
  },
};
</script>
