<template>
  <div>
    <div class="landing">
      <article>
        <h1>SpeedMeal</h1>
        <p>
          Laat uw zelfstandige activiteiten niet
          ophouden door het coronavirus.
          SpeedMeal biedt u
          <strong>GRATIS</strong> een systeem
          aan waarop gerechten besteld kunnen worden.
        </p>
        <p>- Gebouwd door studenten, voor zelfstandigen.</p>
      </article>
    </div>
    <Contact id="contact" />
  </div>
</template>

<script>
import Contact from "../components/Contact.vue";
import HelloWorld from "../components/HelloWorld.vue";
export default {
  name: "Home",

  components: {
    Contact,
    HelloWorld
  }
};
</script>
<style scoped>
article {
  font-size: 1.6em;
  position: relative;
  transition: all 0.2s ease;
  padding: 15px 0;
}
div {
  color: #fff;
}
.landing {
  width: 100vw;
  height: 50%;
  background: #4caf50;
  transition: all 0.2s ease;
}
h1 {
  font-size: 2em;
  margin-bottom: 10px;
  text-align: center;
}

p {
  max-width: 100%;
  padding-right: 5%;
  padding-left: 5%;
  text-align: center;
}


/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  article {
    top: 50%;
    transform: translateY(-50%);
    padding:0;
  }
  .landing {
    width: 50vw;
    height: 40em;
  }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .landing {
    width: 100vw;
    clip-path: polygon(0 0, 60% 0, 33% 100%, 0 100%);
  }
  h1 {
    text-align: unset;
    padding-left: 5%;
  }
  article {
    padding-top: 3%;
    font-size: 1.6em;
    position: unset;
    top: unset;
    transform: unset;
  }
  p {
    max-width: 40%;
    padding-right: 5%;
    padding-left: 5%;
    text-align: left;
  }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1300px) {
  .landing {
    clip-path: polygon(0 0, 55% 0, 28% 100%, 0 100%);
  }
}
</style>