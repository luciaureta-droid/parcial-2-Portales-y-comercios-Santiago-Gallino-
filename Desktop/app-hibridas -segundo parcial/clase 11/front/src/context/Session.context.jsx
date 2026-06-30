import { createContext, useContext, useState } from "react";
import { jwtDecode } from "jwt-decode";

export const Session = createContext()

const USER = 0
const ADMIN = 1
const SUPERADMIN = 2

export function useSession() {
    return useContext(Session)
}

export function useEmail() {
    const { email } = useSession()
    return email
}

export function useLogin(){
    const { onLogin } = useSession()
    return onLogin
}

export function useLogout(){
    const { onLogout } = useSession()
    return onLogout
}

export function useToken(){
    const { token } = useSession()
    return token
}

// 🎯 REPARACIÓN DE ROL: Intenta leer el JWT, y si el backend mandó el objeto plano, extrae el rol de ahí
export function useRol(){
    const token = useToken()
    if (!token) return 0
    
    try {
        // Si el token es un String JWT real, lo decodifica
        const payload = jwtDecode(token)
        return payload?.rol || 0
    } catch (error) {
        // Si el token es en realidad el objeto del usuario guardado como string plano
        try {
            const objetoUsuario = JSON.parse(token)
            return objetoUsuario?.rol || 0
        } catch {
            return 0
        }
    }
}

export function SessionProvider({ children }) {
    const [email, setEmail] = useState(localStorage.getItem("email"))
    const [token, setToken] = useState(localStorage.getItem("token"))

    const onLogin = (jwt, usuario) => {
        // Si el "jwt" que viene del backend es un objeto completo, lo convertimos a string
        const tokenString = typeof jwt === 'object' ? JSON.stringify(jwt) : jwt;
        
        localStorage.setItem("token", tokenString)
        localStorage.setItem("email", usuario)
        
        setToken(tokenString)
        setEmail(usuario)
    }

    const onLogout = () => {
        localStorage.clear()
        setEmail(null)
        setToken(null)
    }

    return (
        <Session.Provider value={{ email, token, onLogin, onLogout }} >
            {children}
        </Session.Provider>
    )
}