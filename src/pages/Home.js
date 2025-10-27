import { listAvailableRoomsRequest } from "../api/quartoApi.js";
import Hero from "../components/Hero.js";
import Navbar from "../components/Navbar.js";
import RoomCard from "../components/RoomCard.js";
import DateSelector from "../components/DateSelector.js";


export default function renderHomePage() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    const navbar = Navbar();
    nav.appendChild(navbar);

    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';

    const hero = Hero();
    divRoot.appendChild(hero);

    const dSelector = DateSelector();
    divRoot.appendChild(dSelector);

    /*criar constante que armazene o valor da data de hoje*/
    const dateToday = new Date().toISOString().split("T")[0];
    //console.log(dateToday);
    
    const [dateCheckIn, dateCheckOut] = dSelector.querySelectorAll('input[type="date"]');
    
    dateCheckIn.min = dateToday;
    dateCheckOut.min = dateToday;

    const guestAmount = dSelector.querySelector('select');

    dateCheckIn.id = 'id-dateCheckin';
    dateCheckOut.id = 'id-dateCheckout';
    guestAmount.id = 'id-guestAmount';

    const btnSearchRoom = dSelector.querySelector('button');

    //Grupo para incorporar cada div de cada card, para aplicar display-flex
    const cardsGroup = document.createElement('div');
    cardsGroup.className = "cards";
    cardsGroup.id = "cards-result";

    btnSearchRoom.addEventListener("click", async(e) => {
        e.preventDefault();

        const chegada = (dateCheckIn?.value || "").trim();
        const saida = (dateCheckOut?.value || "").trim();
        const capacidade = parseInt(guestAmount?.value || "0", 10);
    
        if (!chegada || !saida || Number.isNaN(capacidade) || capacidade<= 0) {
            console.log("Preencha todos os campos!");
            /* Tarefa 1: Renderizar nesse if() posteriormente um modal do bootstrap!
            https://getbootstrap.com/docs/5.3/components/modal/ */
            return;
        }
 /*OBS.: falta impedir que o usuário pesquise por uma data passada!*/
    const dtInicio = new Date(chegada);
    const dtFim = new Date(saida);

    if (isNaN(dtInicio) || isNaN(dtFim) || dtInicio >= dtFim) {
        console.log("A data de check-out deve ser posterior ao check-in!");
        /* Tarefa 2: Renderizar nesse if() posteriormente um modal do bootstrap!
        https://getbootstrap.com/docs/5.3/components/modal/ */
        return;
    }

    console.log("Buscando quartos disponíveis...");
    /* Tarefa 3: Renderizar na tela um símbolo de loading (spinner do bootstrap)!
    https://getbootstrap.com/docs/5.3/components/spinners/ */

    try {
        const result = listAvailableRoomsRequest({chegada, saida, capacidade });
        if (!result.length) {
            console.log("Nenhum quarto disponível para esse período!");
            /* Tarefa 4: Renderizar nesse if() posteriormente um modal do bootstrap!
            https://getbootstrap.com/docs/5.3/components/modal/ */
            return;
        }
        cardsGroup.innerHTML = '';
        result.forEach((itemCard, i) => {
            cardsGroup.appendChild(RoomCard(itemCard, i));
        });
    } 
    catch(error) {
        console.log(error);
    }


    });

    divRoot.appendChild(cardsGroup);


}
   
