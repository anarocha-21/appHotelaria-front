import Form from "../components/Form.js";
import Navbar from "../components/Navbar.js";
import {addRoom} from "../api/quartoApi.js";


export default function renderCadQuarto() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    const navbar = Navbar();
    nav.appendChild(navbar);

    const formulario = Form();
    const titulo = formulario.querySelector('h1');
    titulo.textContent = "cadastrar quarto";

    const contentForm = formulario.querySelector('form');
    contentForm.enctype = "multipart/form-data";


    const inputNome = contentForm.querySelector('input[type=email]');
    inputNome.type = 'text';
    inputNome.placeholder = "digite o nome do quarto";
    inputNome.name = 'nome';

    const inputNumero = contentForm.querySelector('input[type=password]');
    inputNumero.type = 'text';
    inputNumero.placeholder = "digite o numero do quarto";
    inputNumero.name = 'numero';
        

    const inputQtd_Casal = document.createElement('select');
    inputQtd_Casal.className = 'select-qtd';
    inputQtd_Casal.style.borderWidth = '0.15rem';
    inputQtd_Casal.innerHTML = 
    `
    <option value="">Quantidade camas casal</option>
    <option value="1">1 cama</option>
    <option value="2">2 camas</option>
    <option value="3">3 camas</option>
    <option value="4">4 camas</option>
    `
    qtdCamaCasal.name = 'qtd_cama_casal';

    const inputQtd_Solteiro = document.createElement('input');
    inputQtd_Solteiro.type = 'number';
    inputQtd_Solteiro.placeholder = 'quantidade de cama solteiro'
    inputQtd_Solteiro.min = 0;
    inputQtd_Solteiro.max = 3;
    inputQtd_Solteiro.name = "qtd_cama_solteiro";

    const inputPreco = document.createElement('input');
    inputPreco.type = 'number';
    inputPreco.placeholder = "Preço diária";
    inputPreco.step = "0.01";
    inputPreco.name = 'preco';

    const dispDiv = document.createElement('div');
    dispDiv.className = 'd-flex flex-row gap-2';

    const subtitulo = document.createElement('p');
    subtitulo.textContent = "Quarto disponível?:";

    const labelTrue = document.createElement('label');
    labelTrue.textContent = 'Sim';
    const inputDisptrue = document.createElement('input');
    inputDisptrue.type = 'radio';
    inputDisptrue.name= "disponivel";
    inputDisptrue.value = "1";

    const labelFalse = document.createElement('label');
    labelFalse.textContent = 'Não';
    const inputDispfalse = document.createElement('input');
    inputDispfalse.type = 'radio';
    inputDispfalse.name= "disponivel";
    inputDispfalse.value = "0";

    dispDiv.appendChild(subtitulo);
    dispDiv.appendChild(labelTrue);
    dispDiv.appendChild(inputDisptrue);
    dispDiv.appendChild(labelFalse);
    dispDiv.appendChild(inputDispfalse);

    const inputFotos = document.createElement('input');
    inputFotos.className = 'form-control';
    inputFotos.type = 'file';
    inputFotos.id = 'formFileMultple';
    inputFotos.multiple = true;
    inputFotos.accept = "image/*";
    inputFotos.name = 'fotos[]'

    contentForm.insertBefore(inputPreco, contentForm.children[2]);
    contentForm.insertBefore(inputQtd_Casal, contentForm.children[3]);
    contentForm.insertBefore(inputQtd_Solteiro, contentForm.children[4]);
    contentForm.insertBefore(dispDiv, contentForm.children[5]);
    contentForm.insertBefore(inputFotos, contentForm.children[6]);

    const btnRegisterRoom = contentForm.querySelector('button');
    btnRegisterRoom.textContent = 'Cadastrar';

    c
    contentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        try { 
            const response = await addRoom(contentForm);
            console.log("Resposta do servidor: ", response);
        }
        catch (error) {
            console.log("Erro ao enviar requisição: " + error.message);
        }
    });


    // divRoot.appendChild();
    //RODAPE
}