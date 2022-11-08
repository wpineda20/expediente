import {
    required,
    minLength,
    maxLength,
    helpers,
    email,
    minValue,
    maxValue,
    requiredIf,
} from "vuelidate/lib/validators";

const httpsValid = helpers.regex("https", /^https:\/\//);

const validations = {
    employee: {
        step1: {
            full_name: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            family_status_name: {
                required,
            },
            profession_name: {
                required,
            },
            current_address: {
                required,
                minLength: minLength(1),
            },
            department_name: {
                required,
                minLength: minLength(1),
            },
            municipality_name: {
                required,
                minLength: minLength(1),
            },
            vulnerableArea: {
                required,
            },
            personal_email: {
                required,
                email,
            },
            phone: {
                isValidNumber: helpers.regex(
                    "isValidNumber",
                    /([0-9]{4}-[0-9]{4})/
                ),
            },
            cell_phone: {
                required,
                isValidNumber: helpers.regex(
                    "isValidNumber",
                    /([0-9]{4}-[0-9]{4})/
                ),
            },
        },
        step2: {
            direction_name: {
                required,
            },
            subdirection_name: {
                required,
            },
            unit_name: {
                required,
            },
            nominal_fee: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            functional_position: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            immediate_superior: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            email_institutional: {
                required,
                email,
            },
            department_name: {
                required,
                minLength: minLength(1),
            },
            municipality_name: {
                required,
                minLength: minLength(1),
            },
        },
        step3: {
            full_name: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            kinship_name: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(150),
            },
            phone: {
                isValidNumber: helpers.regex(
                    "isValidNumber",
                    /([0-9]{4}-[0-9]{4})/
                ),
            },
            cell_phone: {
                required,
                isValidNumber: helpers.regex(
                    "isValidNumber",
                    /([0-9]{4}-[0-9]{4})/
                ),
            },
        },
        step4: {
            subjects_approved: {
                minLength: minLength(1),
                maxLength: maxLength(2),
            },
        },
        step5: {
            dui_file: {
                required,
                minLength: minLength(1),
            },
            title_file: {
                required,
                minLength: minLength(1),
            },
        },
    },
};

export default validations;
