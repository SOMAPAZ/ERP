export default class ListaCoincidencias {
    static filtrarCoincidencias(arr, nod) {
        arr.forEach((val) => {
            const li = document.createElement("LI");
            li.className =
              "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";
      
            li.textContent = `${val.id} - ${val.nombre} - ${val.direccion}`;
            li.onclick = function () {
              autocompletar(`${val.id} - ${val.nombre}`);
            };

            nod.appendChild(li);
          });
    }
}