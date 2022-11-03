import axios from "axios";
import { getData } from "../../libs/function";

export default {
    async initialize() {
        // Getting info of the selects by steps
        this.getDataForm();
    },

    async getDataForm() {
        let responses = [];
        // this.loading = true;

        responses = await getData(this.step);
        console.log(this.step);

        switch (this.step) {
            case 1:
                this.familyStatus = responses[0].data.familyStatus;
                this.professions = responses[1].data.professions;
                this.departments = responses[2].data.departments;
                this.vulnerableArea = [{ name: "Sí" }, { name: "No" }];
                // console.log(this.departments);
                break;
            case 2:
                this.directions = responses[0].data.directions;
                this.subdirections = responses[1].data.subdirections;
                this.units = responses[2].data.units;
                this.departments = responses[3].data.departments;
                break;
            case 3:
                this.kinships = responses[0].data.kinships;
                break;
            case 4:
                break;
        }

        this.loading = false;
    },

    changeStepSection(step = 1) {
        this.step = step;
    },

    // async saveData() {
    //     this.culturalAgent["step" + this.step].idSection = this.step;

    //     const { data } = await axios
    //         .post("api/culturalAgent", this.culturalAgent["step" + this.step])
    //         .catch((error) => {
    //             this.updateAlert(
    //                 true,
    //                 "No fue posible actualizar el agente cultural.",
    //                 "fail"
    //             );
    //             this.verifySessionFinished(error.response.status, 419);
    //         });

    //     if (data.success) {
    //         // Final message for cultural agents
    //         if (this.step == 9) {
    //             this.sendToHome = true;
    //             this.timeAlert = 20000;
    //         }
    //         this.updateAlert(true, data.message, "success");

    //         this.step++;
    //         this.setLocalStorage();
    //     }
    // },

    // calculateDate() {
    //     let today = new Date();
    //     let year = today.getFullYear() - 18;
    //     let date = today.setFullYear(year);
    //     return new Date(date).toISOString();
    // },

    verifySessionFinished(status, code) {
        if (status == code) {
            if (status == 419 || status == 401) {
                this.redirectSessionFinished = true;
            }
            this.alertTimeOut++;
        }
    },

    updateAlert(show = false, text = "", event = "success", timeAlert = 5000) {
        if (text == "" && show) {
            return;
        }

        this.textAlert = text;
        this.alertEvent = event;
        this.showAlert = show;

        if (show) {
            this.$refs.top.scrollIntoView();
        }
    },
};
