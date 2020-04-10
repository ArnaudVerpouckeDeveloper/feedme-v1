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
      },
      {
        title: `Online aankopen & betaling`,
        messages: [`Bestellingen worden pas klaargemaakt voor verzending wanneer het volledige aankoopbedrag + verzendkosten op onze rekening staat, tenzij anders afgesproken met de horecazaak.`,
        `Volledige verantwoordelijkheid van betalingen en aankopen ligt bij de koper en de horecazaak.`,
        `SpeedMeal is enkel een vrijwillige tussenpartij bij de kopers en de horecazaken. SpeedMeal kan in geen geval aansprakelijk worden gesteld voor problemen, fouten, discussies van de klanten noch van de horecazaken.`
        ]
      },
      {
        title: `Levering`,
        messages: [`Levering vindt plaats zolang de voorraad strekt.`,
        `Producten worden enkel geleverd op locaties waarvoor de website de levering toestaat en waarvoor de horecazaak akkoord gaat.`,
        `De verzendtijden behoren allemaal onder de verantwoordelijkheid van de horecazaken, de vermeldde tijden gelden als een indicatie en niet als fatale termijn. Overschrijding van enige leveringstermijn geeft de “koper” geen enkel recht op schadevergoeding of dergelijke.`,
        `Normaalgezien zijn alle producten vermeld op de website op voorraad, tenzij anders aangegeven.`,
        `Mocht er door overmacht of andere omstandigheden abnormale vertraging zijn, hetzij bij onszelf, bij onze leveranciers of door stakingen zullen de horecazaken u op de hoogte brengen, samen met concrete informatie over de betreffende levertijd.`,
        `Vermelde levertijden bij sommige producten zijn enkel een indicatie wanneer het betreffende product opnieuw verwacht wordt.`,
        `Wij staan niet in en zijn niet verantwoordelijk voor vertragingen van onze leveranciers of transportfirma’s.`,
        `In het geval van problemen wordt verwacht dat de horecazaak ze zo snel mogelijk met de koper communiceert in een duidelijke en aanvaardbare taal.`,
        `SpeedMeal is niet aansprakelijk voor schade van welke aard ook door onjuiste en/of onvolledige gegevens verstrekt door de “koper” of horecazaak. Foutieve leveringsadressen zijn de verantwoordelijkheid van de “koper” en kunnen aanleiding geven tot extra kosten die ten laste zullen zijn van de “koper” tenzij anders afgesproken met de horecazaak. De risico’s van het transport zijn voor de horecazaak en gaan over op de koper op het moment dat de bestelling namens de koper in ontvangst genomen wordt.`
        ]
      },
      {
        title: `Beschadigde of verloren zendingen`,
        messages: [`Defecte of beschadigde goederen door levering.`,
        `Indien de door u bestelde producten in defecte of beschadigde staat door de levering bij u toekomen dient u zo snel mogelijk de horecazaak op de hoogte te brengen via hun contactgegevens. Uiterlijke datum is afhankelijk van de horecazaak zelf.`,
        `Bij reeds zichtbare schade bij levering, onmiddellijk in het bijzijn van de bezorger de inhoud controleren. Indien iets beschadigd is aan het product raden we u aan om zo snel mogelijk contact op te nemen met horecazaak en hen te vragen naar een oplossing.`
        ]
      },
      {
        title: `Klachten`,
        messages: [`Voor klachten in verband met de levering, kwaliteit, hoedanigheid van het product of iedere andere klacht moet u de horecazaak zelf contacteren. SpeedMeal is in geen geval verantwoordelijk om klachten op te lossen en/of te behandelen van deze klachten.`
        ]
      },
      {
        title: `Tevredenheid en tips`,
        messages: [`Iedere klant is even belangrijk en daarom stellen wij alles in het werk om het bestelproces zo uitstekend mogelijk te laten verlopen. Indien u niet tevreden bent of u heeft een klacht over de werking van ons product (SpeedMeal.be), stuur ons dan een mail. Afhankelijk van de prioriteit proberen wij dan zo spoedig mogelijk het nodige te doen om uw klacht te behandelen. U kan ons steeds mailen voor aanbevelingen, tips, verbeteringsvoorstellen of mogelijke samenwerkingen. Een goede ervaring met ons product vinden wij belangrijk!`
        ]
      },
      {
        title: `Overmacht`,
        messages: [`SpeedMeal heeft ingeval van overmacht het recht om, naar eigen keuze, de uitvoering van een bestelling op te schorten, dan wel de overeenkomst zonder rechterlijke tussenkomst te ontbinden. SpeedMeal zal proberen om de “koper” hiervan op de hoogte brengen zonder dat SpeedMeal gehouden is tot enige schadevergoeding. SpeedMeal is gerechtigd om ten alle tijde de samenwerking met een horecazaak stil te zetten zonder opgave van redenen.`,
        `Gevallen van overmacht kunnen zijn: staking, uitsluiting, oorlog, brand, waterschade, diefstal, inbraak, revolutie, mobilisatie, epidemieën, in gebreke blijven van leveranciers, productie onderbrekingen, collectieve arbeidsgeschillen, ziekte, overlijden, weersomstandigheden, productie problemen of andere soortgelijke omstandigheden.`,
        `SpeedMeal kan in geen enkel geval aansprakelijk gesteld worden voor het niet kunnen uitleveren van geplaatste bestellingen bij overmacht.`
        ]
      },
      {
        title: `Communicatie`,
        messages: [`SpeedMeal is op geen enkele manier aansprakelijk voor misverstanden, beschadigingen, vertragingen of een onduidelijke overeenkomst van bestellingen en mededelingen ten gevolge van het gebruik van internet of enig ander communicatiemiddel in het verkeer tussen de “koper” en de horecazaak, dan ook tussen SpeedMeal en derden, voor zover betrekking hebbend op de relatie tussen de “koper” en SpeedMeal of relatie tussen de horecazaak en SpeedMeal.`
        ]
      },
      {
        title: `Privacy`,
        messages: [`Wanneer u een bestelling plaatst bij SpeedMeal, of uw horecazaak koppelt aan ons systeem, dan worden uw gegevens opgenomen in de databank van SpeedMeal.`,
        `De verwerking van uw gegevens zal geschieden in overeenstemming met de toepasselijke wet- en regelgeving.`,
        `SpeedMeal zal nooit uw gegevens doorgeven of verkopen aan derden. SpeedMeal respecteert de privacy van alle gebruikers van haar site en draagt er zorg voor dat de persoonlijke informatie die u ons verschaft vertrouwelijk wordt behandelt. De gegevens die wij van u nodig hebben zijn enkel om uw aankoop en verwerking van een door u gekozen dienst correct  te laten verlopen en dat wij indien nodig contact met u kunnen opnemen. Deze gegevens blijven altijd intern en worden voor geen andere doeleinden gebruikt. Klantgegevens worden enkel met de zaak waarbij diensten/producten zijn besteld gedeeld. Dit gebeurt ook enkel om uw bestelling correct te laten verlopen.`,
        `Wanneer u zich inschrijft op onze nieuwsbrief blijven uw gegevens intern en vertrouwelijk en zullen wij uw gegevens enkel gebruiken voor onze nieuwsbrief, promo-aanbiedingen en speciale acties. Indien u geen nieuwsbrieven meer wenst te ontvangen dan kan u zich ten alle tijde laten uitschrijven. Indien deze optie niet voor de hand ligt kunt u contact met ons opnemen en dan zullen wij zorgen dat u geen nieuwsbrieven meer zult ontvangen.`,
        `Indien u uw account wil laten verwijderen, stuur ons dan een mail met een duidelijk onderwerp samen met uw gegevens en wij verwijderen u uit ons klantenbestand.
In het SpeedMeal “koper” account slaan wij gegevens op zoals naam, adres, telefoonnummer, e-mailadres, adresgegevens en gelijke zaken die vereist zijn om een bestelling correct te laten verlopen of om het gehele bestelproces te optimaliseren. In het SpeedMeal “horecazaak” account slaan wij gegevens op zoals adres, telefoonnummer, e-mailadres, adresgegevens, producten, levermethodes en andere zaken die vereist zijn om de diensten van SpeedMeal uit te kunnen voeren of het proces te optimaliseren. De “koper” en “horecazaak” beschikt conform “de wet verwerking persoonsgegevens van 08/12/1992” over een wettelijk recht op inzage en verbetering van zijn persoonsgegevens.
`,
        `Cookies: Cookies zijn stukjes informatie die door uw webbrowser worden opgeslagen op uw computer. SpeedMeal gebruikt cookies enkel om u te herkennen bij een volgend bezoek. Cookies kunnen niet worden gebruikt om personen te identificeren. U kan uw computer zodanig instellen dat u de cookies op SpeedMeal niet accepteert maar dan is het mogelijk dat u problemen kan ondervinden tijdens het gebruik van onze diensten. Cookies stellen ons in staat om informatie te verzamelen over het gebruik van onze diensten en deze te verbeteren en aan te passen aan de wensen van de gebruikers. 
SpeedMeal houdt online (anonieme) bezoekersstatistieken bij om te kunnen bekijken welke pagina’s van de internetsite in welke mate bezocht worden. Indien u vragen heeft over dit privacy statement, kunt u ons altijd contacteren via email.
`
        ]
      },
      {
        title: `Aantasting geldigheid – niet-verzaking`,
        messages: [`Indien onverschillig welke bepaling van deze Voorwaarden ongeldig, onwettig of nietig wordt verklaard, zal dit op geen enkele wijze de geldigheid, de wettigheid en de toepasbaarheid van de andere bepalingen aantasten.`,
        `Het nalaten op gelijk welk moment door SpeedMeal om één van de in deze Voorwaarden opgesomde rechten af te dwingen, of gelijk welk recht hiervan uit te oefenen, zal nooit gezien worden als een verzaking aan zulke bepaling en zal nooit de geldigheid van deze rechten aanpassen.`
        ]
      },
      {
        title: `SpeedMeal contactgegevens`,
        messages: [`Ons e-mailadres: info@speedmeal.be`
        ]
      },
      {
        title: `Wijziging Voorwaarden`,
        messages: [`Deze Voorwaarden worden aangevuld door andere voorwaarden waar expliciet naar verwezen wordt, en de algemene verkoopsvoorwaarden van SpeedMeal. Ingeval van tegenstrijdigheid, primeren onderhavige Voorwaarden.`,
        `SpeedMeal kan deze Voorwaarden steeds zonder nadere kennisgeving wijzigen. Elke aankoop na de wijziging, houdt een aanvaarding in door de klant van deze nieuwe Voorwaarden.`
        ]
      },
      {
        title: `Intellectuele en industriële eigendomsrechten`,
        messages: [`De inhoud van deze website, met inbegrip van de naam SpeedMeal, de merken, logo’s, foto’s, product- en bedrijfsnamen, teksten, tekeningen, beelden, informatie en dergelijke zijn beschermd door intellectuele rechten en behoren toe aan SpeedMeal en/of rechthoudende derden. Niks mag gebruikt worden zonder voorafgaande en uitdrukkelijke toestemming.`,
        `Intellectuele en industriële eigendomsrechten die rusten op de door SpeedMeal geleverde producten worden door de koper en horecazaak volledig en onvoorwaardelijk gerespecteerd. SpeedMeal garandeert niet dat de aan de koper geleverde producten geen inbreuk maken op enig (ongeschreven) intellectueel en/of industrieel eigendomsrecht van derden.`
        ]
      },
      {
        title: `Beperkte aansprakelijkheid`,
        messages: [`SpeedMeal levert grote inspanningen opdat de ter beschikking gestelde informatie volledig, juist, nauwkeurig en bijgewerkt zou zijn. Ondanks deze inspanningen kunnen onjuistheden zich voordoen. Indien de verstrekte informatie onjuistheden zou bevatten of indien bepaalde informatie op of via de website niet beschikbaar zou zijn, zal SpeedMeal er zijn uiterste best doen om dit zo snel mogelijk op te lossen.`,
        `SpeedMeal kan niet aansprakelijk gesteld worden voor rechtstreekse of onrechtstreekse schade die ontstaat uit het gebruik van onze diensten.`,
        `Indien u onjuistheden zou vaststellen kan u ons steeds contacteren via info@speedmeal.be`,
        `De inhoud van onze website kan ten allen tijde zonder voorafgaande aankondiging of kennisgeving aangepast, gewijzigd of aangevuld worden. SpeedMeal geeft geen garanties voor de goede werking van de website en kan op geen enkele wijze aansprakelijk gehouden worden voor een slechte werking of tijdelijke onbeschikbaarheid van de website of voor enige vorm van schade, rechtstreekse of onrechtstreekse, die zou voortvloeien uit de toegang tot of het gebruik van de website.`,
        `SpeedMeal kan in geen geval tegenover wie dan ook, op directe of indirecte, bijzondere of andere wijze aansprakelijk worden gesteld voor schade te wijten aan het gebruik van deze website of van een andere, inzonderheid als gevolg van links of hyperlinks, met inbegrip, zonder beperking, van alle verliezen, werkonderbrekingen, beschadiging van programma’s of andere gegevens op het computersysteem, van apparatuur, programmatuur of andere van de gebruiker.`,
        `De website kan hyperlinks bevatten naar websites of pagina’s van derden, of daar onrechtstreeks naar verwijzen. Het plaatsen van links naar deze websites of pagina’s impliceert op geen enkele wijze een impliciete goedkeuring van de inhoud ervan.`,
        `SpeedMeal verklaart uitdrukkelijk dat zij geen zeggenschap heeft over de inhoud of over andere kenmerken van deze websites en kan in geen geval aansprakelijk gehouden worden voor de inhoud, kenmerken of informatie ervan of voor enige andere vorm van schade door het gebruik ervan.`
        ]
      },
      {
        title: `Auteursrecht`,
        messages: [`De klant, hierna genaamd als “de koper”, mag alleen foto’s, logo’s en/of andere materialen uploaden waarvan de koper rechten op heeft.`,
        `SpeedMeal kan hiervoor niet aansprakelijk gesteld worden mocht hier misbruik van gemaakt worden.`,
        `De klant verklaart dat hij/zij, door het gebruik en beschikbaar stellen van enige afbeeldingen en/of andere materialen via de website www.speedmeal.be om een product af te nemen, geen inbreuk maakt op intellectuele rechten en/of privacybelangen van derde partijen.`,
        `De klant vrijwaart SpeedMeal zonder voorbehoud van alle eisen die een ander persoon aan SpeedMeal kan richten met betrekking tot inbreuk op de rechten van een derde persoon, in het bijzonder auteursrecht, dat tot stand komt met het gebruik van data die door de klant geleverd is.`
        ]
      },
      {
        title: `Bewijs`,
        messages: [`De klant aanvaardt dat elektronische communicaties en back-ups als bewijsvoering kunnen dienen.`
        ]
      },
      {
        title: `Toepasselijk recht- Bevoegde rechter`,
        messages: [`Het Belgisch recht is van toepassing, met uitzondering van de bepalingen van internationaal privaatrecht inzake toepasselijk recht en met van de Rome I Verordening inzake internationale koopovereenkomsten betreffende roerende zaken. Bij eventuele geschillen zijn uitsluitend de rechtbanken van het arrondissement van West-Vlaanderen bevoegd, zelfs indien er sprake is van meerdere gedaagden.`
        ]
      }
    ]
  })
};
</script>

<style>
</style>