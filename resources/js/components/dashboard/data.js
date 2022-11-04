export default {
    loading: false,
    step: 4,
    familyStatus: [],
    professions: [],
    departments: [],
    municipalities: [],
    vulnerableArea: [],
    directions: [],
    subdirections: [],
    units: [],
    kinships: [],
    academicLevels: [],

    employee: {
        idSection: 1,

        step1: {
            full_name: "",
            family_status_name: "",
            profession_name: "",
            current_address: "",
            department_name: "",
            municipality_name: "",
            personal_email: "",
            phone: "",
            vulnerableArea: "",
            cell_phone: "",
        },

        step2: {
            direction_name: "",
            subdirection_name: "",
            unit_name: "",
            nominal_fee: "",
            functional_position: "",
            immediate_superior: "",
            email_institutional: "",
            municipality_name: "",
            department_name: "",
        },

        step3: {
            full_name: "",
            kinship_name: "",
            phone: "",
            cell_phone: "",
        },

        step4: {
            level_name: "",
        },
    },

    // searchProfession: "",
    textAlert: "",
    showAlert: false,
    alertEvent: "success",
    sectionDelete: "",
    redirectSessionFinished: false,
    counterAlert: 0,
    alertTimeOut: 0,
    timeAlert: 5000,
};
