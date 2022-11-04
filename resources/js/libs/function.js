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
    }

    return await Promise.all(requests);
};

export const httpsValid = helpers.regex("https", /^https:\/\//);
