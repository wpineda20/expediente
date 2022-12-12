import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const dependenceApi = axios.create({
    baseURL: "/api/web/dependence",
});

// dependenceApi.interceptors.request.use(interceptorRequest);
// dependenceApi.interceptors.response.reject(interceptorReponse);

export default dependenceApi;
