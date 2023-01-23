<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <v-col>
        <v-btn class="btn btn-normal mb-3 mt-3" @click="addAcademicLevel()">
          Agregar Nivel Educativo
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="12" md="12" xs="12">
        <!-- Academic Level -->
        <div class="table-responsive">
          <table class="table table-responsive table-hover">
            <thead>
              <th>Nivel educativo</th>
              <th>Centro educativo</th>
              <th>Año de finalización</th>
              <th>Título recibido</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              <tr v-for="(academicObject, index) in academics" :key="index">
                <td>
                  <p>{{ academicObject.level_name }}</p>
                </td>
                <td>
                  <p>{{ academicObject.education_center }}</p>
                </td>
                <td>
                  <p>{{ academicObject.year }}</p>
                </td>
                <td>
                  <p>{{ academicObject.obtained_title }}</p>
                </td>
                <td class="text-center">
                  <a
                    @click="deleteAcademic(academicObject.id)"
                    class="p-1 mr-1 text-center"
                    ><span class="material-icons text-blue"> delete </span></a
                  >
                </td>
              </tr>
              <tr v-if="academics.length == 0">
                <td colspan="5" class="text-center pt-3">
                  <p>No se registró ningún nivel educativo.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
                    @change="finishedCareer()"
                  />
                </v-col>
                <!-- Year -->
                <v-col cols="12" xs="12" sm="12" md="6">
                  <base-input
                    label="Año de finalización"
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
                <!-- Career Status -->
                <v-col cols="12" xs="12" sm="12" md="12" v-show="showCheckbox">
                  <v-checkbox
                    class="mt-0"
                    label="Marcar en caso de no haber finalizado la carrera universitaria"
                    color="primary"
                    v-model.trim="$v.academic.career_status.$model"
                  >
                  </v-checkbox>
                </v-col>
                <!-- Career Name -->
                <v-col
                  cols="12"
                  xs="12"
                  sm="12"
                  md="6"
                  v-show="academic.career_status"
                >
                  <base-input
                    label="Carrera"
                    v-model.trim="$v.academic.career.$model"
                    :validation="$v.academic.career"
                    validationTextType="default"
                    :min="1"
                  />
                </v-col>
                <!-- Subjects Approved -->
                <v-col
                  cols="12"
                  xs="12"
                  sm="12"
                  md="6"
                  v-show="academic.career_status"
                >
                  <base-input
                    label="Materias aprobadas"
                    v-model.trim="$v.academic.subjects_approved.$model"
                    :validation="$v.academic.subjects_approved"
                    validationTextType="only-numbers"
                    v-mask="'##'"
                    type="number"
                    :min="1"
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col align="center">
                  <v-btn
                    class="btn btn-normal mb-3 mt-1"
                    @click="addNewAcademic()"
                    >Agregar</v-btn
                  >
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
    <!-- <v-row>
      <v-col cols="12" xs="12" md="12" lg="12">
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
    </v-row> -->

    <v-btn class="btn btn-normal mt-3 mb-3" @click="saveAcademics()">
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
    showCheckbox: false,
    showCareer: false,
    showSubjectsApproved: false,
    academic: {
      level_name: "",
      education_center: "",
      year: "",
      obtained_title: "",
      career_status: false,
      career: "",
      subjects_approved: "",
    },
    academicDefault: {
      level_name: "",
      education_center: "",
      year: "",
      obtained_title: "",
      career_status: false,
      career: "",
      subjects_approved: "",
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
      this.$v.academic.career_status.$model = false;
      this.$v.academic.career.$model = "";
      this.$v.academic.subjects_approved.$model = "";

      this.$v.academic.$reset();
    },

    async addNewAcademic() {
      this.$v.academic.$touch();

      if (this.$v.academic.$invalid) {
        this.$emit("update-alert", {
          show: true,
          message: "Campos obligatorios",
          type: "fail",
        });

        return;
      }
      this.academics.push(this.academic);
      this.academics = [...new Set(this.academics)];

      this.$nextTick(() => {
        this.close();
      });
    },

    close() {
      this.academic = this.academicDefault;
      this.$v.academic.$reset();
      this.dialog = false;
    },

    saveAcademics() {
      this.validation.$touch();

      if (this.validation.$invalid) {
        this.$emit("update-alert", {
          show: true,
          message: "Campos obligatorios",
          type: "fail",
        });

        return;
      }

      if (this.academics.length == 0) {
        this.$emit("update-alert", {
          show: true,
          message: "Por favor registrar al menos un nivel académico.",
          type: "fail",
        });

        return;
      }

      this.employee.academics = this.academics;

      this.$emit("valid-step", {
        validStep: true,
      });
    },

    deleteAcademic() {
      this.academics.splice(this.academics.indexOf(this.academic), 1);
    },

    finishedCareer() {
      if (this.academic.level_name == "Universitario") {
        this.showCheckbox = true;
      } else {
        this.showCheckbox = false;
      }
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
      career_status: {
        // required,
      },
      career: {
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      subjects_approved: {
        minLength: minLength(1),
        maxLength: maxLength(2),
      },
    },
  },
};
</script>
