<template>
  <div class="pt-3">
    <a href="#" @click="clickInputFile()" class="button-center">
      <i class="material-icons icon-center">folder</i> {{ label }}
    </a>
    <v-container v-if="fileName !== ''">
      <p>Archivo: {{ fileName }}</p>
    </v-container>
    <input
      type="file"
      ref="inputFile"
      class="d-none p-3"
      @change="updateFile"
      :accept="accept"
    />
    <v-container class="mb-0 pt-0 my-auto orange-text">
      <template v-if="!validationsInput.required">
        <v-row class="pt-0" v-if="!validationsInput.required">
          <p class="mb-0 mt-1 text-muted">(Campo opcional)</p>
        </v-row>
      </template>
      <template>
        <v-row
          v-if="
            validation.$error && validationsInput.required && validation.$dirty
          "
          class="pt-0"
        >
          <p class="mb-0 mt-1">
            <i class="material-icons">error_outline</i> Campo requerido.
          </p>
        </v-row>
      </template>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fileName: "",
      sizeFile: "",
    };
  },

  updated() {
    // this.file = this.validation.$model;
  },

  props: {
    validation: {
      type: Object,
      default: "",
    },
    validationsInput: {
      type: Object,
      default: () => {
        return {
          required: true,
        };
      },
    },
    file: {
      type: String,
      default: "",
    },
    accept: {
      type: String,
      default: "*",
    },
    label: {
      type: String,
      default: "Seleccionar archivo",
    },
  },

  watch: {
    file(val) {
      this.filePreview = this.file;
    },
  },

  update() {
    this.filePreview = this.file;
  },

  mounted() {
    this.filePreview = this.file;
  },

  methods: {
    async updateFile(e) {
      const size = e.target.files[0].size / 1024 / 1024;
      if (size > 5) {
        this.$emit("file-size-exceeded", true);
        return;
      }
      const file = await this.toBase64(e.target.files[0]);
      this.fileName = e.target.files[0].name;
      this.$emit("update-file", file);
    },

    async toBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
      });
    },

    clickInputFile() {
      this.$refs.inputFile.click();
    },
  },
};
</script>

<style scoped>
.icon-center {
  vertical-align: middle;
}

.button-center {
  display: flex;
  align-items: center;
}
</style>
