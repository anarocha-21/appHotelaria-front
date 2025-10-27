export default function RoomCard(itemCard, index) {
    
       const {
        nome,
        numero,
        qtd_cama_casal,
        qtd_cama_solteiro,
        preco
    } = itemCard || {};

    const title = nome;

    const camas = [
        (qtd_cama_casal != null ? `${qtd_cama_casal} cama(s) de casal` : null),
        (qtd_cama_solteiro != null ? `${qtd_cama_solteiro} cama(s) de solteiro` : null),
    ].filter(Boolean).join(' - ');
    
    
    const card = document.createElement('div');
    card.className = 'card-container'; 
    card.innerHTML = `
    <div class="card" style="width: 18rem;">

        <!-- Carrossel Bootstrap -->
        <div id="carouselExampleIndicators-${index}" class="carousel slide">
        
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner shadow">

                <div class="carousel-item active">
                    <img src="public/assets/images/hotel-hall.jpg" class="d-block w-100 card-img-top" alt="Quarto 1">
                </div>

                <div class="carousel-item">
                    <img src="public/assets/images/hotel-quarto.jpg" class="d-block w-100 card-img-top" alt="Quarto 2">
                </div>

                <div class="carousel-item">
                    <img src="public/assets/images/hotel-expo.jpg" class="d-block w-100 card-img-top" alt="Quarto 3">
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
            <div class="card-body">
            <h5 class="card-title">${title}</h5>
            <p class="card-text">Descrição do quarto: Lorem ipsum dolor sit amet consectetur
             adipisicing elit. Officia, harum libero, ratione, nostrum iusto dicta.</p>
             ${camas? `<li>${camas}` : ""}
             ${preco != null ? `<li>preco: R$ ${numero(preco).toFixed(2)}</li>` : ""}
            <a href="#" class="btn btn-primary btn-reservar">Reservar</a>
        </div>

    </div>`;

    card.querySelector(".btn-reservar").addEventListener('click', (e) => {
        e.preventDefault();
        //ler informações setadas nos inputs datecheckin, datecheckout e guestAmoust (ids)
        const idDateCheckin = document.getElementById("id-dateCheckin");
        const idDateCheckout = document.getElementById("id-dateCheckout");
        const idGuestAmount = document.getElementById("id-guestAmount");
    
        const chegada = (idDateCheckin?.value || "");
        const saida = (idDateCheckout?.value || "");
        const qtd = parseInt|(idGuestAmount?.value || "0", 10);

        if (!chegada || !saida || Number.isNaN(qtd) || qtd <= 0) {
            console.log("preencha todos os campos");
            return;
        }
        const daily = calculoDiaria(chegada, saida);
    
    });

    console.log(calculoDiaria());
    return card;
}