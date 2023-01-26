<template>
  <v-container fluid>
    <alert-time-out :key="alertTimeOut" :redirect="redirectSessionFinished" />
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
                    @keyup="searchUser()"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="registeredRecords"
              :options.sync="options"
              :server-items-length="total"
              :footer-props="{ itemsPerPageOptions: [50] }"
              :items-per-page="take"
              @update:options="updatePagination"
              :page.sync="actualPage"
              :single-expand="singleExpand"
              :expanded.sync="expanded"
              item-key="employee_id"
              show-expand
              class="elevation-1"
            >
              <template v-slot:expanded-item="{ headers, item }">
                <td :colspan="headers.length" class="w-100">
                  <record-registered
                    :registeredRecordSelected="item.employee_id"
                    :key="item.employee_id"
                  />
                </td>
              </template>
              <!-- <template v-slot:no-data>
                <v-icon small class="mr-2" @click="loadMore">
                  mdi-refresh
                </v-icon>
              </template> -->
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

export default {
  data() {
    return {
      search: "",
      singleExpand: true,
      headers: [
        // {
        //   text: "USUARIO",
        //   align: "start",
        //   sortable: true,
        //   value: "user_name",
        // },
        { text: "NOMBRE", value: "full_name" },
        { text: "CORREO INSTITUCIONAL", value: "full_name" },
        { text: "FECHA DE ACTUALIZACIÓN", value: "personal_email" },
        { text: "SECCIÓN ACTUALIZADA", value: "cell_phone" },
        // { text: "CARGO", value: "nominal_fee" },
        { text: "ESTADO", value: "status_name" },
        //   { text: "PROFESIÓN", value: "profession_name" },
        //   { text: "ACCIÓN", value: "actions", sortable: false },
      ],
      registeredRecords: [],
      registeredRecordSelected: "",
      counter: 0,
      loading: false,
      dialog: false,
      skip: 0,
      take: 50,
      title: "Acciones",
      filter: "Registrado",
      numberItemsToAdd: 50,
      total: 0,
      loadMoreItems: false,
      options: {},
      actualPage: 1,
      expanded: [],
      redirectSessionFinished: false,
      alertTimeOut: 0,
    };
  },

  watch: {
    options: {
      handler() {
        this.loadMore();
      },
      deep: false,
    },
  },

  methods: {
    initializeVerification() {
      this.dialog = true;
    },

    async getRegisteredRecord(id) {
      this.registeredRecordSelected = id;
      this.counter++;
    },

    async loadMore(filter = "Registrado") {
      this.filter = filter;
      if (this.actualPage == 1) {
        this.actualPage = 1;
        this.skip = 0;
        this.take = this.numberItemsToAdd;
      }
      const res = await axios
        .get("api/employee/registeredRecords", {
          params: { skip: this.skip, take: this.take, filter: filter },
        })
        .catch((error) => {
          this.verifySessionFinished(error.response.status, 401);
          this.alertTimeOut++;
        });

      this.verifySessionFinished(res.status, 200);
      this.alertTimeOut++;

      this.registeredRecords = res.data.registeredRecords;
      this.total = res.data.total;
    },

    updatePagination(pagination) {
      if (pagination.page != 1) {
        // Si la página es distinta de 1, verifica los datos a tomar y quitar
        if (pagination.page <= this.actualPage) {
          //Si la página es menor que la actual, se está retrocediendo
          this.take = this.skip;
          this.skip = this.take - this.numberItemsToAdd;
        } else {
          //Sino, se está aumentando en la cantidad de usuarios por ver
          this.skip = this.take;
          this.take += this.numberItemsToAdd;
        }
      } else {
        //Si es igual a cero, es la vista inicial
        this.skip = 0;
        this.take = this.numberItemsToAdd;
      }
      this.actualPage = pagination.page;
      //   console.log(this.skip, this.take);
    },

    async searchUser() {
      clearTimeout(this.timeOut);
      this.timeOut = setTimeout(async () => {
        this.skip = 0;
        this.take = this.numberItemsToAdd;

        if (this.search == "") {
          this.loadMore();
          return;
        }

        const res = await axios
          .post("api/employee/registeredRecords/search", {
            skip: this.skip,
            take: this.take,
            search: this.search,
          })
          .catch((error) => {
            this.verifySessionFinished(error.response.status, 419);
          });

        this.verifySessionFinished(res.status, 200);
        this.registeredRecords = res.data.registeredRecords;
        this.total = res.data.total;
        this.alertTimeOut++;
      }, 750);
    },

    verifySessionFinished(status, code) {
      if (status == code) {
        if (status == 419 || status == 401) {
          this.redirectSessionFinished = true;
        }
        this.alertTimeOut++;
      }
    },

    async filterRecords(filter = "Registrado") {
      this.filter = filter;

      const res = await axios
        .get("api/employee/registeredRecords", {
          params: { skip: this.skip, take: this.take, filter: filter },
        })
        .catch((error) => {
          this.verifySessionFinished(error.response.status, 401);
          this.alertTimeOut++;
        });

      this.verifySessionFinished(res.status, 200);
      this.alertTimeOut++;

      this.registeredRecords = res.data.registeredRecords;
      this.total = res.data.total;
    },
  },
};
</script>
<style >
.v-tabs-slider {
  background: #2d52a8 !important;
}
</style>