import Validations from "./validations";

import Data from "./data";
import Methods from "./methods";

export default {
    data: () => {
        return Data;
    },

    // Validations
    validations: Validations,

    // Validations
    watch: {
        dialog(val) {
            val || this.close();
        },
        step(val, oldVal) {
            // console.log(this.step);
            if (val != oldVal) {
                this.getDataForm();
                this.culturalAgent.idSection = val;
                this.setLocalStorage();
            }

            if (val == 10) {
                this.sendToHome = true;
            }
        },
    },

    created() {
        if (this.userAccess > 1) {
            window.location = "/";
        }
    },

    mounted() {
        this.initialize();
    },

    methods: Methods,
};
