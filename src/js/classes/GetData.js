export default class GetDatos {
  static #resultado = [];

  static async consultar(url) {
    try {
      const response = await fetch(url);
      this.#resultado = await response.json();

      return this.#resultado;
    } catch (error) {
      console.error(error);
    }
  }
}
