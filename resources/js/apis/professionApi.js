import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const professionApi = axios.create({
    baseURL: "/api/web/profession",
});

// professionApi.interceptors.request.use(interceptorRequest);
// professionApi.interceptors.response.reject(interceptorReponse);

export default professionApi;
