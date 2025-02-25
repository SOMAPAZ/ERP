import Validar from "./Validar.js";

export default class PostDatos {
    static async guardarDatos(url, args) {
        const data = PostDatos.crearFormData(args);

        if(data === false) return null;
        
        try {     
            const response = await fetch(url, {
                method: "POST",
                body: data,
            });
    
            const result = await response.json();
            return result;
        } catch (error) {
            console.error(error);
        }
    }

    static crearFormData(inputs) {
        const objValues = Validar.validarInputs(inputs);

        if(objValues === false) {
            return false;
        } else {
            const data = new FormData();
    
            for (const [key, value] of Object.entries(objValues)) {
                data.append(key, value);
            }

            return data;
        }
        
    }

    static async actualizarDato(url, idx) {
        const data = new FormData();
        data.append("id", idx);
        
        try {     
            const response = await fetch(url, {
                method: "POST",
                body: data,
            });
    
            const result = await response.json();
            return result;
        } catch (error) {
            console.error(error);
        }
    }
    
    static async eliminarDatos(url, idx) {
        const data = new FormData();
        data.append("id", idx);
        
        try {     
            const response = await fetch(url, {
                method: "POST",
                body: data,
            });
    
            const result = await response.json();
            return result;
        } catch (error) {
            console.error(error);
        }
    }

    static async enviarArray(url, args) {
        const data = new FormData();
        data.append('args', args)

        try {     
            const response = await fetch(url, {
                method: "POST",
                body: data,
            });
    
            const result = await response.json();
            return result;
        } catch (error) {
            console.error(error);
        }
    }
}