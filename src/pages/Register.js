import { createRequest } from "../api/clienteApi.js";
import Form from "../components/Form.js";
import Navbar from "../components/Navbar.js";
 
export default function renderRegisterPage() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    const navbar = Navbar();
    nav.appendChild(navbar);
 
    const formulario = Form();
    const titulo = formulario.querySelector('h1');
    titulo.textContent = "Cadastre-se";
 
 
    //Seleciono o elemento form que está presente em ./components/Form.js
    const contentForm = formulario.querySelector('form');
 
    //Criar o input para nome e adicionar em contentForm
    const nome = document.createElement('input');
    nome.type = 'text';
    nome.placeholder = "Digite seu nome"; 
 
    const cpf = document.createElement('input');
    cpf.type = 'text';
    cpf.placeholder = "Digite seu CPF";
 
    const telefone = document.createElement('input');
    telefone.type = 'text';
    telefone.placeholder = "Digite seu telefone";
 
    /*Para adicionar input nome ao contentForm, localizo onde está input email pois
    quero necessariamente adicionar anteriormente a ele */
    const inputEmail = formulario.querySelector('input[type="email"]');
    contentForm.insertBefore(nome, inputEmail);
    contentForm.insertBefore(cpf, contentForm.children[1]);
    contentForm.insertBefore(telefone, contentForm.children[2]);
 
    //Criar o input para confirmar senha
    const confSenha = document.createElement('input');
    confSenha.type = 'password';
    confSenha.placeholder = "Confirme sua senha";
 
    /*Adicionar confSenha como "child" de form que já contém
        4 elementos: input nome[0] recém adicionado, input email[1],
        input password[2], button btn[3], ao adicionar confSenha antes de btn[3],
        portanto utilizar insertBefore() e identificar a posição de btn[3] como uma
        "child" do elemento pai form
    */
    contentForm.insertBefore(confSenha, contentForm.children[5]);
 
 
const btnRegister = formulario.querySelector('button');
btnRegister.textContent = "Criar conta";

    contentForm.addEventListener('submit', async(e)=> {
        e.preventDefault();
        const nome = inputNome.value.trim();
        const cpf = inputCPF.value.trim();
        const telefone = inputTelefone.value.trim();
        const email = inputEmail.value.trim();
        const senha = inputSemha.value.trim();

        try {
        const result = createRequest(nome, cpf, telefone, email, senha);
        }
        catch{
            console.log("erro inesperado");
        }

    })
 
}