<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- Full name -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input label="Nombre completo" />
      </v-col>

      <!-- Artistic name -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input label="Nombre artístico" />
      </v-col>

      <!-- Artistic group name -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-input label="Nombre de grupo artístico/Colectivo/Banda" />
      </v-col>
      <!-- Birth date -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-input label="Fecha de nacimiento" />
      </v-col>

      <!-- Cellphone -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-input
          label="Teléfono comercial"
          v-mask="'####-####'"
          validationTextType="only-numbers"
        />
      </v-col>
      <!-- Phone -->
      <v-col cols="12" xs="12" sm="12" md="4">
        <base-input
          label="Teléfono personal"
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
  props: {},

  methods: {},
};
</script>

<style>
</style>
