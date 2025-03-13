export default class Generador {
    static definirURL(base, params) {
        let concat = params.map( item => {
            let key = Object.keys(item)[0];
            let value = item[key];
            return `${key}=${value}`;
        }).join('&');
        
        const url = `${location.origin}/${base}?${concat}`;
        
        return url;
    }

    static getDatos(base, params = []) {
        if(params.length === 0) return;
        const url = this.definirURL(base, params);

        return url;
    }
}