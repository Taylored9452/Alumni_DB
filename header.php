<style>
  .carousel-control-next-icon {
    filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
  }
  .carousel-control-prev-icon {
    filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
  }
  .carousel-control-prev:hover,
  .carousel-control-next:hover {
    background-color: #f2f2f2; 
  }
</style>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="png-web/fix1.png" class="d-block mx-auto w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="png-web/fix2.jpeg" class="d-block mx-auto w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="png-web/fix3.jpg" class="d-block mx-auto w-50" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
