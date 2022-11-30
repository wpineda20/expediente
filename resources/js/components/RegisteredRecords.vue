<template>
  <div data-app>
    <alert-time-out
      :redirect="redirectSessionFinished"
      @redirect="updateTimeOut($event)"
    />
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    />
    <v-data-table
      :headers="headers"
      :items="recordsFiltered"
      sort-by="name"
      class="elevation-3 shadow p-3 mt-3"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Expedientes</v-toolbar-title>
          <v-spacer></v-spacer>
          <!-- Modal -->
          <template v-slot:activator="{}">
            <v-row>
              <v-col align="end"> </v-col>
              <v-col xs="6" sm="12" md="6" class="d-none d-md-block d-lg-block">
                <v-text-field
                  dense
                  label="Buscar"
                  outlined
                  type="text"
                  class=""
                  v-model="search"
                  @keyup="searchValue()"
                ></v-text-field>
              </v-col>
            </v-row>
          </template>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
              v-bind="attrs"
              v-on="on"
            >
              mdi-eye
            </v-icon>
          </template>
          <span>Ver detalles</span>
        </v-tooltip>
        <!-- <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <a target="_blank">
              <v-icon
                small
                class="mr-2"
                v-bind="attrs"
                v-on="on"
                @click="downloadProcedures()"
              >
                mdi-download
              </v-icon>
            </a>
          </template>
          <span>Descargar resolución</span>
        </v-tooltip> -->
      </template>

      <template v-slot:no-data>
        <a
          href="#"
          class="btn btn-normal-secondary no-decoration"
          @click="initialize"
        >
          Reiniciar
        </a>
      </template>
    </v-data-table>
  </div>
</template>

<script>
// import activityApi from "../apis/activityApi";

import lib from "../libs/function";

export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "NOMBRE", value: "full_name" },
      { text: "CORREO PERSONAL", value: "personal_email" },
      { text: "CELULAR", value: "cell_phone" },
      { text: "CARGO", value: "nominal_fee" },
      { text: "PROFESIÓN", value: "profession_name" },
      { text: "ACCIÓN", value: "actions", sortable: false },
    ],
    records: [],
    recordsFiltered: [],
    editedIndex: -1,
    editedItem: {
      full_name: "",
      personal_email: "",
      cell_phone: "",
      nominal_fee: "",
      profession_name: "",
    },
    defaultItem: {
      full_name: "",
      personal_email: "",
      cell_phone: "",
      nominal_fee: "",
      profession_name: "",
    },
    resetForm: false,
    failedForm: false,
    saveForm: false,
    closeForm: false,
    dialogActions: false,
    role: "",
    textAlert: "",
    alertEvent: "success",
    showAlert: false,
    redirectSessionFinished: false,
  }),

  computed: {},

  watch: {
    dialog(val) {
      val || this.close();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.records = [];
      this.recordsFiltered = [];

      let requests = [activityApi.get(`/theaterUserRequets`)];
      let responses = await Promise.all(requests).catch((error) => {
        this.updateAlert(true, "No fue posible obtener los registros.", "fail");
        this.redirectSessionFinished = lib.verifySessionFinished(
          error.response.status,
          401
        );
      });
      this.records = responses[0].data.theaterUserRequets;
      //   this.rooms = responses[1].data.rooms;

      this.recordsFiltered = this.records;
    },

    editItem(item) {
      this.dialogActions = true;
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
    },

    searchValue() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";
          for (let i = 0; i < record.activity_name.length; i++) {
            searchConcat += record.activity_name[i].toUpperCase();
            if (
              searchConcat === this.search.toUpperCase() &&
              !this.recordsFiltered.some((rec) => rec == record)
            ) {
              this.recordsFiltered.push(record);
            }
          }
        });
        return;
      }

      this.recordsFiltered = this.records;
    },

    close() {
      this.dialogActions = false;
      this.$nextTick(() => {
        this.editedItem = this.defaultItem;
        this.editedIndex = -1;
      });
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },

    updateTimeOut(event) {
      this.redirectSessionFinished = event;
    },
  },
};
</script>
