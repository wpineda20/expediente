<template>
  <div div-app ref="top">
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
    <div class="card-body shadow p-4" style="border-radius: 5px">
      <v-row>
        <v-col cols="12" md="12">
          <div class="record-header">
            <!-- <div class="record-logo">
                <img
                  class="mx-auto"
                  src="/logos/cultura_logo.jpg"
                  style="width: 280px"
                />
              </div> -->
            <div class="record-titles">
              <p class="mb-0 fw-bold">MINISTERIO DE CULTURA</p>
              <p class="fw-bold">UNIDAD DE TALENTO HUMANO</p>
            </div>
            <!-- <div class="record-empty"></div> -->
          </div>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <h4 class="text-center fw-bold text-decoration-underline">
            HOJA DE ACTUALIZACIÓN DE DATOS PERSONALES 2022
          </h4>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <v-row style="border: solid; margin-bottom: 5px">
            <h5 class="text-center fw-bold bg-black mb-0">
              I. DATOS PERSONALES
            </h5>
            <!-- Full name -->
            <v-col cols="12" md="4" sm="4">
              <span class="fw-bold text-uppercase"
                >NOMBRE COMPLETO SEGÚN DUI:
              </span>
            </v-col>
            <v-col cols="12" md="8" sm="8">
              <span class="text-uppercase">{{ employeeRecord.full_name }}</span>
            </v-col>
            <!-- Full name -->
            <!-- Family Status -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">ESTADO FAMILIAR: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.family_status_id
              }}</span>
            </v-col>
            <!-- Family Status -->
            <!-- Profession -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">PROFESIÓN: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.profession_id
              }}</span>
            </v-col>
            <!-- Profession -->
            <!-- Current address -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">DIRECCIÓN ACTUAL: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.current_address
              }}</span>
            </v-col>
            <!-- Current address -->
            <!-- Department -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">DEPARTAMENTO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.department_name
              }}</span>
            </v-col>
            <!-- Department -->
            <!-- Municipality -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">MUNICIPIO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.municipality_id
              }}</span>
            </v-col>
            <!-- Municipality -->
            <!-- Vulnerable area -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase"
                >ESPECIFIQUE SI EL LUGAR DE SU DOMICILIO ES ZONA VULNERABLE:
              </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.vulnerable_area
              }}</span>
            </v-col>
            <!-- Vulnerable area -->
            <!-- Personal email -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase"
                >CORREO ELECTRÓNICO (Personal):
              </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.personal_email
              }}</span>
            </v-col>
            <!-- Personal email -->
            <!-- Cell Phone -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">CELULAR: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.cell_phone
              }}</span>
            </v-col>
            <!-- Cell Phone -->
            <!-- Phone -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">TELÉFONO: (Opcional)</span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase" v-if="employeeRecord.phone">{{
                employeeRecord.phone
              }}</span>
              <span class="text-uppercase" v-else> - </span>
            </v-col>
            <!-- Phone -->
          </v-row>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <v-row style="border: solid; margin-bottom: 5px">
            <h5 class="text-center fw-bold bg-black mb-0">
              II. DATOS LABORALES
            </h5>
            <v-col cols="12" md="12" sm="12">
              <span class="fw-bold text-uppercase">UNIDAD ORGANIZATIVA: </span>
            </v-col>
            <!-- Full name -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">DIRECCIÓN: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.direction_id
              }}</span>
            </v-col>
            <!-- Full name -->
            <!-- Family Status -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">SUB DIRECCIÓN: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.subdirection_id
              }}</span>
            </v-col>
            <!-- Family Status -->
            <!-- Profession -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">UNIDAD: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{ employeeRecord.unit_id }}</span>
            </v-col>
            <!-- Profession -->
            <!-- Current address -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">CARGO NOMINAL: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.nominal_fee
              }}</span>
            </v-col>
            <!-- Current address -->
            <!-- Department -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">CARGO FUNCIONAL: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.functional_position
              }}</span>
            </v-col>
            <!-- Department -->
            <!-- Municipality -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">JEFE INMEDIATO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.immediate_superior
              }}</span>
            </v-col>
            <!-- Municipality -->
            <!-- Vulnerable area -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">CORREO INSTITUCIONAL: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.email_institutional
              }}</span>
            </v-col>
            <!-- Vulnerable area -->
            <!-- Personal email -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase"
                >ASIGNADO EN EL MUNICIPIO DE:
              </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.municipality_assigned_id
              }}</span>
            </v-col>
            <!-- Personal email -->
            <!-- Cell Phone -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">DEPARTAMENTO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.department_assigned_id
              }}</span>
            </v-col>
            <!-- Cell Phone -->
          </v-row>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <v-row style="border: solid; margin-bottom: 5px">
            <h5 class="text-center fw-bold bg-black mb-0">
              III. GRUPO FAMILIAR
            </h5>
            <v-col cols="12" md="12" sm="12" style="padding: 12px 0px">
              <table class="table table-bordered table-responsive-md">
                <!-- <thead> -->
                <!-- </thead> -->
                <tbody>
                  <tr class="text-center fw-bold">
                    <td>NOMBRE COMPLETO</td>
                    <td>PARENTESCO</td>
                    <td>FECHA DE NACIMIENTO</td>
                  </tr>
                  <tr
                    v-for="(families, index) in employeeRecord.familyGroup"
                    :key="index"
                  >
                    <td>
                      <p>{{ families.full_name }}</p>
                    </td>
                    <td>
                      <p>{{ families.kinship_id }}</p>
                    </td>
                    <td>
                      <p>{{ families.date_birth }}</p>
                    </td>
                  </tr>
                  <!-- <tr v-if="employeeRecord.familyGroup.length == 0">
                    <td colspan="5" class="text-center pt-3">
                      <p>No se encontró ningún registro.</p>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </v-col>
            <!-- Emergency Full Name -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase"
                >EN CASO DE EMERGENCIA LLAMAR A:
              </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.emergency_full_name
              }}</span>
            </v-col>
            <!-- Emergency Full Name -->
            <!-- Cell Phone -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">CELULAR: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.emergency_cell_phone
              }}</span>
            </v-col>
            <!-- Cell Phone -->
            <!-- Emergency Full Name -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">PARENTESCO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.emergency_kinship_id
              }}</span>
            </v-col>
            <!-- Emergency Full Name -->
            <!-- Phone -->
            <v-col cols="12" md="4" sm="6">
              <span class="fw-bold text-uppercase">TELÉFONO: </span>
            </v-col>
            <v-col cols="12" md="8" sm="6">
              <span class="text-uppercase">{{
                employeeRecord.emergency_phone
              }}</span>
            </v-col>
            <!-- Phone -->
          </v-row>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <v-row style="border: solid; margin-bottom: 5px">
            <h5 class="text-center fw-bold bg-black mb-0">
              IV. FORMACIÓN ACADÉMICA ( NIVEL EDUCATIVO OBTENIDO )
            </h5>
            <v-col cols="12" md="12" sm="12" style="padding: 12px 0px 0px 0px">
              <table class="table table-bordered table-responsive-md">
                <!-- <thead> -->
                <!-- </thead> -->
                <tbody>
                  <tr class="text-center fw-bold">
                    <td>NIVEL EDUCATIVO</td>
                    <td>CENTRO EDUCATIVO</td>
                    <td>AÑO</td>
                    <td>TITULO RECIBIDO</td>
                  </tr>
                  <tr
                    v-for="(academic, index) in employeeRecord.academics"
                    :key="index"
                  >
                    <td>
                      <p>{{ academic.academic_level_id }}</p>
                    </td>
                    <td>
                      <p>{{ academic.education_center }}</p>
                    </td>
                    <td>
                      <p>{{ academic.year }}</p>
                    </td>
                    <td>
                      <p>{{ academic.obtained_title }}</p>
                    </td>
                  </tr>
                  <!-- <tr v-if="employeeRecord.familyGroup.length == 0">
                    <td colspan="5" class="text-center pt-3">
                      <p>No se encontró ningún registro.</p>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </v-col>
          </v-row>
        </v-col>
        <!-- Subjects Approved -->
        <v-col cols="12" md="10" sm="12">
          <span class="fw-bold"
            >En caso de haber estudiado una carrera universitaria y no fue
            finalizada, establezca cuantas materias aprobó:
          </span>
        </v-col>
        <v-col cols="12" md="2" sm="6">
          <span class="text-uppercase">{{
            employeeRecord.subjects_approved
          }}</span>
        </v-col>
        <!-- Subjects Approved -->
        <v-col cols="12" md="12" sm="12">
          <span class="fw-bold text-uppercase">Documentos a anexar: </span>
          <a
            :href="employeeRecord.dui_file"
            target="_blank"
            v-if="employeeRecord.dui_file"
            ><li>Copia de su Documento Único de Identidad.</li></a
          >
          <a
            :href="employeeRecord.title_file"
            target="_blank"
            v-if="employeeRecord.title_file"
            ><li>Copia de Título o Diploma si adquirió alguno.</li>
          </a>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <v-btn color="btn-normal no-uppercase mt-3" rounded>
            Imprimir expediente
          </v-btn>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import lib from "../libs/function";
export default {
  data() {
    return {
      employeeRecord: [],
      loading: false,
      textAlert: "",
      alertEvent: "success",
      showAlert: false,
      redirectSessionFinished: false,
    };
  },

  //   props: {
  //     employeeRecord: {},
  //   },

  mounted() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;
      const res = await axios.get("/api/employee/myRecord").catch((error) => {
        this.updateAlert(true, "No fue posible obtener los registros.", "fail");
        this.redirectSessionFinished = lib.verifySessionFinished(
          error.response.status,
          401
        );
      });

      this.employeeRecord = res.data.recordInfoEmployee;
      //   console.log(this.employeeRecord.familyGroup);

      if (this.employeeRecord.vulnerable_area === 1) {
        this.employeeRecord.vulnerable_area = "SÍ";
      } else {
        this.employeeRecord.vulnerable_area = "NO";
      }

      this.loading = false;
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
  /* border-width: 3px; */
}

.table-bordered > :not(caption) > * > * {
  border-width: 3px;
  /* border-left-width: 0px; */
  /* border-right-width: 0px; */
}
</style>
