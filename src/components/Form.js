
export default function Form() {
    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';
    divRoot.style.alignItems = "center";

    const container = document.createElement('div');
    container.className = 'card p-4 shadow-lg';
    container.style.width = '100%';
    container.style.maxWidth = '400px';
    divRoot.appendChild(container);

    const titulo = document.createElement('h1');
    titulo.textContent = "Faça seu login";
    titulo.className = 'titulo';

    const formulario = document.createElement('form');
    formulario.className = 'd-flex flex-column';

    const email = document.createElement('input');
    email.type = 'email';
    email.placeholder = "Digite seu email";
    formulario.appendChild(email);

    const senha = document.createElement('input');
    senha.type = 'password';
    senha.placeholder = 'Digite sua senha';
    senha.name = 'password';
    formulario.appendChild(senha);

    const botao = document.createElement('button');
    botao.type = 'submit';
    botao.textContent = 'Entrar';
    botao.className = 'btn btn-primary';
    formulario.appendChild(botao);

    container.appendChild(titulo);
    container.appendChild(formulario);

    return divRoot;
}
