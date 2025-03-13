import Alerta from "./Alerta_v1.js";

export default class Validar {
    static #objData = {};

    static crearObjeto(args) {
        args.forEach((arg) => {
            this.#objData[arg.name] = arg.value;
        });

        return this.#objData;
    }

    static validarInputs(args) {
        const objValues = this.crearObjeto(args);

        if(Object.values(objValues).some(value => value.trim() === '')) {
            new Alerta({
                msg: "Todos los campos son obligatorios",
                position: document.querySelector("#div-notif"),
            });

            return false;
        }

        return objValues;
    }
}