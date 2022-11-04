<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- Direction -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Dirección"
          v-model.trim="validation.direction_name.$model"
          :items="directions"
          item="direction_name"
          :validation="validation.direction_name"
        />
      </v-col>

      <!-- Sub Direction -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-select-search
          label="Sub Dirección"
          v-model.trim="validation.subdirection_name.$model"
          :items="subdirections"
          item="subdirection_name"
          :validation="validation.subdirection_name"
        />
      </v-col>

      <!-- Unit -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-select-search
          label="Unidad"
          v-model.trim="validation.unit_name.$model"
          :items="units"
          item="unit_name"
          :validation="validation.unit_name"
        />
      </v-col>

      <!-- Nominal Fee -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Cargo nominal"
          v-model.trim="validation.nominal_fee.$model"
          :validation="validation.nominal_fee"
          validationTextType="none"
        />
      </v-col>

      <!-- Functional Position -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Cargo funcional"
          v-model.trim="validation.functional_position.$model"
          :validation="validation.functional_position"
          validationTextType="none"
        />
      </v-col>

      <!-- Immediate Superior -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Jefe inmediato"
          v-model.trim="validation.immediate_superior.$model"
          :validation="validation.immediate_superior"
          validationTextType="none"
        />
      </v-col>

      <!-- Email Institutional -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Correo institucional"
          v-model.trim="validation.email_institutional.$model"
          :validation="validation.email_institutional"
          validationTextType="none"
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
          label="Asignado en el municipio de"
          v-model.trim="validation.municipality_name.$model"
          :items="municipalities"
          item="municipality_name"
          :validation="validation.municipality_name"
        />
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
    departments: {
      type: Array,
      required: true,
      default: () => [],
    },
    directions: {
      type: Array,
      required: true,
      default: () => [],
    },
    subdirections: {
      type: Array,
      required: true,
      default: () => [],
    },
    units: {
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
