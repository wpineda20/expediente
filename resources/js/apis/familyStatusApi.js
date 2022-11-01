import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const familyStatusApi = axios.create({
    baseURL: "/api/web/familyStatus",
});

// familyStatusApi.interceptors.request.use(interceptorRequest);
// familyStatusApi.interceptors.response.reject(interceptorReponse);

export default familyStatusApi;
