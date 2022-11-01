<template>
  <v-container ref="top" fluid class="mt-2 mb-5">
    <alert-time-out
      :redirect="redirectSessionFinished"
      :key="alertTimeOut"
      :time="timeAlert"
    />
    <v-container ref="alert" class="mb-3">
      <alert
        :text="textAlert"
        :event="alertEvent"
        :show="showAlert"
        :time="timeAlert"
        @show-alert="updateAlert($event)"
        class="mb-0"
      />
    </v-container>

    <disclaimer-register v-if="step == 1" />

    <v-stepper
      v-model="step"
      vertical
      width="100%"
      style="border-radius: 15px"
      class="pb-0 h-100 shadow"
      v-if="!loading"
    >
      <v-app class="h-100 shadow">
        <!-- Datos personales -->
        <v-stepper-step
          :complete="step > 1"
          step="1"
          @click="changeStepSection(1)"
          class="pt-5 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Datos personales</h6>
          <small class="ml-2">Datos personales</small>
        </v-stepper-step>

        <v-stepper-content
          step="1"
          editable
          class="pt-0 pb-0 mb-1 pr-5"
          @click="changeStepSection(1)"
          max-width="600px"
        >
          <step-1
            v-if="step >= 1"
            :culturalAgent="culturalAgent.step1"
            :familyHead="familyHead"
            :countries="countries"
            :genders="genders"
            :ethnicities="ethnicities"
            :disabilities="disabilities"
            :validation="$v.culturalAgent.step1"
            @update-alert="
              updateAlert($event.show, $event.message, $event.type)
            "
            @valid-step="saveData($event)"
          />
        </v-stepper-content>
        <!-- Datos personales -->

        <!-- Datos laborales -->
        <v-stepper-step
          :complete="step > 2"
          @click="changeStepSection(2)"
          step="2"
          class="pt-0 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Datos laborales</h6>
          <small class="ml-2">Datos laborales</small>
        </v-stepper-step>

        <v-stepper-content step="2" class="pt-0 pb-0 pr-5">
          <step-2
            v-if="step >= 2"
            :culturalAgent="culturalAgent.step2"
            :validation="$v.culturalAgent.step2"
            @update-alert="
              updateAlert($event.show, $event.message, $event.type)
            "
            @valid-step="saveData($event)"
            @get-back="step -= 1"
          />
        </v-stepper-content>
        <!-- Datos laborales -->

        <!-- Localización -->
        <v-stepper-step
          :complete="step > 3"
          @click="changeStepSection(3)"
          step="3"
          color="#2D52A8"
          class="pt-0 pb-2"
        >
          <h6 class="ml-2 mb-1">Grupo familiar</h6>
          <small class="ml-2">Grupo familiar</small>
        </v-stepper-step>

        <v-stepper-content step="3" class="pt-0 pb-0 pr-5">
          <step-3
            v-if="step >= 3 && departments.length > 0"
            :culturalAgent="culturalAgent.step3"
            :validation="$v.culturalAgent.step3"
            :departments="departments"
            @update-alert="
              updateAlert($event.show, $event.message, $event.type)
            "
            @valid-step="saveData($event)"
            @get-back="step -= 1"
          />
        </v-stepper-content>
        <!-- Localización -->
        <!-- Formación Académica -->
        <v-stepper-step
          :complete="step > 4"
          step="4"
          @click="changeStepSection(4)"
          class="pt-0 pb-2"
          color="#2D52A8"
        >
          <h6 class="ml-2 mb-1">Formación Académica</h6>
          <small class="ml-2">Nivel Educativo Obtenido</small>
        </v-stepper-step>

        <v-stepper-content step="4" class="pt-0 pb-0 pr-5">
          <step-4
            v-if="step >= 4"
            :culturalAgent="culturalAgent.step4"
            :validation="$v.culturalAgent.step4"
            @update-alert="
              updateAlert($event.show, $event.message, $event.type)
            "
            @valid-step="saveData($event)"
            @get-back="step -= 1"
          />
        </v-stepper-content>
        <!-- Formación Académica -->
      </v-app>
    </v-stepper>
    <v-card v-else class="card-rounded">
      <v-row>
        <v-col cols="12" xs="12" align="center">
          <loader />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script src="./index.js" />

<style>
.v-stepper__wrapper {
  height: 100%;
}

.v-input__slot {
  padding: 0px 2px 2px 5px;
}

div.v-input {
  height: 75% !important;
}
</style>
