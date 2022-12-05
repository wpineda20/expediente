<template>
  <v-container ref="top">
    <v-container ref="alert" class="mb-3">
      <alert
        :text="textAlert"
        :event="alertEvent"
        :show="showAlert"
        @show-alert="updateAlert($event)"
        class="mb-0"
      />
    </v-container>
    <v-stepper
      v-model="step"
      vertical
      width="100%"
      class="pb-0 h-100"
      v-if="!loading"
    >
      <v-app class="h-100">
        <!-- Datos personales -->
        <v-stepper-step
          :complete="step > 1"
          step="1"
          @click="step = 1"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Datos Personales</h6>
          <small class="ml-2">Datos Personales</small>
        </v-stepper-step>

        <v-stepper-content
          step="1"
          editable
          class="pt-0 pb-0 mb-1 pr-5"
          max-width="500px"
        >
          <div class="mb-1 mt-2 h-100">
            <v-row>
              <!-- Full name -->
              <v-col cols="12" xs="12" sm="12" md="12">
                <v-text-field
                  dense
                  readonly
                  label="Nombre completo según DUI"
                  outlined
                  type="text"
                  placeholder="Nombre completo según DUI"
                  v-model="employee.full_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Full name -->

              <!-- Cellphone -->
              <v-col
                cols="12"
                xs="12"
                sm="12"
                md="6"
                v-if="employee.cell_phone"
              >
                <v-text-field
                  dense
                  readonly
                  outlined
                  label=""
                  type="text"
                  placeholder=""
                  v-model="employee.cell_phone"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Cellphone -->
              <!-- Phone -->
              <v-col cols="12" xs="12" sm="12" md="6" v-if="employee.phone">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Télefono"
                  type="text"
                  placeholder="Télefono"
                  v-model="employee.phone"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>

              <!-- Family Status Name -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Estado Familiar"
                  type="text"
                  v-model="employee.family_status_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Family Status Name -->

              <!-- Profession Name -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Profesión"
                  type="text"
                  v-model="employee.profession_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Profession Name -->

              <!-- Current Address -->
              <v-col
                cols="12"
                xs="12"
                sm="12"
                md="12"
                v-if="employee.current_address"
              >
                <v-textarea
                  name="input-7-4"
                  readonly
                  outlined
                  label="Domicilio actual"
                  placeholder="Domicilio actual"
                  v-model="employee.current_address"
                  class="p-0 mt-0 pl-2"
                  rows="5"
                  max="250"
                ></v-textarea>
              </v-col>
              <!-- Current Address -->

              <!-- Departments -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Departamento"
                  type="text"
                  item-text="name"
                  v-model="employee.department_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Departments -->
              <!-- Municipalities -->
              <v-col cols="12" xs="12" sm="12" md="6" ref="municipalities">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Municipio"
                  type="text"
                  placeholder=""
                  v-model="employee.municipality_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- vulnerable Area -->
              <v-col cols="12" xs="12" sm="12" md="12">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Municipio"
                  type="text"
                  placeholder=""
                  v-model="employee.vulnerableArea"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- vulnerable Area -->
              <!-- Personal Email -->
              <v-col cols="12" xs="12" sm="12" md="12">
                <v-text-field
                  dense
                  outlined
                  readonly
                  label="Correo electrónico"
                  type="text"
                  v-model="employee.personal_email"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Personal Email -->
            </v-row>
          </div>
          <v-btn class="btn btn-normal mt-3 mb-3" @click="step++"
            >Continuar</v-btn
          >
          <!-- <v-btn text>Cancel</v-btn> -->
        </v-stepper-content>
        <!-- Datos personales -->
        <!-- Datos laborales-->
        <v-stepper-step
          :complete="step > 2"
          step="2"
          @click="step = 2"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Datos Laborales</h6>
          <small class="ml-2">Unidad Organizativa</small>
        </v-stepper-step>

        <v-stepper-content
          step="2"
          editable
          class="pt-0 pb-0 mb-1 pr-5"
          max-width="500px"
        >
          <div class="mb-1 mt-2 h-100">
            <v-row>
              <!-- Direction -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  label="Dirección"
                  outlined
                  type="text"
                  v-model="employee.direction_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Direction -->

              <!-- Subdirección -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Subdirección"
                  type="text"
                  v-model="employee.subdirection_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Subdirección -->

              <!-- Unit Name -->
              <v-col cols="12" xs="12" sm="12" md="12">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Unidad"
                  type="text"
                  v-model="employee.unit_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Unit Name -->

              <!-- Nominal Fee -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Cargo nominal"
                  type="text"
                  v-model="employee.nominal_fee"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Nominal Fee -->

              <!-- Functional Position -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Cargo funcional"
                  type="text"
                  v-model="employee.functional_position"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Functional Position -->

              <!-- Inmediate Superior -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Jefe inmediato"
                  type="text"
                  v-model="employee.immediate_superior"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Inmediate Superior -->

              <!-- email_institutional -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Correo institucional"
                  type="text"
                  v-model="employee.email_institutional"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- email_institutional -->

              <!-- Departments -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Departamento"
                  type="text"
                  item-text="name"
                  v-model="employee.department_assigned_id"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Departments -->
              <!-- Municipalities -->
              <v-col cols="12" xs="12" sm="12" md="6" ref="municipalities">
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Municipio"
                  type="text"
                  placeholder=""
                  v-model="employee.municipality_assigned_id"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
            </v-row>
          </div>
          <v-btn class="btn btn-normal mt-3 mb-3" @click="step++"
            >Continuar</v-btn
          >
          <!-- <v-btn text>Cancel</v-btn> -->
        </v-stepper-content>
        <!-- Datos laborales -->

        <!-- Grupo familiar -->
        <v-stepper-step
          :complete="step > 3"
          step="3"
          @click="step = 3"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Grupo Familiar</h6>
          <small class="ml-2">Grupo Familiar</small>
        </v-stepper-step>

        <v-stepper-content
          step="3"
          editable
          class="pt-0 pb-0 mb-1 pr-5"
          max-width="500px"
        >
          <div class="mb-1 mt-2 h-100">
            <!-- Family Group -->
            <table class="table table-responsive-md table-hover">
              <thead>
                <th>Nombre completo</th>
                <th>Parentesco</th>
                <th>Fecha de nacimiento</th>
              </thead>
              <tbody>
                <tr v-for="(family, index) in families" :key="index">
                  <td>
                    <p>{{ family.full_name }}</p>
                  </td>
                  <td>
                    <p>{{ family.kinship_id }}</p>
                  </td>
                  <td>
                    <p>{{ family.date_birth }}</p>
                  </td>
                </tr>
                <tr v-if="families.length == 0">
                  <td colspan="6">
                    <p class="text-center">
                      No se encontró ningún estudio académico registrado.
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- Family Group -->
            <v-row>
              <!-- Emergency Full name -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  label="En caso de emergencia llamar"
                  outlined
                  type="text"
                  placeholder="En caso de emergencia llamar"
                  v-model="employee.emergency_full_name"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Emergency Full name -->
              <!-- Emergency Kinship -->
              <v-col cols="12" xs="12" sm="12" md="6">
                <v-text-field
                  dense
                  readonly
                  label="Parentesco"
                  outlined
                  type="text"
                  placeholder="Parentesco"
                  v-model="employee.emergency_kinship_id"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Emergency Kinship -->

              <!-- Emergency Cellphone -->
              <v-col
                cols="12"
                xs="12"
                sm="12"
                md="6"
                v-if="employee.emergency_cell_phone"
              >
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Celular"
                  type="text"
                  placeholder="Celular"
                  v-model="employee.emergency_cell_phone"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Emergency Cellphone -->
              <!-- Emergency Phone -->
              <v-col
                cols="12"
                xs="12"
                sm="12"
                md="6"
                v-if="employee.emergency_phone"
              >
                <v-text-field
                  dense
                  readonly
                  outlined
                  label="Teléfono"
                  type="text"
                  placeholder="Teléfono"
                  v-model="employee.emergency_phone"
                  class="p-0 mt-0 pl-2"
                ></v-text-field>
              </v-col>
              <!-- Emergency Phone -->
            </v-row>
          </div>
          <v-btn class="btn btn-normal mt-3 mb-3" @click="step++"
            >Continuar</v-btn
          >
          <!-- <v-btn text>Cancel</v-btn> -->
        </v-stepper-content>
        <!-- Grupo familiar -->

        <!-- Formación académica -->
        <v-stepper-step
          :complete="step > 4"
          step="4"
          @click="step = 4"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Formación Académica</h6>
          <small class="ml-2">Nivel Educativo Obtenido</small>
        </v-stepper-step>

        <v-stepper-content
          step="4"
          editable
          class="pt-2 pb-0 mb-1 pr-5"
          max-width="500px"
        >
          <div class="mb-1 mt-2 h-100">
            <!-- Family Group -->
            <table class="table table-responsive-md table-hover">
              <thead>
                <th>Nivel educativo</th>
                <th>Centro educativo</th>
                <th>Año</th>
                <th>Título recibido</th>
              </thead>
              <tbody>
                <tr v-for="(academic, index) in academics" :key="index">
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
                <tr v-if="academics.length == 0">
                  <td colspan="6">
                    <p class="text-center">
                      No se encontró ningún estudio académico registrado.
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- Family Group -->
            <v-row>
              <!-- Subjects Approved -->
              <v-col cols="12" xs="12" sm="12" md="12">
                <h6 class="mb-5">
                  En caso de haber estudiado una carrera universitaria y no fue
                  finalizada, establezca cuantas materias aprobó:
                </h6>
                <v-col cols="12" xs="12" sm="12" md="6">
                  <v-text-field
                    dense
                    readonly
                    label="Materias aprobadas"
                    outlined
                    type="text"
                    placeholder="Materias aprobadas"
                    v-model="employee.subjects_approved"
                    class="p-0 mt-0 pl-2"
                  ></v-text-field>
                </v-col>
              </v-col>
              <!-- Subjects Approved -->
            </v-row>
          </div>
          <v-btn class="btn btn-normal mt-3 mb-3" @click="step++"
            >Continuar</v-btn
          >
          <!-- <v-btn text>Cancel</v-btn> -->
        </v-stepper-content>
        <!-- Grupo familiar -->

        <!-- Anexar documentos -->
        <v-stepper-step
          :complete="step > 5"
          step="5"
          @click="step = 5"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Anexar Documentos</h6>
          <small class="ml-2">Documentos a Anexar</small>
        </v-stepper-step>
        <v-stepper-content
          step="5"
          editable
          class="pt-2 pb-0 mb-1 pr-5"
          max-width="500px"
        >
          <div class="mb-1 mt-2 h-100">
            <v-row>
              <v-col cols="12" md="12" sm="12">
                <span class="fw-bold">Documentos a anexar: </span>
                <a :href="employee.dui_file" target="_blank"
                  ><li>Copia de su Documento Único de Identidad.</li></a
                >
                <a :href="employee.title_file" target="_blank"
                  ><li>Copia de Título o Diploma si adquirió alguno.</li>
                </a>
              </v-col>
            </v-row>
          </div>
          <!-- <v-btn text>Cancel -->
        </v-stepper-content>
        <!-- Anexar documentos -->

        <!-- <v-row>
          <v-col cols="12" xs="12" sm="12" md="12" v-if="txtNotify">
            <v-textarea
              label="Ingresa un comentario"
              name="input-7-4"
              outlined
              placeholder=""
              v-model="description"
              class="mb-2"
              rows="5"
            ></v-textarea>
          </v-col>
          <v-col cols="12" xs="12" sm="12" md="4">
            <v-btn
              class="btn btn-normal-close mb-3"
              @click="notifyUser()"
              v-if="btnNotify"
              :disabled="!!disableButton"
            >
              Notificar
            </v-btn>
            <v-btn
              class="btn btn-normal-close mb-5"
              :disabled="!!disableButton"
              @click="publishUser()"
              v-else
            >
              Publicar
            </v-btn>
          </v-col>
        </v-row> -->
      </v-app>
    </v-stepper>
    <v-row v-else class="card-rounded">
      <v-col cols="12" xs="12" align="center">
        <loader />
      </v-col>
    </v-row>
  </v-container>
</template>

<script src="./index.js" />

<style>
.v-stepper__wrapper {
  height: 100%;
}

.v-sheet.v-stepper:not(.v-sheet--outlined) {
  box-shadow: 0px 0px 0px 0px;
}

.v-input__slot {
  padding: 0px 2px 2px 5px;
}

.custom-control-label::after {
  display: none;
}

.v-dialog.fullscreen {
  width: 100% !important;
}

.v-dialog.v-dialog--active.v-dialog--fullscreen {
  width: 100% !important;
}
</style>
