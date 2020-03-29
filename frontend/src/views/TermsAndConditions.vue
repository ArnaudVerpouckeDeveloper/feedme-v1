<template>
  <v-container fluid>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 lg6>
        <v-card class="elevation-0">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Algemene voorwaarden</v-toolbar-title>
          </v-toolbar>
          <v-card-text class="faq-card-text">
            <v-expansion-panels focusable hover multiple>
              <v-expansion-panel v-for="(c, i) in content" :key="i">
                <v-expansion-panel-header>{{c.title}}</v-expansion-panel-header>
                <v-expansion-panel-content>
                  <p v-for="text in c.messages">{{text}}</p>
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
    content: [
      {
        title: `Ondernemingsinformatie`,
        messages: [
          `Deze website is eigendom van SpeedMeal. Gemaakt door studenten ter ondersteuning van de horeca tijdens de coronacrisis. Wij zijn geen onderneming, maar een groep vrijwilligers.`
        ]
      },
      {
        title: `Algemene bepalingen`,
        messages: [
          `De elektronische webwinkel/bestelplatform van SpeedMeal, hierna genaamd als “de verkoper”, biedt haar klanten de mogelijkheid eten en drinken te bestellen/reserveren bij verschillende handelaars. Onderhavige Algemene Voorwaarden (“Voorwaarden”) zijn van toepassing op alle artikelen uit het assortiment en elke aankoop die de klant plaatst bij speedmeal.be`,
          `Elke bestelling geldt als aanvaarding door de Koper van onze algemene voorwaarden, die integraal deel uitmaken van de overeenkomst, met uitsluiting van alle andere algemene of bijzondere voorwaarden uitgaande van de Koper, behoudens uitdrukkelijk schriftelijk andersluidend beding.`,
          `SpeedMeal behoudt zich het recht om een bestelling te weigeren indien er zich bepaalde onregelmatigheden voordoen of bij verdenking van dubieuze bestellingen of kopers.`,
          `SpeedMeal behoudt zich het recht voor om op de website informatie aan te passen wanneer er zich fouten, acties tegen de voorwaarden of andere ongewenste acties voordoen.`
        ]
      },
      {
        title: `Prijs`,
        messages: [`De vermelde prijzen zijn onder verantwoordelijkheid van de horeca die ze vermeld heeft. De prijzen in hun juiste vorm zijn inclusief BTW en alle andere verplicht door de klant te dragen taksen. Indien vervoers-, reservatie- of administratieve kosten worden aangerekend, wordt dit apart door het bedrijf vermeld.`,
        `De opgave van prijs slaat uitsluitend op de artikelen zoals het woordelijk wordt omschreven in de productbeschrijving. Indien er een bijhorende foto aanwezig is, is deze uitsluitend decoratief bedoeld, deze kunnen elementen bevatten die niet inbegrepen zijn in de prijs.`,
        `Voor alle bestellingen worden de op de dag geldende prijzen op de website aangerekend.`,
        `Alle prijzen op de website zijn onder voorbehoud van druk- en zetfouten en SpeedMeal kan niet aansprakelijk gesteld worden voor eventuele druk- en zetfouten.`,
        `SpeedMeal behoudt zich het recht voor om op de website prijzen te wijzigen wanneer er zich prijswijzigingen voordoen.`,        
        ]
      },
      {
        title: `Aanbod`,
        messages: [`De artikelen zijn uitsluitend bestemd voor normaal particulier gebruik.`,
        `Ondanks het feit dat de catalogus en website met de grootst mogelijke zorgvuldigheid worden samengesteld, is het toch mogelijk dat de aangeboden informatie onvolledig is, of materiële fouten bevat, of niet up-to-date is. Wanneer u specifieke vragen heeft over bijvoorbeeld maten, kleur, beschikbaarheid, leveringstermijn, leveringswijze of andere zaken i.v.m. het bestelsysteem, verzoeken wij u om vooraf contact op te nemen met de horecazaak.`,
        `SpeedMeal is wat de juistheid, actualiteit, of volledigheid van de aangeboden informatie slechts gehouden tot een middelenverbintenis. SpeedMeal is in geen geval aansprakelijk ingeval van materiële fouten, zet- of drukfouten.`,
        `Het aanbod geldt steeds zolang de voorraad strekt en kan ten allen tijde worden aangepast of ingetrokken door SpeedMeal of de horecazaak.`,
        `SpeedMeal is gerechtigd om -zonder opgave van redenen- bestellingen te weigeren, de leveringstermijnen aan te passen, de leveringen te splitsen, dan wel andere voorwaarden te verbinden aan de levering.`,
        ]
      }
    ]
  })
};
</script>

<style>
</style>