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
                <v-expansion-panel-header>9. Wat zijn de betaalmogelijkheden?</v-expansion-panel-header>
                <v-expansion-panel-content>
                  De betaalmogelijkheden hangen af van de gebruikte systemen van de horecazaak waarbij u bestelt.
                  <br />
                  <br />

                  <p>*Aandacht: SpeedMeal is geen tussenpersoon bij de betalingen. Betalingen gebeuren van de koper rechtstreeks naar de horecazaak.</p>
                </v-expansion-panel-content>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-header>10. Hoe kan ik mijn horecazaak bij Speedmeal aansluiten?</v-expansion-panel-header>
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
      },
      {
        q: "4.	Hoe kunnen we jullie initiatief steunen?",
        a:
          "Beste steun voor ons zou zijn, het delen van deze website met jullie kennissen, vrienden en gekende horecazaken. "
      },
      {
        q: "5.	Kunnen we dit platform blijven gebruiken, na coronacrisis?",
        a:
          'We zijn met ons team voorlopig aan het brainstormen om te zien wat we dan kunnen doen om onze site "up and running" te houden'
      },
      {
        q: "6.	Mijn favoriete zaak staat niet tussen, wat dan?",
        a: `
          Elke dag komen er nieuwere en nieuwere horecazaken bij. Indien uw gewenste zaak er niet tussen staat, probeert u eens een andere keer nog eens te checken. 
          ls u wilt kunt u die zaak over ons laten weten zodat ze zich ook registreren en van ons gratis platform kunnen profiteren. `
      },
      {
        q:
          "7.	Ik denk dat een zaak geïnteresseerd zou zijn om aan te sluiten, wat kan ik doen?",
        a: `Ten eerste bedankt om ons initiatief te willen steunen. In dit geval kunt u de zaak op de hoogte brengen over ons platform ofwel stuurt u ons de gegevens van de zaak door op info@speedmeal.be en we bekijken het verder. `
      },
      {
        q:
          "8.	Ik heb een bestelling geplaatst, maar ik moet dat toch niet hebben. Wat is jullie annuleringsbeleid?",
        a: `Indien je je bestelling net geplaatst hebt, is het geen enkel probleem om deze te annuleren. De nodige contactgegevens zijn te vinden bij het bestelformulier. De horecazaak heeft altijd het recht om de annulatie te weigeren, indien je bestelling al klaar staat.`
      },
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