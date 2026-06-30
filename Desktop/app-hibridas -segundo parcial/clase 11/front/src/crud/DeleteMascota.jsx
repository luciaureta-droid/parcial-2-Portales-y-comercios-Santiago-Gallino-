import React, { useEffect, useState } from "react";
import { Link, useNavigate, useParams } from "react-router-dom";
import { useMascotasService } from "../services/mascota.service"; // ✅ CORREGIDO: "mascota.service" en singular

const DeleteMascota = () => {
    const [mascota, setMascota] = useState(null)
    const { idMascota } = useParams()
    const { getMascotasById, deleteMascota } = useMascotasService()

    const navigate = useNavigate()
    
    const handleSubmit = (e) => {
        e.preventDefault()

        deleteMascota(idMascota)
            .then(() => navigate("/"))
            .catch((err) => console.log(err))
    }

    useEffect(() => {
        getMascotasById(idMascota)
            .then(data => {
                setMascota(data.data)
            })
            .catch(err => console.log(err))
    }, [idMascota])

    return (
        <div className="d-flex justify-content-center align-items-center flex-column" >
            <p className="fs-1" >¿Desea borrar a la mascota <b>{mascota?.nombre}</b>?</p>
            <form onSubmit={handleSubmit} className="d-flex gap-2" >
                <button type="submit" className="btn btn-danger" >Sí</button>
                <Link className="btn btn-primary" to="/">No</Link>
            </form>
        </div>
    )
}

export default DeleteMascota