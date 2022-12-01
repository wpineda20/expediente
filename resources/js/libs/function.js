import axios from "axios";
import { helpers } from "vuelidate/lib/validators";

export default {
    verifySessionFinished: (status, code = 200) => {
        console.log(status);
        if (status == 419 || status == 401) {
            console.log("L" + status);
            return true;
        }
        return false;
    },
};

export const getInfoEmployee = async () => {
    const { data } = await axios
        .get("/api/employee/infoUserLoggedIn")
        .catch((error) => {
            console.log(error);
        });

    return data.employee;
};

export const getData = async (step) => {
    let requests = [];

    switch (step) {
        case 1:
            requests = [
                axios.get("/api/familyStatus", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
                axios.get("/api/professions", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
                axios.get("/api/departments", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
            ];
            break;
        case 2:
            requests = [
                axios.get("/api/departments", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
                axios.get("/api/directions", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
                axios.get("/api/subdirections", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
                axios.get("/api/units", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
            ];
            break;
        case 3:
            requests = [
                axios.get("/api/kinships", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
            ];
            break;
        case 4:
            requests = [
                axios.get("/api/academicLevels", {
                    params: {
                        itemsPerPage: -1,
                    },
                }),
            ];
            break;
        case 5:
            break;
    }

    return await Promise.all(requests);
};

export const setInfoEmployee = (employee) => {
    return {
        idSection: employee.idSection,
        step1: {
            full_name: employee.full_name,
            family_status_name: employee.family_status_name,
            profession_name: employee.profession_name,
            current_address: employee.current_address,
            department_name: employee.department_name,
            municipality_name: employee.municipality_name,
            vulnerableArea: employee.vulnerable_area == 1 ? "Sí" : "No",
            personal_email: employee.personal_email,
            phone: employee.phone,
            cell_phone: employee.cell_phone,
        },
        step2: {
            direction_name: employee.direction_name,
            subdirection_name: employee.subdirection_name,
            unit_name: employee.unit_name,
            nominal_fee: employee.nominal_fee,
            functional_position: employee.functional_position,
            immediate_superior: employee.immediate_superior,
            email_institutional: employee.email_institutional,
            department_name: employee.department_name,
            municipality_name: employee.municipality_assigned_id,
        },
        step3: {
            emergency_full_name: employee.emergency_full_name,
            emergency_phone: employee.emergency_phone,
            emergency_cell_phone: employee.emergency_cell_phone,
            kinship_name: employee.kinship_name,
            families: employee.families,
        },
        step4: {
            academics: employee.academics,
            subjects_approved: employee.subjects_approved,
        },
        step5: {
            dui_file: employee.dui_file,
            title_file: employee.title_file,
        },
    };
};

// export const getAllRecords = async () => {
//     const { data } = await axios
//         .get("/api/employee/registeredRecords")
//         .catch((error) => {
//             console.log(error);
//         });

//     return data.employee;
// };

export const httpsValid = helpers.regex("https", /^https:\/\//);
