import axios from "axios";

export default {
    async initialize() {
        // this.disableButton = false;
        this.loading = true;
        let res = await axios.get("/api/registeredRecordById", {
            params: { id: this.registeredRecordSelected },
        });

        this.employee = res.data.registeredRecords;
        // console.log(this.employee);
        this.employee.vulnerableArea =
            res.data.registeredRecords.vulnerable_area == 1 ? "Sí" : "No";

        this.families = res.data.families;
        this.academics = res.data.academics;

        // this.showStudies = true;
        this.loading = false;
    },

    async saveData() {
        this.culturalAgent.studies = this.studies;
        this.culturalAgent.recognitions = this.recognitions;
        this.culturalAgent.disabilities = this.disabilitiesCulturalAgent;
        this.culturalAgent.dependents = this.dependents;

        const res = await axios
            .post("api/culturalAgent", this.culturalAgent)
            .catch((error) => {
                console.log(error + " No se pudo registrar el agente cultural");
            });

        if (res.data.message == "success") {
            this.updateAlert(
                true,
                "Registros almacenados correctamente.",
                "success"
            );
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
