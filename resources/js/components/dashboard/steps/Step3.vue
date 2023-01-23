<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <v-col>
        <v-btn class="btn btn-normal mb-3 mt-3" @click="addFamily()">
          Agregar Familiar
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="12" md="12" xs="12">
        <!-- Family Group -->
        <div class="table-responsive">
          <table class="table table-responsive table-hover">
            <thead>
              <th>Nombre completo</th>
              <th>Parentesco</th>
              <th>Fecha de nacimiento</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              <tr v-for="(familyObject, index) in families" :key="index">
                <td>
                  <p>{{ familyObject.full_name }}</p>
                </td>
                <td>
                  <p>{{ familyObject.kinship_name }}</p>
                </td>
                <td>
                  <p>{{ familyObject.date_birth }}</p>
                </td>
                <td class="text-center">
                  <a
                    @click="deleteFamily(familyObject.id)"
                    class="p-1 mr-1 text-center"
                    ><span class="material-icons text-blue"> delete </span></a
                  >
                </td>
              </tr>
              <tr v-if="families.length == 0">
                <td colspan="5" class="text-center pt-4">
                  <p>No se encontró ningún familiar registrado.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Family Group -->
        <!-- New Family Group -->
        <v-dialog v-model="dialog" max-width="600px" persistent>
          <v-card height="100%">
            <v-container>
              <h3 class="black-secondary text-center mt-4 mb-4">
                Agregar Familiar
              </h3>
              <v-row>
                <!-- Full Name -->
                <v-col cols="12" xs="12" sm="12" md="12">
                  <base-input
                    label="Nombre completo"
                    v-model.trim="$v.family.full_name.$model"
                    :validation="$v.family.full_name"
                    validationTextType="default"
                    :min="1"
                  />
                </v-col>

                <!-- Kinship -->
                <v-col cols="12" xs="12" sm="12" md="6" class="auth">
                  <base-select-search
                    label="Parentesco"
                    v-model.trim="$v.family.kinship_name.$model"
                    :items="kinships"
                    item="kinship_name"
                    :validation="$v.family.kinship_name"
                  />
                </v-col>

                <!-- Birth date -->
                <v-col cols="12" xs="12" sm="12" md="6">
                  <base-input
                    label="Fecha de nacimiento"
                    v-model.trim="$v.family.date_birth.$model"
                    :validation="$v.family.date_birth"
                    type="date"
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col align="center">
                  <v-btn
                    class="btn btn-normal mb-3 mt-1"
                    @click="addNewFamily()"
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
        <!-- New Family Group -->
      </v-col>
    </v-row>
    <v-row>
      <!-- Nominal Fee -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="En caso de emergencia llamar"
          v-model.trim="validation.emergency_full_name.$model"
          :validation="validation.emergency_full_name"
          validationTextType="none"
        />
      </v-col>
      <!-- Kinship -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Parentesco"
          v-model.trim="validation.kinship_name.$model"
          :items="kinships"
          item="kinship_name"
          :validation="validation.kinship_name"
        />
      </v-col>
      <!-- Cell Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Celular"
          v-model.trim="validation.emergency_cell_phone.$model"
          :validation="validation.emergency_cell_phone"
          validationTextType="only-numbers"
          v-mask="'####-####'"
        />
      </v-col>
      <!-- Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Teléfono (Opcional)"
          v-model.trim="validation.emergency_phone.$model"
          :validation="validation.emergency_phone"
          v-mask="'####-####'"
          validationTextType="only-numbers"
        />
      </v-col>
      <!-- Address -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-input
          label="Dirección"
          v-model.trim="validation.emergency_address.$model"
          :validation="validation.emergency_address"
          validationTextType="none"
        />
      </v-col>
    </v-row>

    <v-btn class="btn btn-normal mt-3 mb-3" @click="saveFamilies()">
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
    family: {
      full_name: "",
      kinship_name: "",
      date_birth: "",
    },
    familyDefault: {
      full_name: "",
      kinship_name: "",
      date_birth: "",
    },
    families: [],
  }),

  props: {
    employee: {
      type: Object,
      required: true,
    },
    kinships: {
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
    this.families = this.employee.families;
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
    },

    addFamily() {
      this.dialog = true;

      this.$v.family.full_name.$model = "";
      this.$v.family.kinship_name.$model = "";
      this.$v.family.date_birth.$model = "";

      this.$v.family.$reset();
    },

    async addNewFamily() {
      this.$v.family.$touch();

      if (this.$v.family.$invalid) {
        this.$emit("update-alert", {
          show: true,
          message: "Campos obligatorios",
          type: "fail",
        });

        return;
      }
      this.families.push(this.family);
      this.families = [...new Set(this.families)];

      this.$nextTick(() => {
        this.close();
      });
    },

    close() {
      this.family = this.familyDefault;
      this.$v.family.$reset();
      this.dialog = false;
    },

    saveFamilies() {
      this.validation.$touch();

      if (this.validation.$invalid) {
        this.$emit("update-alert", {
          show: true,
          message: "Campos obligatorios",
          type: "fail",
        });

        return;
      }

      if (this.families.length == 0) {
        this.$emit("update-alert", {
          show: true,
          message:
            "Por favor registrar al menos un miembro de su grupo familiar.",
          type: "fail",
        });

        return;
      }

      this.employee.families = this.families;

      this.$emit("valid-step", {
        validStep: true,
      });
    },

    deleteFamily() {
      this.families.splice(this.families.indexOf(this.family), 1);
    },
  },

  validations: {
    family: {
      full_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      kinship_name: {
        required,
      },
      date_birth: {
        required,
        isValidBirthday: helpers.regex(
          "isValidBirthday",
          /([0-9]{4}-[0-9]{2}-[0-9]{2})/
        ),
        minDate: (value) => value > new Date("1920-01-01").toISOString(),
        maxDate: () => {
          let today = new Date();
          let year = today.getFullYear() - 18;
          let date = today.setFullYear(year);
          return new Date(date).toISOString();
        },
      },
    },
  },
};
</script>
<style></style>
