import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const employeeStatusApi = axios.create({
    baseURL: "/api/web/employeeStatus",
});

// employeeStatusApi.interceptors.request.use(interceptorRequest);
// employeeStatusApi.interceptors.response.reject(interceptorReponse);

export default employeeStatusApi;
