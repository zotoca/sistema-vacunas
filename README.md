# sistema-vacunas
Sistema de vacunas  
## Rutas AJAX disponibles  
### Vacunas:  
#### Crear vacuna  
Ruta:/vacunas  
Metodo:POST  
Datos requeridos:name,requerido y debe de ser string  
Retorno:["message":"ok"]  
#### Editar vacuna  
Ruta:/vacunas/{vaccination_id}  
Metodo:PUT  
Datos requeridos:name,debe de ser string  
Retorno:["message":"ok"]  
#### Eliminar vacuna  
Ruta:/vacunas/{vaccination_id}  
Metodo:DELETE  
Retorno:["message":"ok"]  
### Calles:  
#### Crear calles  
Ruta:/calles  
Metodo:POST  
Datos requeridos:name,requerido y debe de ser string  
Retorno:["message":"ok"]  
#### Editar calles  
Ruta:/calles/{street_id}  
Metodo:PUT  
Datos requeridos:name,debe de ser string  
Retorno:["message":"ok"]  
#### Eliminar calles  
Ruta:/calles/{street_id}  
Metodo:DELETE  
Retorno:["message":"ok"]  
### Casas:  
#### Crear casas  
Ruta:/casas  
Metodo:POST  
Datos requeridos:number,requerido y debe de ser string, street_id, requerido y debe de ser el id de una calle  
Retorno:["message":"ok"]  
#### Editar casas  
Ruta:/casas/{house_id}  
Metodo:PUT  
Datos requeridos:number,debe de ser un numero  
Retorno:["message":"ok"]  
#### Eliminar casas  
Ruta:/casas/{house_id}  
Metodo:DELETE  
Retorno:["message":"ok"]  
### Personas:  
#### Vista de crear persona  
Ruta:/personas/crear  
Metodo:GET  
#### Vista de editar persona  
Ruta:/personas/editar/{person_id}  
Metodo:GET  
#### Crear persona  
Ruta:/personas  
Metodo:POST  
Datos requeridos:first_name: requerido y string, last_name:requerido y string, dni:requerido y string, gender: requerido y entre (masculino,femenino),
image:imagen de tipo "jpeg,jpg,png,gif,bmp,svg,webp",birthday:requerido y fecha, phone_number: requerido y alfanumerico, father_dni:debe de ser el dni de una persona existente, mother_dni:debe de ser el dni de una persona existente, house_id:requerido y debe de ser el id de una casa existente  
Retorno:["message":"ok"]  
#### Eliminar persona  
Ruta:/persona/{person_id}  
Metodo:DELETE  
Retorno:["message":"ok"]  
### API Personas:  
### Verificar cedula  
Ruta:/api/personas/verificar-cedula  
Metodo:POST  
Datos requeridos: dni: requerido y numerico.  
Retorno:["isValid":true]  
### Calle de una persona  
Ruta:/api/personas/{person_id}/calles  
Metodo:GET    
Retorno:[["id","name","created_at","updated_at"]]  
### Casa de una persona  
Ruta:/api/personas/{person_id}/casas  
Metodo:GET  
Retorno:[["id","number","created_at","updated_at"]]  
#### Editar persona  
Ruta:/api/personas/{person_id}  
Metodo:PUT  
Datos requeridos:first_name:string, last_name:string, dni:string, gender: entre (masculino,femenino),image:imagen de tipo "jpeg,jpg,png,gif,bmp,svg,webp",birthday: y fecha, phone_number: alfanumerico, father_dni:debe de ser el dni de una persona existente, mother_dni:debe de ser el dni de una persona existente, house_id: debe de ser el id de una casa existente  
Retorno:["message":"ok"]  
### Api Vacunas de personas:  
### Crear vacuna de una persona  
Ruta:/api/vacunas-personas  
Metodo:POST  
Datos requeridos: vaccination_id:requerido y existente en vacunas, person_id:requerido y existente en personas, vaccination_date:requerido y fecha, lot_number:string, dose:string  
Retorno:[["id","vaccination_id","person_id","vaccination_id","lot_number","dose"]]  
### Crear vacuna de una persona  
Ruta:/api/vacunas-personas/{person_vaccination_id}  
Metodo:PUT  
Datos requeridos: vaccination_id:existente en vacunas, vaccination_date:fecha, lot_number:string, dose:string  
Retorno:[["id","vaccination_id","person_id","vaccination_id","lot_number","dose"]]  
### Eliminar vacuna de una persona  
Ruta:/api/vacunas-personas/{person_vaccination_id}  
Metodo:DELETE  
Retorno:["message":"ok"]  