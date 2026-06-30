import React, { useEffect } from 'react'
import { useForm } from "react-hook-form"
import { useNavigate, useParams, Link } from "react-router-dom"
import { useMascotasService } from "../services/mascota.service" 
import { useToken } from "../context/Session.context" 

const ModificarMascota = () => {
    const { idMascota } = useParams()
    const navigate = useNavigate()
    const { register, handleSubmit, setValue } = useForm()
    const { getMascotasById } = useMascotasService()
    const token = useToken()

    useEffect(() => {
        getMascotasById(idMascota)
            .then(res => {
                const mascota = res.data || res;
                setValue("nombre", mascota?.nombre)
                setValue("especie", mascota?.especie)
                setValue("raza", mascota?.raza)
                
                if (mascota?.fechaNacimiento) {
                    setValue("fechaNacimiento", mascota.fechaNacimiento.split('T')[0])
                }
            })
            .catch(err => console.log(err))
    }, [idMascota, setValue, getMascotasById])

    const onSubmit = (formData) => {
        const data = new FormData()
        data.append("nombre", formData.nombre)
        data.append("especie", formData.especie)
        data.append("raza", formData.raza)
        data.append("fechaNacimiento", formData.fechaNacimiento)
        
        if (formData.foto?.[0]) {
            data.append("file", formData.foto[0])
        }

        // 🚨 Conectamos mediante PUT al cliente específico usando Bearer correcto
        fetch(`http://localhost:3333/api/clientes/${idMascota}`, {
            method: "PUT",
            headers: { 
                authorization: `Bearer ${token}` // 🛠️ Corregido a Bearer
            },
            body: data
        })
            .then(res => {
                if (!res.ok) throw new Error("Error al modificar la mascota")
                return res.json()
            })
            .then(() => navigate("/"))
            .catch(err => console.log(err))
    }

    return (
        <div className="container">
            <div className="card mt-3 p-3">
                <p className="h1 mb-3 text-center">Modificar mascota</p>
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="mb-2">
                        <label className="form-label">Nombre</label>
                        <input className="form-control" type="text" {...register("nombre")} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Especie</label>
                        <input className="form-control" type="text" {...register("especie")} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Raza</label>
                        <input className="form-control" type="text" {...register("raza")} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Fecha de Nacimiento</label>
                        <input className="form-control" type="date" {...register("fechaNacimiento")} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Nueva Foto (opcional)</label>
                        <input className="form-control" accept="image/*" type="file" {...register("foto")} />
                    </div>
                    <div className="d-flex gap-2">
                        <button className="btn btn-warning" type="submit">Modificar</button>
                        <Link className="btn btn-secondary" to="/">Cancelar</Link>
                    </div>
                </form>
            </div>
        </div>
    )
}

export default ModificarMascota