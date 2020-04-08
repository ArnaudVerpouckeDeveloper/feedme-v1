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
          aan waarop gerechten besteld kunnen worden.
        </p>
        <p class="landing-content-ps">- Gebouwd door studenten, voor zelfstandigen.</p>
        <div class="landing-cta">
          <v-btn large color="green" class="landing-cta-customer">ETEN BESTELLEN</v-btn>
          <span class="landing-cta-divider">of</span>
          <v-btn large color="white" class="landing-cta-horeca">IK WIL MIJN ZAAK REGISTREREN</v-btn>
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
      return "to top right, rgba(99, 162, 91, 0.33), rgba(4, 9, 0, 0.84)";
    }
  }
};
</script>
<style>
.landing {
  height: 100%;
  overflow: hidden;
}
.landing .v-responsive__content {
  align-self: center;
}
.landing-illustration {
  height: 81vh;
  background-image: linear-gradient(
    to top right,
    rgba(100, 115, 201, 0.33),
    rgba(25, 32, 72, 0.7)
  );
}
.landing-content {
  display: flex;
  justify-content: center;
  flex-direction: column;
  height: 23em;
  margin: 0 auto;
  font-size: 1.6em;
  background: #fff;
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
  font-size: 0.8em;
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
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 992px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (max-width: 768px) {
  .landing-content {
    height: 26em;
    padding: 1.5em !important;
  }
  .landing-cta-customer,
  .landing-cta-horeca {
    width: 100%;
  }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1300px) {
}
</style>