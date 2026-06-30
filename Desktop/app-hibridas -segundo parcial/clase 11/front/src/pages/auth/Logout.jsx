import { Navigate } from "react-router-dom"
import { useLogout } from "../../context/Session.context" // ✅ Corregido con ../../ para subir dos niveles
import { useEffect } from "react"

const Logout = () => {
    const logout = useLogout()

    useEffect(() => {
        logout()
    }, [])
    
    return <Navigate to="/login" />
}

export default Logout