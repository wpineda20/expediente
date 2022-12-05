import axios from "axios";

export default {
    async initialize() {
        // this.disableButton = false;
        this.loading = true;
        let res = await axios.get("/api/registeredRecordById", {
            params: { id: this.registeredRecordSelected },
        });

        this.employee = res.data.registeredRecords;
        this.employee.vulnerableArea =
            res.data.registeredRecords.vulnerable_area == 1 ? "Sí" : "No";

        this.families = res.data.families;
        this.academics = res.data.academics;

        // this.showStudies = true;
        this.loading = false;
    },

    fillSelect(array, data, defaultMessage, property_name) {
        data.forEach((element) => {
            array.push({
                name: element[property_name],
            });
        });
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

    addCheck(check, element) {
        if (!this.checks.includes(check)) {
            this.checks.push(check);
            this.notes[element].state = true;
        } else {
            const index = this.checks.indexOf(check);
            this.checks.splice(index, 1);
            this.notesAdded.splice(index, 1);
            this.notes[element].state = false;
            this.notes[element].text = "";
        }
    },

    addCheckTitleArrays(check) {
        if (!this.checks.includes(check)) {
            this.checks.push(check);
        } else {
            const index = this.checks.indexOf(check);
            this.checks.splice(index, 1);
        }
    },

    addCheckArrays(type, id) {
        switch (type) {
            case "studies":
                if (!this.checksStudies[id].state) {
                    this.checksStudies[id].state = true;
                    this.flagsNotification.studies = true;
                } else {
                    this.checksStudies[id].state = false;
                    this.flagsNotification.studies = false;
                }
                this.checksStudies[id].text = "";
                break;
            case "works":
                if (!this.checksWorks[id].state) {
                    this.checksWorks[id].state = true;
                    this.flagsNotification.works = true;
                } else {
                    this.checksWorks[id].state = false;
                    this.flagsNotification.works = false;
                }
                this.checksWorks[id].text = "";
                break;
            case "disabilities":
                if (!this.checksDisabilities[id].state) {
                    this.flagsNotification.disabilities = true;
                    this.checksDisabilities[id].state = true;
                } else {
                    this.checksDisabilities[id].state = false;
                    this.flagsNotification.disabilities = false;
                }
                this.checksDisabilities[id].text = "";
                break;
            case "recognitions":
                if (!this.checksRecognitions[id].state) {
                    this.checksRecognitions[id].state = true;
                    this.flagsNotification.recognitions = true;
                } else {
                    this.checksRecognitions[id].state = false;
                    this.flagsNotification.recognitions = false;
                }
                this.checksRecognitions[id].text = "";
                break;
            case "dependents":
                if (!this.checksDependents[id].state) {
                    this.checksDependents[id].state = true;
                    this.flagsNotification.dependents = true;
                } else {
                    this.checksDependents[id].state = false;
                    this.flagsNotification.dependents = false;
                }
                this.checksDependents[id].text = "";
                break;
        }
        this.verifyNotify();
    },

    addNote(check, note) {
        if (!this.checks.includes(check)) {
            this.notesAdded.push(this.notes[note].text);
        } else {
            const index = this.checks.indexOf(check);
            this.notesAdded[index] = this.notes[note].text;
        }
        console.log(this.checks, this.notes, this.notes[note].text);
    },

    addNoteArrays(type, id, name) {
        this.verifyNotify();
        switch (type) {
            case "studies":
                if (!this.notes["studies"][id]) {
                    const object = {
                        name: name,
                        text: this.checksStudies[id].text,
                    };
                    this.notes["studies"].splice(id, 0, object);
                } else {
                    this.notes["studies"][id].text =
                        this.checksStudies[id].text;
                }
                break;
            case "works":
                if (!this.notes["works"][id]) {
                    const object = {
                        name: name,
                        text: this.checksWorks[id].text,
                    };
                    this.notes["works"].splice(id, 0, object);
                } else {
                    this.notes["works"][id].text = this.checksWorks[id].text;
                }
                break;
            case "disabilities":
                if (!this.notes["disabilities"][id]) {
                    const object = {
                        name: name,
                        text: this.checksDisabilities[id].text,
                    };
                    this.notes["disabilities"].splice(id, 0, object);
                } else {
                    this.notes["disabilities"][id].text =
                        this.checksDisabilities[id].text;
                }
                break;
            case "recognitions":
                if (!this.notes["recognitions"][id]) {
                    const object = {
                        name: name,
                        text: this.checksRecognitions[id].text,
                    };

                    this.notes["recognitions"].splice(id, 0, object);
                } else {
                    this.notes["recognitions"][id].text =
                        this.checksRecognitions[id].text;
                }
                break;
            case "dependents":
                if (!this.notes["dependents"][id]) {
                    const object = {
                        name: name,
                        text: this.checksDependents[id].text,
                    };
                    this.notes["dependents"].splice(id, 0, object);
                } else {
                    this.notes["dependents"][id].text =
                        this.checksDependents[id].text;
                }
                break;
        }
        this.verifyNotify();
    },

    async notifyUser() {
        this.disableButton = true;
        const res = await axios
            .post("api/agent/notify", {
                culturalAgent: this.culturalAgent,
                checks: this.checks,
                notesAdded: this.notesAdded,
                notesStudies: this.notes["studies"],
                notesWorks: this.notes["works"],
                notesRecognitions: this.notes["recognitions"],
                notesDisabilities: this.notes["disabilities"],
                notesDependents: this.notes["dependents"],
                description: this.description,
            })
            .catch((error) => {
                console.log(
                    error + " No fue posible notificar al agente cultural"
                );
            });

        if (res.data.message == "success") {
            this.updateAlert(
                true,
                "Usuario notificado exitosamente.",
                "success"
            );
            this.$refs.top.scrollIntoView();
            location.reload();
        }

        this.dialog = false;
    },

    async publishUser() {
        this.disableButton = true;
        const res = await axios
            .post("api/agent/publish", {
                culturalAgentId: this.culturalAgent.cultural_agent,
            })
            .catch((error) => {
                console.log(
                    error + " No fue posible verificar al agente cultural"
                );
            });

        if (res.data.message == "success") {
            this.updateAlert(true, "Usuario publicado exitosamente", "success");
            setTimeout(() => {
                location.reload();
            }, 3000);
        }

        this.dialog = false;
    },

    verifyNotify() {
        if (
            this.checks.length > 0 ||
            this.flagsNotification.studies ||
            this.flagsNotification.works ||
            this.flagsNotification.recognitions ||
            this.flagsNotification.disabilities ||
            this.flagsNotification.dependents
        ) {
            this.btnNotify = true;
            this.txtNotify = true;
            return;
        }

        this.txtNotify = false;
        this.btnNotify = false;
    },

    watchFile(url) {
        console.log(url);
        window.open(url);
    },

    updateTags() {
        let array = [];
        try {
            array = this.skill.split(",");
            array.forEach((el) => this.skills.push(el));
        } catch (error) {
            // console.log("Error: " + error);
        }

        this.$nextTick(() => {
            this.skill = "";
        });
    },
    getfullName() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Nombre Completo:"
            : "Nombre Comercial: ";
    },
    getName() {
        console.log(this.culturalAgent);
        return this.culturalAgent.cultural_agent_type == 1
            ? "Nombre Artístico:"
            : "Razón Social: ";
    },
    getTelefono() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Teléfono:"
            : "Teléfono Comercial: ";
    },
    getRedes() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Mis redes artísticas:"
            : "Redes Sociales: ";
    },
    getfullName() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Nombre Completo:"
            : "Nombre Comercial: ";
    },
    getTelefono2() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Teléfono Personal:"
            : "Otro Teléfono: ";
    },
    getTitle1() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Información Personal"
            : "Información de la Empresa ";
    },
    getTitle2() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Documentos Personales"
            : "Documentos de la Empresa ";
    },
    getSubTitle2() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Documentación Personal"
            : "Documentación Empresarial ";
    },
    getSubTitle3() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Residencia Personal"
            : "Ubicación de la Empresa ";
    },
    getTitle5() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Estudios Académicos"
            : "Estudios Académicos o Especializaciones en Arte y Cultura ";
    },
    getSubTitle5() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Estudios Personales, Residencias Artísticas o Becas"
            : "Especializaciones y/o Acreditaciones en Arte y Cultura ";
    },
    getTitle6() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Experiencia Laboral y Actividades Económicas"
            : "Actividades Económicas ";
    },
    getSubTitle6() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Datos Profesionales"
            : "Datos y Especificaciones Económicas ";
    },
    getTitleTable2() {
        return this.culturalAgent.cultural_agent_type == 1
            ? "Años de Trabajo"
            : "Rango de Ingreso Anual ";
    },
    getTitleTable3() {
        return this.culturalAgent.cultural_agent_type == 1 ? "Descripción" : "";
    },
    getTitleTable4() {
        return this.culturalAgent.cultural_agent_type == 1 ? "Archivo" : "";
    },
};
