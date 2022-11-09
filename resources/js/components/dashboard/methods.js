import axios from "axios";
import { getData, getInfoEmployee, setInfoEmployee } from "../../libs/function";

export default {
    async initialize() {
        const dataEmployee = await getInfoEmployee();
        this.employee = setInfoEmployee(dataEmployee);
        this.verifyStepStorage();
        // Getting info of the selects by steps
        this.getDataForm();
    },

    async getDataForm() {
        let responses = [];
        this.loading = true;

        responses = await getData(this.step);
        console.log(this.step);

        switch (this.step) {
            case 1:
                this.familyStatus = responses[0].data.records;
                this.professions = responses[1].data.records;
                this.departments = responses[2].data.departments;
                this.vulnerableArea = [{ name: "Sí" }, { name: "No" }];
                break;
            case 2:
                this.departments = responses[0].data.departments;
                this.directions = responses[1].data.records;
                this.subdirections = responses[2].data.records;
                this.units = responses[3].data.records;
                break;
            case 3:
                this.kinships = responses[0].data.records;
                break;
            case 4:
                this.academicLevels = responses[0].data.records;
                break;
            case 5:
                break;
        }

        this.loading = false;
    },

    changeStepSection(step = 1) {
        this.step = step;
    },

    async saveData() {
        this.employee["step" + this.step].idSection = this.step;

        const { data } = await axios
            .post("api/employee", this.employee["step" + this.step])
            .catch((error) => {
                this.updateAlert(
                    true,
                    "No fue posible actualizar la información del empleado.",
                    "fail"
                );
                this.verifySessionFinished(error.response.status, 419);
            });

        if (data.success) {
            // Final message for employee
            if (this.step == 5) {
                this.sendToHome = true;
                this.timeAlert = 20000;
            }
            this.updateAlert(true, data.message, "success");

            this.step++;
            this.setLocalStorage();
        }
    },

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

    setLocalStorage() {
        window.localStorage.setItem("step", this.step);
    },

    verifyStepStorage() {
        const step = window.localStorage.getItem("step");

        this.step = step ? parseInt(step) : 1;
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
