import Navbar from "../components/Navbar.js";
import { clearHotel_Cart, getTotalItems } from "../store/cartStore.js";
//Importar componente Footer

export default function renderCartPage() {
    //Navbar
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    const navbar = Navbar();
    nav.appendChild(navbar);

    //Root (corpo da página)
    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';


    const reservas = getCart();
    console.log(reservas);

    const total = getTotalItems();
    console.log(total);

    const container = document.createElement('div');
    container.className = "container my-4";

    const header = document.createElement('div');
    header.className = "d-flex align-items-center justify-content-between mb-3";

    header.innerHTML = 
    `
        <h3 class="mb-0>Reservas</h3>
        <div>
            <button id="btnClear" class="btn btn_outline-danger btn-sm">esvaziar carrinho</button>
        </div>
    `

    //tabela
    const table = document.createElement('div');
    if (reservas.length === 0){
    table.innerHTML = '<div class="alert alert-info">carrinho vazio.</div>'
    }
    else{
        table;innerHTML = 
        `
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-seconday">
                        <tr>
                            <th>nome do quarto</th>
                            <th>data de checkin</th>
                            <th>date de checkout</th>
                            <th>subtotal</th>

                        </tr>
                    </thead>
                    <tbody>
                        ${reservas.map(item => 
                            `   
                            <tr>
                                <td>${item.nome}</td>
                                <td>${item.checkin}</td>
                                <td>${item.checkout}</td>
                                <td>${item.subtotal}</td>
                            </tr>
                            `).join("")}
                    </tbody>
                    <tfoot>
                            <tr>
                                <th></th>
                                <th>
                                    <h3 style="font-size:19px;">total: R$ ${total}</h3>
                                </th>
                                <th>
                                <button id="btnFinalizar" class="btn btn_outline-danger btn-sm">finalizar compra</button>
                                </th>
                            </tr>
                    </tfoot>
                </table>
            </div>
        `
    }

    container.appendChild(header);
    container.appendChild(table);
    divRoot.appendChild(container);
    

    const btnClear = document.getElementById("btnClear");
    if(btnClear){
        btnClear.addEventListener("click", () => {
            clearHotel_Cart();
            renderCartPage();
        })
    }
    


}