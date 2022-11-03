<template>
  <div class="mb-1 mt-4 h-100">
    <v-row>
      <!-- Nominal Fee -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="En caso de emergencia llamar"
          v-model.trim="validation.full_name.$model"
          :validation="validation.full_name"
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
          v-model.trim="validation.cell_phone.$model"
          :validation="validation.cell_phone"
          validationTextType="only-numbers"
          v-mask="'####-####'"
        />
      </v-col>
      <!-- Phone -->
      <v-col cols="12" xs="12" sm="12" md="6">
        <base-input
          label="Teléfono"
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
export default {
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
