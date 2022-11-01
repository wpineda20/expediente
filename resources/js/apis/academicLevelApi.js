import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const academicLevelApi = axios.create({
    baseURL: "/api/web/academicLevel",
});

// academicLevelApi.interceptors.request.use(interceptorRequest);
// academicLevelApi.interceptors.response.reject(interceptorReponse);

export default academicLevelApi;
