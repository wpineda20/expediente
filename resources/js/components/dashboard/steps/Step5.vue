<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- DUI File -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <h6 class="mb-0">Copia de su Documento Único de Identidad (PDF).</h6>
        <input-file
          accept="application/pdf"
          v-model="validation.dui_file.$model"
          :validation="validation.dui_file"
          @update-file="employee.dui_file = $event"
          @file-size-exceeded="$emit('file-size-exceeded', true)"
        />
        <!-- <input-image
          v-model="validation.dui_file.$model"
          :validation="validation.dui_file"
          :image="employee.dui_file"
          @update-image="employee.dui_file = $event"
        />
        <span class="text-left">(Máximo 5MB)</span> -->
      </v-col>
      <!-- Title File -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <h6 class="mb-0">
          Copia de Título o Diploma si adquirió alguno (PDF).
        </h6>
        <input-file
          accept="application/pdf"
          v-model="validation.title_file.$model"
          :validation="validation.title_file"
          @update-file="employee.title_file = $event"
          @file-size-exceeded="$emit('file-size-exceeded', true)"
        />
        <!-- <input-image
          v-model="validation.title_file.$model"
          :validation="validation.title_file"
          :image="employee.title_file"
          @update-image="employee.title_file = $event"
        />
        <span class="text-left">(Máximo 5MB)</span> -->
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" xs="12" sm="12" md="12">
        <h6 class="pt-4 pb-2">
          Fecha de registro:
          <span class="color-blue">
            {{ currentDate() }}
          </span>
        </h6>
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
  props: {
    employee: {
      type: Object,
      required: true,
    },
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

    currentDate() {
      const current = new Date();
      const date = `${current.getDate()}/${
        current.getMonth() + 1
      }/${current.getFullYear()}`;
      return date;
    },
  },
};
</script>
