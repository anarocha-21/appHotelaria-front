export default function FormRoom() {
 
    const inputNome = document.createElement('input');
    inputNome.type = 'text';
    inputNome.placeholder = "Digite o nome do quarto ";
 
    const inputNumero = document.createElement('input');
    inputNumero.type = 'text';
    inputNumero.placeholder = "Digite o número do quarto ";
 
    const inputCamaCasal = document.createElement('input');
    inputCamaCasal.type = 'number';
    inputCamaCasal.placeholder = "Digite a quantidade de cama(s) casal do quarto";
 
    const inputCamaSolt = document.createElement('input');
    inputCamaSolt.type = 'number';
    inputCamaSolt.placeholder = "Quantidade de cama(s) casal solteiro";
 
    const inputDisp = document.createElement('input');
    inputDisp.type = 'radio';
    inputDisp.placeholder = "O quarto está disponivel ?";
 
    const inputPreco = document.createElement('input');
    inputPreco.type = 'number';
    inputPreco.placeholder = "Digite o preço do quarto";
 
    const inputImg = document.createElement('input');
    inputImg.type = 'file';
    inputImg.placeholder = "Coloque a imagem do quarto";
 
}