import { useForm } from "react-hook-form"
import { useNavigate } from "react-router-dom"
import { useToken } from "../context/Session.context"

const NuevaMascota = () => {
    const { register, handleSubmit } = useForm()
    const navigate = useNavigate()
    const token = useToken()

    const onSubmit = (formData) => {
        // Si el usuario seleccionó un archivo de foto, usamos FormData como pide el profe
        if (formData.foto?.[0]) {
            const data = new FormData()
            data.append("nombre", formData.nombre)
            data.append("especie", formData.especie)
            data.append("raza", formData.raza)
            data.append("fechaNacimiento", formData.fechaNacimiento)
            data.append("file", formData.foto[0])

            fetch("http://localhost:3333/api/clientes", {
                method: "POST",
                headers: { authorization: `Bearer ${token}` },
                body: data
            })
            .then(res => {
                if (!res.ok) throw new Error("Error en el servidor al guardar con foto")
                return res.json()
            })
            .then(() => navigate("/"))
            .catch(err => console.log(err))
        } else {
            // ✅ CLAVE: Si NO hay foto, mandamos un JSON limpio para evitar el Error 500 del servidor
            const objetoJson = {
                nombre: formData.nombre,
                especie: formData.especie,
                raza: formData.raza,
                fechaNacimiento: formData.fechaNacimiento
            }

            fetch("http://localhost:3333/api/clientes", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "authorization": `Bearer ${token}` 
                },
                body: JSON.stringify(objetoJson)
            })
            .then(res => {
                if (!res.ok) throw new Error("Error en el servidor al guardar sin foto")
                return res.json()
            })
            .then(() => navigate("/"))
            .catch(err => console.log(err))
        }
    }

    return (
        <div className="container">
            <div className="card mt-3 p-3">
                <p className="h1 mb-3 text-center"> Nuevo paciente </p>
                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="mb-2">
                        <label className="form-label">Nombre</label>
                        <input className="form-control" type="text" {...register("nombre", { required: true })} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Especie</label>
                        <input className="form-control" type="text" {...register("especie", { required: true })} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Raza</label>
                        <input className="form-control" type="text" {...register("raza", { required: true })} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Fecha de Nacimiento</label>
                        <input className="form-control" type="date" {...register("fechaNacimiento", { required: true })} />
                    </div>
                    <div className="mb-2">
                        <label className="form-label">Foto (Opcional):</label>
                        <input className="form-control" accept="image/*" type="file" {...register("foto")} />
                    </div>
                    <button className="btn btn-primary" type="submit">Guardar</button>
                </form>
            </div>
        </div>
    )
}

export default NuevaMascota