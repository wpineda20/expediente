<template>
  <v-container fluid>
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    />
    <!-- <alert-time-out :key="alertTimeOut" :redirect="redirectSessionFinished" /> -->
    <div data-app>
      <v-container fluid>
        <div v-if="!loading">
          <v-card>
            <v-card-title>
              <v-row>
                <v-col align="start" cols="12" xs="12" sm="6" md="6">
                  {{ title }}
                </v-col>
                <v-spacer></v-spacer>
                <v-col
                  xs="6"
                  sm="6"
                  md="6"
                  class="d-none d-md-block d-lg-block"
                >
                  <v-text-field
                    dense
                    label="Buscar"
                    outlined
                    type="text"
                    class=""
                    v-model="search"
                    @keyup="searchEmployee()"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="recordsFiltered"
              :loading="loading"
              :footer-props="{ 'items-per-page-options': [15, 30, 50, 100] }"
            >
              <template v-slot:no-data>
                <v-icon small class="mr-2" @click="initialize">
                  mdi-refresh
                </v-icon>
              </template>
            </v-data-table>
          </v-card>
        </div>
        <v-row v-else class="mt-3">
          <v-col cols="12" xs="12" sm="12" md="12" align="center">
            <loader />
          </v-col>
        </v-row>
      </v-container>
    </div>
  </v-container>
</template>

<script>
import axios from "axios";
import { format } from "date-fns";
import esEsLocale from "date-fns/locale/es";

export default {
  data() {
    return {
      search: "",
      headers: [
        { text: "EMPLEADO", value: "full_name" },
        { text: "FECHA DE ACTUALIZACIÓN", value: "record_updated" },
        { text: "SECCIÓN ACTUALIZADA", value: "id_section" },
        { text: "ESTADO", value: "status_name" },
      ],
      records: [],
      recordsFiltered: [],
      counter: 0,
      loading: false,
      title: "Acciones",
      totalItems: 0,
      textAlert: "",
      alertEvent: "success",
      showAlert: false,
      redirectSessionFinished: false,
      alertTimeOut: 0,
    };
  },

  mounted() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.records = [];
      this.recordsFiltered = [];

      let res = await axios.post("api/action/log").catch((error) => {
        this.updateAlert(true, "No fue posible obtener el registro.", "fail");
      });

      this.recordsFiltered = res.data.employeeActions;

      this.records = this.recordsFiltered;

      this.setDate();
      this.setSection();
    },

    searchEmployee() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";
          for (let i = 0; i < record.full_name.length; i++) {
            searchConcat += record.full_name[i].toUpperCase();
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

    setDate() {
      this.recordsFiltered.forEach((employee) => {
        employee.record_updated = format(
          new Date(employee.record_updated),
          "EEEE, dd MMMM, yyyy",
          {
            locale: esEsLocale,
          }
        );
      });
    },

    setSection() {
      this.recordsFiltered.forEach((employee) => {
        if (employee.id_section == 1) {
          employee.id_section = "Datos personales";
        }
        if (employee.id_section == 2) {
          employee.id_section = "Datos laborales";
        }
        if (employee.id_section == 3) {
          employee.id_section = "Grupo familiar";
        }
        if (employee.id_section == 4) {
          employee.id_section = "Formación Académica";
        }
        if (employee.id_section == 5) {
          employee.id_section = "Anexar Documentos";
        }
      });
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },
  },
};
</script>
<style >
.v-tabs-slider {
  background: #2d52a8 !important;
}
</style>