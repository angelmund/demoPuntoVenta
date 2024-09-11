export default function ({ $axios }, inject) {
    // Creamos el paquete axios y creamos una instancia
    const api = $axios.create({
      headers: {
        common: {
          Accept: 'text/plain, */*'
        }
      }
    })
  
    // Utilizamos una url por defecto
    api.setBaseURL('http://127.0.0.1:8000/api/') //es la api de laravel 
  
    // Inject to context as $api
    inject('api', api)
  }