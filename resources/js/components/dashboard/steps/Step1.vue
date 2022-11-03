<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- Full name -->
      <v-col cols="12" xs="12" sm="12" md="12">
        <base-input label="Nombre completo según DUI" />
      </v-col>

      <!-- Family Status -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-select-search label="Estado familiar" />
      </v-col>

      <!-- Profession -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-select-search label="Profesión" />
      </v-col>

      <!-- Current Address -->
      <v-col cols="12" xs="12" sm="12" md="12" class="mb-2">
        <base-text-area
          label="Domicilio actual"
          v-model.trim="validation.address.$model"
          :validation="validation.address"
          validationTextType="default"
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
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-select-search label="Área vulnerable" />
      </v-col>

      <!-- Email -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Correo electrónico"
          v-model.trim="validation.email.$model"
          :validation="validation.email"
          validationTextType="none"
          :readonly="true"
        />
      </v-col>

      <!-- Cellphone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Teléfono"
          v-mask="'####-####'"
          validationTextType="only-numbers"
        />
      </v-col>
      <!-- Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Celular"
          validationTextType="only-numbers"
          v-mask="'####-####'"
        />
      </v-col>
    </v-row>
    <v-btn class="btn btn-normal mt-3 mb-3" @click="validateData()">
      Continuar y guardar
    </v-btn>
  </div>
</template>

<script>
export default {
  props: {
    validation: {
      type: Object,
      required: true,
    },
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

      this.$emit("valid-step", {
        validStep: true,
      });
    },
  },
};
</script>

<style>
</style>
