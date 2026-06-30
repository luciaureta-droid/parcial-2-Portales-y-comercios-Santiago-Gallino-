import { useState, useEffect } from "react";
import { useMascotasService } from "../services/mascota.service"; 

// Hook para traer una sola mascota por su ID
export const useMascota = (idMascota) => {
    const [mascota, setMascota] = useState(null)
    const [loading, setLoading] = useState(true)

    const { getMascotasById } = useMascotasService() 

    useEffect(() => {
        getMascotasById(idMascota)
            .then(data => {
                // Mapeo seguro usando .data según la respuesta del servidor
                setMascota(data.data || data) 
            })
            .catch(err => console.error(err))
            .finally(() => setLoading(false))
    }, [idMascota])

    return { mascota, loading }
}

// Hook para traer el listado de todas las mascotas de la veterinaria
export const useMascotas = () => {
    const [mascotas, setMascotas] = useState(null)
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState(null)

    const { getMascotas } = useMascotasService()

    useEffect(() => {
        getMascotas()
            .then(data => {
                // 🧠 CONTROL DEL PROFE: Si los datos vienen dentro de .data los extraemos, si no, usamos data directo
                const listado = data.data || data
                setMascotas(listado)
            })
            .catch(err => {
                console.error("Error al traer mascotas:", err)
                setError(err)
            })
            .finally(() => setLoading(false))
    }, [])

    return { mascotas, loading, error }
}