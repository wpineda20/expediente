<template>
  <div div-app ref="top">
    <alert-time-out :key="alertTimeOut" :redirect="redirectSessionFinished" />
    <!-- <alert-time-out
      :redirect="redirectSessionFinished"
      @redirect="updateTimeOut($event)"
    />
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    /> -->
    <v-row>
      <v-col cols="12" md="11" sm="11" class="mx-auto">
        <div class="card-body shadow p-5 mx-auto" style="border-radius: 5px">
          <v-row>
            <v-col cols="12" md="12" sm="12">
              <div class="record-header">
                <div class="record-logo">
                  <img
                    class="mx-auto"
                    src="/logos/cultura_logo.jpg"
                    style="width: 260px"
                  />
                </div>
                <div class="record-titles">
                  <p class="mb-0 fw-bold">MINISTERIO DE CULTURA</p>
                  <p class="fw-bold">UNIDAD DE TALENTO HUMANO</p>
                </div>
                <!-- <div class="record-empty"></div> -->
              </div>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <h4 class="text-center fw-bold text-decoration-underline">
                HOJA DE ACTUALIZACIÓN DE DATOS PERSONALES {{ currentYear }}
              </h4>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <v-row style="border: solid 2px #000; margin-bottom: 5px">
                <h5 class="text-center fw-bold bg-black mb-0">
                  I. DATOS PERSONALES
                </h5>
                <!-- Full name -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Nombre completo según DUI: </span>
                  <span class="fs-16">{{ employeeRecord.full_name }}</span>
                </v-col>
                <!-- Full name -->
                <!-- Family Status -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Estado familiar: </span>
                  <span class="fs-16">{{
                    employeeRecord.family_status_id
                  }}</span>
                </v-col>

                <!-- Family Status -->
                <!-- Profession -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Profesión: </span>
                  <span class="fs-16">{{ employeeRecord.profession_id }}</span>
                </v-col>
                <!-- Profession -->
                <!-- Current address -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Domicilio actual: </span>
                  <span class="fs-16">{{
                    employeeRecord.current_address
                  }}</span>
                </v-col>
                <!-- Current address -->
                <!-- Department -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Departamento: </span>
                  <span class="fs-16">{{
                    employeeRecord.department_name
                  }}</span>
                </v-col>
                <!-- Department -->
                <!-- Municipality -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Municipio: </span>
                  <span class="fs-16">{{
                    employeeRecord.municipality_id
                  }}</span>
                </v-col>
                <!-- Municipality -->
                <!-- Vulnerable area -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16"
                    >Especifique si el lugar de su domicilio es zona vulnerable:
                  </span>
                  <span class="fs-16">{{
                    employeeRecord.vulnerable_area
                  }}</span>
                </v-col>
                <!-- Vulnerable area -->
                <!-- Personal email -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16"
                    >Correo electrónico personal:
                  </span>
                  <span class="fs-16">{{ employeeRecord.personal_email }}</span>
                </v-col>
                <!-- Personal email -->
                <!-- Cell Phone -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Celular personal: </span>
                  <span class="fs-16">{{ employeeRecord.cell_phone }}</span>
                </v-col>
                <!-- Cell Phone -->
                <!-- Phone -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16"
                    >Teléfono personal (Opcional):
                  </span>
                  <span class="fs-16" v-if="employeeRecord.phone">{{
                    employeeRecord.phone
                  }}</span>
                  <span class="fs-16" v-else> No registrado </span>
                </v-col>
                <!-- Phone -->
              </v-row>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <v-row style="border: solid 2px #000; margin-bottom: 5px">
                <h5 class="text-center fw-bold bg-black mb-0">
                  II. DATOS LABORALES
                </h5>
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">UNIDAD ORGANIZATIVA: </span>
                </v-col>
                <!-- Direction -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Dirección: </span>
                  <span class="fs-16">{{ employeeRecord.direction_id }}</span>
                </v-col>

                <!-- Direction -->

                <!-- Dependence -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Dependencia: </span>
                  <span class="fs-16">{{ employeeRecord.unit_id }}</span>
                </v-col>
                <!-- Dependence -->
                <!-- Nominal Fee -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Cargo nominal: </span>
                  <span class="fs-16">{{ employeeRecord.nominal_fee }}</span>
                </v-col>
                <!-- Nominal Fee -->
                <!-- Functional Position -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16">Cargo funcional: </span>
                  <span class="fs-16">{{
                    employeeRecord.functional_position
                  }}</span>
                </v-col>

                <!-- Functional Position -->
                <!-- Inmediate Superior -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Nombre de jefe inmediato: </span>
                  <span class="fs-16">{{
                    employeeRecord.immediate_superior
                  }}</span>
                </v-col>

                <!-- Inmediate Superior -->
                <!-- Email Institutional -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16"
                    >Correo institucional de jefe inmediato:
                  </span>
                  <span class="fs-16">{{
                    employeeRecord.email_institutional
                  }}</span>
                </v-col>
                <!-- Email Institutional -->
                <!-- Municipality Assigned -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16"
                    >Asinado en el municipio de:
                  </span>
                  <span class="fs-16">{{
                    employeeRecord.municipality_assigned_id
                  }}</span>
                </v-col>
                <!-- Municipality Assigned -->
                <!-- Department Assigned -->
                <v-col cols="12" md="6" sm="6">
                  <span class="fw-bold fs-16"
                    >Asignado en el departamento de:
                  </span>
                  <span class="fs-16">{{
                    employeeRecord.department_assigned_id
                  }}</span>
                </v-col>
                <!-- Department Assigned -->
              </v-row>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <v-row style="border: solid 2px #000; margin-bottom: 5px">
                <h5 class="text-center fw-bold bg-black mb-0">
                  III. GRUPO FAMILIAR
                </h5>
                <v-col
                  cols="12"
                  md="12"
                  sm="12"
                  class="table-responsive"
                  style="padding: 12px 0px"
                >
                  <table class="table table-bordered table-responsive-md">
                    <tbody>
                      <tr class="text-center fw-bold">
                        <td class="fs-16 text-uppercase">Nombre completo</td>
                        <td class="fs-16 text-uppercase">Parentesco</td>
                        <td
                          class="fs-16 text-uppercase"
                          style="border-right-color: #fff !important"
                        >
                          Fecha de nacimiento
                        </td>
                      </tr>
                      <tr
                        v-for="(families, index) in employeeRecord.familyGroup"
                        :key="index"
                      >
                        <td class="fs-16">
                          <p>{{ families.full_name }}</p>
                        </td>
                        <td class="fs-16">
                          <p>{{ families.kinship_id }}</p>
                        </td>
                        <td
                          class="fs-16"
                          style="border-right-color: #fff !important"
                        >
                          <p>{{ families.date_birth }}</p>
                        </td>
                      </tr>
                      <!-- <tr v-if="employeeRecord.familyGroup.length == 0">
                        <td
                          colspan="4"
                          style="border-right-color: #fff !important"
                        >
                          <p class="text-center fw-bold">
                            No se encontró ningún familiar registrado.
                          </p>
                        </td>
                      </tr> -->
                    </tbody>
                  </table>
                </v-col>
                <!-- Emergency Full Name -->
                <v-col cols="12" md="8" sm="8">
                  <span class="fw-bold fs-16"
                    >En caso de emergencia llamar a:
                  </span>
                  <span class="fs-16">{{
                    employeeRecord.emergency_full_name
                  }}</span>
                </v-col>
                <!-- Emergency Full Name -->
                <!-- Cell Phone -->
                <v-col cols="12" md="4" sm="4">
                  <span class="fw-bold fs-16">Celular: </span>
                  <span class="fs-16">{{
                    employeeRecord.emergency_cell_phone
                  }}</span>
                </v-col>
                <!-- Cell Phone -->
                <!-- Emergency Full Name -->
                <v-col cols="12" md="8" sm="8">
                  <span class="fw-bold fs-16">Parentesco: </span>
                  <span class="fs-16">{{
                    employeeRecord.emergency_kinship_id
                  }}</span>
                </v-col>
                <!-- Emergency Full Name -->
                <!-- Phone -->
                <v-col cols="12" md="4" sm="4">
                  <span class="fw-bold fs-16">Teléfono: </span>
                  <span class="fs-16" v-if="employeeRecord.emergency_phone">{{
                    employeeRecord.emergency_phone
                  }}</span>
                  <span class="fs-16" v-else> No registrado </span>
                </v-col>
                <!-- Phone -->
                <!-- Emergency Address -->
                <v-col cols="12" md="12" sm="12">
                  <span class="fw-bold fs-16">Dirección: </span>
                  <span class="fs-16">{{
                    employeeRecord.emergency_address
                  }}</span>
                </v-col>
                <!-- Emergency Address -->
              </v-row>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <v-row
                style="
                  border: solid 2px #000;
                  margin-bottom: 5px;
                  border-bottom: none;
                "
              >
                <h5 class="text-center fw-bold bg-black mb-0">
                  IV. FORMACIÓN ACADÉMICA ( NIVEL EDUCATIVO OBTENIDO )
                </h5>
                <v-col
                  cols="12"
                  md="12"
                  sm="12"
                  style="padding: 12px 0px 0px 0px"
                  class="table-responsive"
                >
                  <table class="table table-bordered table-responsive-md">
                    <!-- <thead> -->
                    <!-- </thead> -->
                    <tbody>
                      <tr class="text-center fw-bold hide">
                        <td class="fs-16 text-uppercase">NIVEL EDUCATIVO</td>
                        <td class="fs-16 text-uppercase">CENTRO EDUCATIVO</td>
                        <td class="fs-16 text-uppercase">
                          AÑO DE FINALIZACIÓN
                        </td>
                        <td
                          class="fs-16 text-uppercase"
                          style="border-right-color: #fff !important"
                        >
                          TITULO RECIBIDO
                        </td>
                      </tr>
                      <tr
                        v-for="(academic, index) in employeeRecord.academics"
                        :key="index"
                      >
                        <td class="fs-16">
                          <p>{{ academic.academic_level_id }}</p>
                        </td>
                        <td class="fs-16">
                          <p>{{ academic.education_center }}</p>
                        </td>
                        <td class="fs-16">
                          <p>{{ academic.year }}</p>
                        </td>
                        <td
                          class="fs-16"
                          style="border-right-color: #fff !important"
                        >
                          <p>{{ academic.obtained_title }}</p>
                        </td>
                      </tr>
                      <!-- <tr v-if="employeeRecord.academics.length == 0" >
                        <td colspan="4" style="border-right-color: #fff !important">
                          <p class="text-center fw-bold">
                            No se encontró ningún nivel académico registrado.
                          </p>
                        </td>
                      </tr> -->
                    </tbody>
                  </table>
                </v-col>
              </v-row>
            </v-col>
            <v-row
              v-for="(academic, index) in employeeRecord.academics"
              :key="index"
            >
              <v-col
                cols="12"
                md="12"
                sm="12"
                v-if="academic.career_status == 'No Finalizada'"
              >
                <span class="fw-bold fs-16">NOTA:</span
                ><span class="fs-16">
                  En caso de haber estudiado una carrera universitaria y no fue
                  finalizada:
                </span>
              </v-col>
              <!-- Career -->
              <v-col
                cols="12"
                md="4"
                sm="4"
                v-if="academic.career_status == 'No Finalizada'"
              >
                <span class="fw-bold fs-16">Carrera: </span>
                <span class="fs-16">{{ academic.career }}</span>
              </v-col>
              <!-- Subjects Approved -->
              <v-col
                cols="12"
                md="4"
                sm="4"
                v-if="academic.career_status == 'No Finalizada'"
              >
                <span class="fw-bold fs-16">Materias aprobadas: </span>
                <span class="fs-16">{{ academic.subjects_approved }}</span>
              </v-col>
              <!-- Career Status -->
              <v-col
                cols="12"
                md="4"
                sm="4"
                v-if="academic.career_status == 'No Finalizada'"
              >
                <span class="fw-bold fs-16">Estado: </span>
                <span class="fs-16">{{ academic.career_status }}</span>
              </v-col>
            </v-row>
            <v-col cols="12" md="12" sm="12" class="pt-5">
              <span class="fw-bold fs-16">Documentos a anexar: </span>
              <a
                :href="employeeRecord.dui_file"
                target="_blank"
                v-if="employeeRecord.dui_file"
                ><li class="fs-16">
                  Enlace de copia de Documento Único de Identidad (PDF).
                </li></a
              >
              <a
                :href="employeeRecord.title_file"
                target="_blank"
                v-if="employeeRecord.title_file"
                ><li class="fs-16">
                  Enlace de copia de Título o Diploma si adquirió alguno (PDF).
                </li>
              </a>
            </v-col>
            <!-- <v-col cols="12" md="12" sm="12">
              <v-btn color="btn-normal no-uppercase mt-3" rounded>
                Imprimir expediente
              </v-btn>
            </v-col> -->
          </v-row>
        </div>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import axios from "axios";
