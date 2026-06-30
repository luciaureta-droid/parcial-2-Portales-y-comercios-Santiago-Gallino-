import { useNavigate } from "react-router-dom";
import { useToken } from "../context/Session.context"; // Ajustado a "context" en singular

export function useApi() {

    const token = useToken()
    const navigate = useNavigate()

    const call = (uri, method, body) => {
        return fetch("http://localhost:3333/api" + uri, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(body)
        })
            .then(res => {
                if (res.ok) return res.json()
                if (res.status == 401) navigate("/login")
                throw new Error("Error al procesar la petición")
            })
    }

    return { call }
}