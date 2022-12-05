import axios from "axios";

import Data from "./data";
import Methods from "./methods";

export default {
    data() {
        return Data;
    },
    props: { registeredRecordSelected: {} },
    watch: {},
    mounted() {
        this.initialize();
    },
    methods: Methods,
};
