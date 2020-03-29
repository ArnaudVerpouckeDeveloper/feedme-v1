<template>
  <v-container fluid>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 lg6>
        <v-card class="elevation-0">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Veelgesteld vragen</v-toolbar-title>
          </v-toolbar>
          <v-card-text class="faq-card-text">
            <v-expansion-panels popout focusable hover>
              <v-expansion-panel v-for="(faq, i) in faqs" :key="i">
                <v-expansion-panel-header>{{faq.q}}</v-expansion-panel-header>
                <v-expansion-panel-content>{{faq.a}}</v-expansion-panel-content>
              </v-expansion-panel>
              
              <v-expansion-panel>
                <v-expansion-panel-header>4. Wat zijn de betaalmogelijkheden?</v-expansion-panel-header>
                <v-expansion-panel-content>
                  De betaalmogelijkheden hangen af van de gebruikte systemen van de horecazaak waarbij u bestelt.
                  <br/>
                  <br/>

                  <p>*Aandacht: SpeedMeal is geen tussenpersoon bij de betalingen. Betalingen gebeuren van de koper rechtstreeks naar de horecazaak.</p>
                </v-expansion-panel-content>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-header>5. Hoe kan ik mijn horecazaak bij Speedmeal aansluiten?</v-expansion-panel-header>
                <v-expansion-panel-content>
                  Om uw horecazaak aan te sluiten bij SpeedMeal dient u zich te
                  registreren als horecazaak. Dit kan hier:
                  <router-link :to="{name:'register'}">https://www.speedmeal.be/register</router-link>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    faqs: [
      {
        q:
          "1.	Worden er extra kosten aangerekend aan mijn bestelling om deze website te gebruiken?",
        a:
          "Neen, u betaalt enkel de prijs die door de horecazaak opgegeven wordt. Het gebruik van SpeedMeal is volledig gratis."
      },
      {
        q: "2.	Hoe plaats ik een bestelling?",
        a:
          "Om een bestelling te plaatsen dient u eerst een account aan te maken. Met uw account kan u bestellingen plaatsen bij een horecazaak. "
      },
      {
        q: "3.	Kunnen bestellingen geleverd worden bij mij thuis?",
        a:
          "Dit kan, in het geval dat de horecazaak deze mogelijkheid aanbiedt. U kunt de afhaal- en levermethodes van de horecazaak bekijken op de SpeedMeal pagina van de betreffende horecazaak."
      }
    ]
  })
};
</script>

<style>
.faq-card-text {
  padding: 15px 0;
}

.v-expansion-panel-content__wrap {
  padding: 12px 24px 16px !important;
}
</style>