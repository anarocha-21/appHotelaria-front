import Hero from "../components/Hero.js";
import Navbar from "../components/Navbar.js";
import Footer from "../components/Footer.js";
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

    const pezin = document.getElementById('footer');
    pezin.innerHTML = '';

    const footer = Footer();
    pezin.appendChild(footer);

    const dSelector = DateSelector();
    divRoot.appendChild(dSelector);

    const groupCards = document.createElement('div');
    groupCards.className = 'groupCards';

    for (var i=0; i < 3;i++){
        const card = RoomCard(i);
        groupCards.appendChild(card);
    }

    divRoot.appendChild(groupCards);
}
   
