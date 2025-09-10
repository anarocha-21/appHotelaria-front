import Form from "../components/Form.js";
import Navbar from "../components/Navbar.js";

export default function renderRegisterPage() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';

    const navbar = Navbar();
    nav.appendChild(navbar);

    const formulario = Form();

    const titulo = formulario.querySelector('h1');
    titulo.textContent = 'Crie uma conta';

    const contentForm = formulario.querySelector('form');

    const nome = document.createElement('input');
    nome.className = 'input';
    nome.placeholder = "Digite seu nome";

    const email = formulario.querySelector('input[type="email"]');
    contentForm.insertBefore(nome, email);

    const confSenha = document.createElement('input');
    confSenha.type = 'password';
    confSenha.placeholder = "Confirme sua senha";

    contentForm.insertBefore(confSenha, contentForm.children[3]);

    const btnRegister = contentForm.querySelector('button');
    btnRegister.textContent = "Criar conta";

}