<template>
  <div class="landing">
    <v-img
      class="landing-illustration v-row"
      src="/assets/images/landing.jpg"
      :gradient="overlayFilter"
    >
      <article class="landing-content col-11 col-sm-9 col-md-6 col-xl-4">
        <img class="landing-content-img" src="/assets/images/Logo_Green.png" alt="SpeedMeal logo" />
        <p class="landing-content-paragraph">
          Laat uw zelfstandige activiteiten niet
          ophouden door het coronavirus.
          SpeedMeal biedt u
          <strong>GRATIS</strong> een systeem
          aan waarmee gerechten besteld kunnen worden.
        </p>
        <p class="landing-content-ps">- Gebouwd door studenten, voor zelfstandigen. -</p>
        <div class="landing-cta">
          <v-btn
            :to="{name: 'Merchants'}"
            tile
            large
            color="green"
            class="landing-cta-customer"
          >ETEN BESTELLEN</v-btn>
          <span class="landing-cta-divider">of</span>
          <v-btn
            :to="{name: 'merchantRegister'}"
            tile
            large
            color="white"
            class="landing-cta-horeca"
          >IK WIL MIJN ZAAK REGISTREREN</v-btn>
        </div>
      </article>
    </v-img>
  </div>
</template>

<script>
export default {
  name: "Home",
  computed: {
    overlayFilter() {
      return "rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)";
    }
  }
};
</script>
<style>
.landing {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  overflow: hidden;
}
.landing .v-responsive__content {
  align-self: center;
}
.landing-illustration {
  height: 100%;
  background-image: linear-gradient(
    to top right,
    rgba(76, 175, 80, 0.29),
    rgba(76, 175, 80, 0.69)
  );
}
.landing-content {
  display: flex;
  justify-content: center;
  flex-direction: column;
  height: 23em;
  margin: 0 auto;
  font-size: 1.3em;
  background: rgba(255, 255, 255, 0.89);
  transition: all 0.2s ease;
  text-align: center;
  padding: 1em;
}

.landing-content-img {
  margin-bottom: 12px;
  color: #000;
  margin: 0 auto;
  max-width: 12em;
}

.landing-content-paragraph {
  max-width: 100%;
  padding-right: 5%;
  padding-left: 5%;
  color: #000;
}
.landing-content-ps {
  font-size: 0.6em;
}
.landing-cta {
  font-size: 0.8em;
  color: #5f5f5f;
  margin-top: 1.5em;
}

.landing-cta-customer {
  color: #fff !important;
}
.landing-cta-divider {
  display: block;
  margin: 0.8em 0;
}
.landing-cta-horeca {
  color: #000 !important;
}

@media only screen and (max-width: 234px) {
  .landing-content {
    font-size: 1em !important;
    height: 410px !important;
  }
  .landing-cta .landing-cta-horeca .v-btn__content {
    font-size: 0.8em !important;
  }
}

/* super Small devices (portrait tablets and large phones */
@media only screen and (max-width: 340px) {
  .landing-content {
    font-size: 1.2em;
    padding: 0.5em !important;
    height: 450px;
    margin-top: 10px;
    margin-bottom: 10px;
  }
  .landing-content-img {
    width: 180px !important;
  }
  .v-btn.v-size--large {
    font-size: 0.675rem !important;
  }
  .landing-cta {
    font-size: 0.8em;
    margin-top: 0.8em;
  }
}

@media only screen and (max-width: 400px) {
  .landing-content-img {
    width: 250px;
  }
}

@media only screen and (max-width: 599px) {
  .landing-content{
    height: 100% !important;
  }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (max-width: 768px) {
  .landing-illustration .landing-content {
    padding: 1em;
  }
  .landing-content {
    height: 21em;
  }
  .landing-content-paragraph {
    font-size: 0.8em;
  }
  .landing-cta-customer,
  .landing-cta-horeca {
    width: 100%;
  }
}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (max-width: 992px) {

}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .landing-cta-customer,
  .landing-cta-horeca {
    height: 3.5em !important;
  }
  .landing-cta-customer {
    width: 14em !important;
  }
}

</style>