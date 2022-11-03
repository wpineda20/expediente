export default {
    loading: false,
    step: 0,
    departments: [],
    municipalities: [],
    professions: [],
    academicLevels: [],
    employee: {
        idSection: 1,

        step1: {
            full_name: "",
            address: "",
        },

        step2: {},

        step3: {},

        step4: {},
    },

    searchProfession: "",
    textAlert: "",
    showAlert: false,
    alertEvent: "success",
    sectionDelete: "",
    redirectSessionFinished: false,
    counterAlert: 0,
    alertTimeOut: 0,
    timeAlert: 5000,
};
