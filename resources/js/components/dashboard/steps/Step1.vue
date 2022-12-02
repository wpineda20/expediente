<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- Full name -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-input
          label="Nombre completo según DUI"
          v-model.trim="validation.full_name.$model"
          :validation="validation.full_name"
          validationTextType="none"
        />
      </v-col>

      <!-- Family Status -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Estado Familiar"
          v-model.trim="validation.family_status_name.$model"
          :items="familyStatus"
          item="family_status_name"
          :validation="validation.family_status_name"
        />
      </v-col>

      <!-- Profession -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Profesión"
          v-model.trim="validation.profession_name.$model"
          :items="professions"
          item="profession_name"
          :validation="validation.profession_name"
        />
      </v-col>

      <!-- Current Address -->
      <v-col cols="12" xs="12" sm="12" md="12" class="mb-2">
        <base-text-area
          v-model.trim="validation.current_address.$model"
          :validation="validation.current_address"
          validationTextType="default"
          label="Domicilio actual"
          :min="1"
          :max="150"
          :rows="3"
        />
      </v-col>

      <!-- Departments -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select
          label="Departamento"
          v-model.trim="validation.department_name.$model"
          :items="departments"
          item="department_name"
          :validation="validation.department_name"
          @change="changeDepartment()"
        />
      </v-col>

      <!-- Municipalities -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Municipio"
          v-model.trim="validation.municipality_name.$model"
          :items="municipalities"
          item="municipality_name"
          :validation="validation.municipality_name"
        />
      </v-col>

      <!-- Vurnerable Area -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-select-search
          label="Especifique si el lugar de su domicilio es zona vulnerable"
          v-model.trim="validation.vulnerableArea.$model"
          :items="vulnerableArea"
          item="name"
          :validation="validation.vulnerableArea"
        />
      </v-col>

      <!-- Personal Email -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-input
          label="Correo electrónico (Personal)"
          v-model.trim="validation.personal_email.$model"
          :validation="validation.personal_email"
          validationTextType="none"
        />
      </v-col>

      <!-- Cell Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Celular"
          v-model.trim="validation.cell_phone.$model"
          :validation="validation.cell_phone"
          validationTextType="only-numbers"
          v-mask="'####-####'"
        />
      </v-col>
      <!-- Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Teléfono (Opcional)"
          v-model.trim="validation.phone.$model"
          :validation="validation.phone"
          v-mask="'####-####'"
          validationTextType="only-numbers"
        />
      </v-col>
    </v-row>
    <v-btn class="btn btn-normal mt-3 mb-3" @click="validateData()">
      Continuar y guardar
    </v-btn>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: () => ({
    municipalities: [],
  }),

  props: {
    employee: {
      type: Object,
      required: true,
    },
    familyStatus: {
      type: Array,
      required: true,
      default: () => [],
    },
    vulnerableArea: {
      type: Array,
      required: true,
      default: () => [],
    },
    departments: {
      type: Array,
      required: true,
      default: () => [],
    },
    professions: {
      type: Array,
      required: true,
      default: () => [],
    },
    validation: {
      type: Object,
      required: true,
    },
  },

  methods: {
    initialize() {
      this.employee.department_name =
        this.employee.department_name ?? this.departments[0].department_name;

      this.changeDepartment();
    },

    async changeDepartment() {
      let { data } = await axios
        .get(
          "api/municipality/byDepartmentName/" + this.employee.department_name
        )
        .catch((error) => {
          this.$emit("update-alert", {
            show: true,
            message:
              "No fue posible obtener la información de los municipios. ",
            type: "fail",
          });
        });

      this.municipalities = data.municipalities;
    },
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

      this.$emit("valid-step", {
        validStep: true,
      });
    },
  },
};
</script>
