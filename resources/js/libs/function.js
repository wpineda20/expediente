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
                axios.get("/api/familyStatus"),
                axios.get("/api/professions"),
                axios.get("/api/departments"),
            ];
            break;
        case 2:
            requests = [
                axios.get("/api/departments"),
                axios.get("/api/directions"),
                axios.get("/api/subdirections"),
                axios.get("/api/units"),
            ];
            break;
        case 3:
            requests = [axios.get("/api/kinships")];
            break;
    }

    return await Promise.all(requests);
};

export const httpsValid = helpers.regex("https", /^https:\/\//);
