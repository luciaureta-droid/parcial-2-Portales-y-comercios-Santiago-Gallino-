import { useApi } from "./api.service";

export function useMascotasService() {
    const { call } = useApi()

    const getMascotas = () => call("/clientes")
    const getMascotasById = (idMascota) => call("/clientes/" + idMascota)
    
    const createMascotas = (nombre, especie, edad, dueno) =>
        call("/clientes", "POST", {
            nombre: nombre,
            especie: especie,
            edad: edad,
            dueno: dueno
        })
        
    const updateMascotas = (nombre, especie, edad, dueno, idMascota) =>
        call("/clientes/" + idMascota, "PUT", {
            nombre: nombre,
            especie: especie,
            edad: edad,
            dueno: dueno
        })
        
    const deleteMascota = (idMascota) => call("/clientes/" + idMascota, "DELETE")
    
    return { getMascotas, getMascotasById, createMascotas, updateMascotas, deleteMascota }
}