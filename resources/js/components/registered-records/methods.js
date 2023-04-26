import axios from "axios";

export default {
    async initialize() {
        this.loading = true;
        let res = await axios.get("/api/registeredRecordById", {
            params: { id: this.registeredRecordSelected },
        });

        this.employee = res.data.registeredRecords;
        this.employee.vulnerableArea =
            res.data.registeredRecords.vulnerable_area == 1 ? "Sí" : "No";

        this.families = res.data.families;
        this.academics = res.data.academics;

        this.loading = false;
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
