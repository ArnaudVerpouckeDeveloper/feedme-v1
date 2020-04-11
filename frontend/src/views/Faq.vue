<template>
  <v-container fluid>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 lg6>
        <v-card class="elevation-0">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Veelgestelde vragen</v-toolbar-title>
          </v-toolbar>
          <v-card-text class="faq-card-text">
            <v-expansion-panels popout focusable hover>
              <v-expansion-panel>
                <v-expansion-panel-header>1. Worden er extra kosten aangerekend door deze website te gebruiken?</v-expansion-panel-header>
                <v-expansion-panel-content>
                  Neen, u betaalt enkel de prijs die door de horecazaak opgegeven wordt. Het gebruik van SpeedMeal is volledig
                  <strong>gratis</strong>.
                </v-expansion-panel-content>
              </v-expansion-panel>
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

                  <p><strong>Aandacht:</strong> SpeedMeal is geen tussenpersoon bij de betalingen. Betalingen gebeuren van de koper rechtstreeks naar de horecazaak.</p>
                </v-expansion-panel-content>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-header>10. Hoe kan ik mijn horecazaak bij Speedmeal aansluiten?</v-expansion-panel-header>
                <v-expansion-panel-content>
                  Om uw horecazaak aan te sluiten bij SpeedMeal dient u zich te
                  registreren als een horecazaak. Dit kan hier:
                  <router-link :to="{name:'merchantRegister'}">https://www.speedmeal.be/admin/registreren</router-link>
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
        q: "2.	Hoe plaats ik een bestelling?",
        a:
          "Om een bestelling te plaatsen, dient u eerst een account aan te maken. Met uw account kan u bestellingen plaatsen bij een horecazaak. "
      },
      {
        q: "3.	Kunnen bestellingen geleverd worden bij mij thuis?",
        a:
          "Dit kan, in het geval dat de horecazaak deze mogelijkheid aanbiedt. U kunt de afhaal- en levermethodes van de horecazaak bekijken op de SpeedMeal pagina van de betreffende horecazaak."
      },
      {
        q: "4.	Wat als mijn favoriete zaak staat er niet tussen staat?",
        a: `
          Elke dag sluiten nieuwe horecazaken zich aan bij SpeedMeal. Indien uw gewenste zaak er niet tussen staat, probeer dan op een later moment opnieuw te checken. 
          Indien u wilt kan u die zaak over SpeedMeal inlichten zodat zij zich ook registreren en van dit gratis platform gebruik kunnen maken. `
      },
      {
        q: "5.	Hoe kunnen we het initiatief 'SpeedMeal' steunen?",
        a:
          "U kan ons het beste steunen door deze website met uw kennissen, vrienden en horecazaken te delen. "
      },
      {
        q: "6.	Kunnen we dit platform ook na de coronacrisis blijven gebruiken?",
        a:
          'Voorlopig zijn we met het SpeedMeal team aan het kijken wat de mogelijkheden zijn om onze site "up and running" te houden na de coronacrisis.'
      },
      {
        q:
          "7.	Ik denk dat een zaak geïnteresseerd zou zijn om zich aan te sluiten, wat kan ik doen?",
        a: `Ten eerste bedankt om ons initiatief te willen steunen. In dit geval brengt u best de zaak op de hoogte van ons platform of u stuurt ons de gegevens van de betreffende zaak door via info@speedmeal.be en dan geven we de zaak een seintje. `
      },
      {
        q:
          "8.	Ik heb een bestelling geplaatst, maar ik wil deze annuleren. Wat is jullie annuleringsbeleid?",
        a: `Indien je de bestelling net geplaatst hebt, neemt u best zo snel mogelijk contact op met de desbetreffende zaak. De nodige contactgegevens zijn te vinden op de bestelpagina van de zaak en op de toegestuurde bevestigingsemail. De horecazaak heeft ten allen tijde het recht om de annulatie te weigeren, indien de bestelling al klaar zou staan.`
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