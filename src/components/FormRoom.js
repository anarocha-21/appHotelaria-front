import { createElement } from "react";
 
export default function InfoRooms(){
    const infoQuarto = createElement ('div');
    infoQuarto.innerHTML =
    `
    <div class="mb-3">
    <label for="formFileMultiple" class="form-label">Multiple files input example</label>
    <input class="form-control" type="file" id="formFileMultiple" multiple>
    </div>
    `
    return infoQuarto;
}