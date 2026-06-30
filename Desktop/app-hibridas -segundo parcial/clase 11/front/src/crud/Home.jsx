import React from 'react'
import { Link } from 'react-router-dom'
import { useMascotas } from '../hooks/useMascotas' // ✅ Ajustado a un nivel para que encuentre tus hooks
import { useRol } from '../context/Session.context' // ✅ Ajustado a un nivel y sin la S en context

const Home = () => {
  const { mascotas, loading, error } = useMascotas()
  const rol = useRol()
  
  if (loading) return <div className='h1'>Cargando...</div>
  if (error) return <div className='h1'>No se pueden traer las mascotas</div>

  return (
    <div className='container-fluid'>
      {rol >= 1 && <Link to="/nueva-mascota" className='btn btn-primary my-2'>Nueva mascota</Link>}
      <table className='table mt-3'>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre Mascota</th>
            <th>Especie</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {
            mascotas && mascotas.map(mascota => (
              <tr key={mascota._id}>
                <td>{
                  mascota?.foto
                    ? <img width="100px" src={`http://localhost:3333/fotos/${mascota.foto}`} alt="" />
                    : "Sin foto"
                }</td>
                <td>{mascota.nombre}</td>
                <td>{mascota.especie}</td>
                <td>
                  <Link className='btn btn-info m-1' to={"/detalle/" + mascota._id}>Ver</Link>
                  {rol >= 1 && <Link className='btn btn-warning m-1' to={"/modificar-mascota/" + mascota._id}>Editar</Link>}
                  {rol >= 2 && <Link className='btn btn-danger m-1' to={"/borrar-mascota/" + mascota._id}>Borrar</Link>}
                </td>
              </tr>
            ))
          }
        </tbody>
      </table>
    </div>
  )
}

export default Home