import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const subdirectionApi = axios.create({
    baseURL: "/api/web/subdirection",
});

// subdirectionApi.interceptors.request.use(interceptorRequest);
// subdirectionApi.interceptors.response.reject(interceptorReponse);

export default subdirectionApi;
