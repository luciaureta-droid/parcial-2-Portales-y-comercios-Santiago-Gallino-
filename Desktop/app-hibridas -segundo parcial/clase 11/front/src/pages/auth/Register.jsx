import React from 'react'
import { useNavigate } from 'react-router-dom'
import { useUsuariosService } from '../../services/usuarios.service' 
import { useForm } from "react-hook-form"

const Register = () => {
  const navigate = useNavigate()

  const {
    register,         // Se conecta con los values de los inputs
    handleSubmit,     // Valida antes de enviar
    watch,
    formState: { errors, isValid } 
  } = useForm({ mode: "onChange" }) // Valida dinámicamente

  const { registro: registroService } = useUsuariosService()

  const email = watch("email", "")
  const pass = watch("pass", "")
  const passConfirm = watch("passConfirm", "")

  const validaciones = {
    longitudMin: pass.length >= 8,
    mayuscula: /[A-Z]/.test(pass),
    minuscula: /[a-z]/.test(pass),
    numero: /[0-9]/.test(pass),
    simbolo: /[@$!%*?&._-]/.test(pass)
  }

  const validacionConfirm = {
    igual: (pass === passConfirm) && pass.length > 0 && passConfirm.length > 0,
    longitudMin: passConfirm.length >= 8,
    mayuscula: /[A-Z]/.test(passConfirm),
    minuscula: /[a-z]/.test(passConfirm),
    numero: /[0-9]/.test(passConfirm),
    simbolo: /[@$!%*?&._-]/.test(passConfirm)
  }

  const isValidPass = Object.values(validaciones).every(value => value === true)
  const isValidPassConfirm = Object.values(validacionConfirm).every(value => value === true)

  const onSubmit = async (formData) => {
    console.log("Datos capturados por el formulario:", formData)

    // 🧠 Armamos el objeto tal cual lo espera recibir el backend
    const datosUsuario = {
      email: formData.email,
      password: formData.pass, // Mapeamos de 'pass' a 'password' para Node.js
      passwordConfirm: formData.passConfirm
    }

    registroService(datosUsuario)
      .then(data => {
        // Si todo sale bien, viajamos directo a la pantalla de Login
        navigate("/login")
      })
      .catch(err => console.error("No se pudo registrar en el servidor", err))
  }

  return (
    <div className='container d-flex justify-content-center align-items-center vh-100' >
      <div className='card p-4 shadow' style={{ width: '350px' }} >
        <h2 className='text-center mb-4' > Registrar Cuenta </h2>
        <form onSubmit={handleSubmit(onSubmit)} >
          <div className='mb-3'>
            <label className='form-label' >Email: </label>
            <input type="email" placeholder='Ingrese su mail' className={`form-control ${email.length > 0
              ? errors?.email
                ? "is-invalid"
                : "is-valid"
              : ""
              }`} name='email'
              {...register("email", {
                required: "El campo email es obligatorio",
                pattern: {
                  value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                  message: "No es un mail válido"
                }
              })} />
            {errors?.email && (
              <div className='invalid-feedback d-block'>
                {errors?.email?.message}
              </div>
            )}
          </div>

          <div className='mb-3'>
            <label className='form-label' >Contraseña: </label>
            <input type="password" placeholder='Ingrese su password' className={`form-control ${pass.length > 0
              ? !isValidPass
                ? "is-invalid"
                : "is-valid"
              : ""
              }`} name='pass'
              {...register("pass", {
                required: "El campo password es obligatorio",
                validate: value => {
                  if (value.length < 8) return "Debe tener al menos 8 Caracteres"
                  if (!/[A-Z]/.test(value)) return "Debe tener una mayúscula"
                  if (!/[a-z]/.test(value)) return "Debe tener una minúscula"
                  if (!/[0-9]/.test(value)) return "Debe tener al menos un número"
                  if (!/[-@$!%*?&._]/.test(value)) return "Debe tener al menos un símbolo"
                  return true
                }
              })} />
            {!isValidPass && pass.length > 0 && (
              <ul className='list-unstyled mt-2' >
                <li className={validaciones.longitudMin ? "text-success" : "text-danger"} >
                  {validaciones.longitudMin ? "✔" : "✘"} Mínimo 8 caracteres
                </li>
                <li className={validaciones.mayuscula ? "text-success" : "text-danger"} >
                  {validaciones.mayuscula ? "✔" : "✘"} Debe tener una mayúscula
                </li>
                <li className={validaciones.minuscula ? "text-success" : "text-danger"} >
                  {validaciones.minuscula ? "✔" : "✘"} Debe tener una minúscula
                </li>
                <li className={validaciones.numero ? "text-success" : "text-danger"} >
                  {validaciones.numero ? "✔" : "✘"} Debe tener al menos un número
                </li>
                <li className={validaciones.simbolo ? "text-success" : "text-danger"} >
                  {validaciones.simbolo ? "✔" : "✘"} Debe tener al menos un símbolo
                </li>
              </ul>
            )}
          </div>

          <div className='mb-3'>
            <label className='form-label' >Confirmar Contraseña: </label>
            <input type="password" placeholder='Ingrese su password nuevamente' className={`form-control ${passConfirm.length > 0
              ? !isValidPassConfirm
                ? "is-invalid"
                : "is-valid"
              : ""
              }`} name='passConfirm'
              {...register("passConfirm", {
                required: "El campo password confirm es obligatorio",
                validate: value => {
                  if (value !== pass) return "Las contraseñas no coinciden"
                  return true
                }
              })} />
            {!isValidPassConfirm && passConfirm.length > 0 && (
              <ul className='list-unstyled mt-2' >
                <li className={validacionConfirm.igual ? "text-success" : "text-danger"} >
                  {validacionConfirm.igual ? "✔" : "✘"} Las contraseñas deben ser iguales
                </li>
              </ul>
            )}
          </div>
          <button type='submit' className={`btn btn-primary w-100 ${ isValid ? "" : "disabled" }`} >Registrar</button>
        </form>
      </div>
    </div>
  )
}

export default Register