// import lib from "../libs/function";
export default {
  data() {
    return {
      employeeRecord: [],
      loading: false,
      textAlert: "",
      alertEvent: "success",
      showAlert: false,
      redirectSessionFinished: false,
      alertTimeOut: 0,
      status: 1,
      currentYear: new Date().getFullYear(), // Current Year
    };
  },

  mounted() {
    this.verifryStatus();
  },

  methods: {
    async verifryStatus() {
      const res = await axios.get("api/verifyStatus").catch((error) => {
        this.verifySessionFinished(error, 401);
      });

      if (res.data.message == "success") {
        this.status = res.data.status;
        if (this.status == 1 || this.status == 2) {
          window.location = "/record";
        } else {
          this.initialize();
        }
      }
    },
    async initialize() {
      this.loading = true;
      const res = await axios.get("/api/employee/myRecord").catch((error) => {
        this.verifySessionFinished(error, 401);
      });

      this.employeeRecord = res.data.recordInfoEmployee;

      if (this.employeeRecord.vulnerable_area === 1) {
        this.employeeRecord.vulnerable_area = "SÍ";
      } else {
        this.employeeRecord.vulnerable_area = "NO";
      }
      this.loading = false;
    },
    verifySessionFinished(error, code) {
      if (error.response.status == code) {
        this.redirectSessionFinished = true;
        this.alertTimeOut++;
      }
    },
  },
};
</script>
<style>
.main {
  background-color: #fff !important;
}

.record-header {
  display: flex;
  justify-content: center;
  align-items: center;
}

.record-titles {
  text-align: center;
}

.bg-black {
  background-color: black;
  color: #fff;
  padding: 4px;
}

p {
  margin-bottom: 0px;
}

td {
  padding: 4px !important;
}
.table {
  margin-bottom: 0rem;
  border-color: #000 !important;
  border-left-color: #fff !important;
}

.table-bordered > :not(caption) > * > * {
  border-width: 2px;
}

.fs-16 {
  font-size: 16px !important;
}

@media screen and (max-width: 550px) {
  .record-header {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .card-body {
    padding: 30px !important;
  }
}
</style>
