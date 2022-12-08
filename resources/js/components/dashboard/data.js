export default {
    loading: false,
    step: 1,
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
            emergency_full_name: "",
            kinship_name: "",
            emergency_phone: "",
            emergency_cell_phone: "",
            emergency_address: "",
            families: [],
        },

        step4: {
            subjects_approved: "",
            academics: [],
        },

        step5: {
            dui_file: "",
            title_file: "",
        },
    },

    textAlert: "",
    showAlert: false,
    alertEvent: "success",
    redirectSessionFinished: false,
    counterAlert: 0,
    sendToHome: false,
    alertTimeOut: 0,
    timeAlert: 5000,
};
