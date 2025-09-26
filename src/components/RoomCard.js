export default function RoomCard(index) {
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
            <h5 class="card-title titulo">Suíte Luxo</h5>
                <p class="card-text">Desfrute do conforto da nossa Suíte Luxo com todas as comodidades.</p>
            <a href="#" class="btn btn-primary">Reservar</a>
        </div>

    </div>`;

return card;
}