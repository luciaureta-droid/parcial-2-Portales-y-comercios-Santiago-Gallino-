import React, { useEffect, useState } from "react"
import { Link, useParams, useNavigate } from "react-router-dom"
import { useToken } from "../context/Session.context" 
import { useMascotasService } from "../services/mascota.service" 

const Detalle = () => {
    const [mascota, setMascota] = useState(null)
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState(null)

    const { idMascota } = useParams()
    const navigate = useNavigate()

    const { getMascotasById } = useMascotasService()

    useEffect(() => {
        getMascotasById(idMascota)
            .then(res => {
                // 🛠️ Solución al vacío: Si res.data no existe, tomamos "res" directamente
                const datosMascota = res.data || res
                setMascota(datosMascota)
            })
            .catch(err => setError(err.message))
            .finally(() => setLoading(false))
    }, [idMascota, getMascotasById])

    // 📋 Función auxiliar para mostrar la fecha de forma legible
    const formatearFecha = (fechaString) => {
        if (!fechaString) return "No especificada"
        const fecha = new Date(fechaString)
        if (isNaN(fecha.getTime())) return fechaString
        return fecha.toLocaleDateString('es-AR', { timeZone: 'UTC' })
    }

    if (loading) return <div className="h1 text-center mt-5">Cargando..</div>
    if (error || !mascota) return <div className="h1 text-center mt-5 alert alert-danger">No se encontró la mascota</div>

    return (
        <div className="container mt-4">
            <div className="card shadow-sm p-3 mb-5 bg-body rounded mx-auto" style={{ maxWidth: "700px" }}>
                <div className="row g-0 align-items-center">
                    
                    {/* Columna de la Imagen o ID lateral */}
                    <div className="col-md-4 text-center p-2">
                        {mascota?.foto ? (
                            <img 
                                className="img-fluid rounded" 
                                style={{ maxHeight: "220px", objectFit: "cover" }}
                                src={`http://localhost:3333/fotos/${mascota.foto}`} 
                                alt={mascota.nombre} 
                            />
                        ) : (
                            <div className="p-4 bg-light border text-muted rounded text-center">
                                <span className="fs-1 d-block mb-2">🐾</span>
                                <small className="font-monospace text-break d-block">ID:</small>
                                <small className="font-monospace text-break fw-bold">{mascota?._id || idMascota}</small>
                            </div>
                        )}
                    </div>

                    {/* Columna de los Datos Clínicos */}
                    <div className="col-md-8">
                        <div className="card-body">
                            <h3 className="card-title text-primary fw-bold mb-3">
                                {mascota?.nombre || "Paciente Sin Nombre"}
                            </h3>
                            <hr />
                            <p className="card-text fs-5">
                                <strong>Especie:</strong> <span className="badge bg-info text-dark ms-2">{mascota?.especie || "No especificada"}</span>
                            </p>
                            <p className="card-text fs-6">
                                <strong>Raza:</strong> <span className="text-secondary ms-1">{mascota?.raza || "No especificada"}</span>
                            </p>
                            <p className="card-text fs-6">
                                <strong>Fecha de Nacimiento:</strong> <span className="text-secondary ms-1">{formatearFecha(mascota?.fechaNacimiento)}</span>
                            </p>
                            
                            <div className="mt-4 text-end">
                                <Link className="btn btn-outline-primary fw-bold px-4" to="/">
                                    Volver al listado
                                </Link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    )
}

export default Detalle