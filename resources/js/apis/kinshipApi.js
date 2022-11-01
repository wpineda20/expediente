import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const kinshipApi = axios.create({
    baseURL: "/api/web/kinship",
});

// kinshipApi.interceptors.request.use(interceptorRequest);
// kinshipApi.interceptors.response.reject(interceptorReponse);

export default kinshipApi;
